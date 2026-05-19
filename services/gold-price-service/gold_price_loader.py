import logging
import os
import sys

import pandas as pd
import yfinance as yf
import pymysql

from sqlalchemy import create_engine
from sqlalchemy import text

from dotenv import load_dotenv


# =========================
# LOGGING
# =========================

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s | %(levelname)s | %(message)s"
)


# =========================
# LOAD ENV
# =========================

load_dotenv()

DB_HOST = os.getenv("DB_HOST")
DB_PORT = os.getenv("DB_PORT")
DB_NAME = os.getenv("DB_NAME")
DB_USER = os.getenv("DB_USER")
DB_PASSWORD = os.getenv("DB_PASSWORD")


# =========================
# DATABASE CONNECTION
# =========================

DATABASE_URL = (
    f"mysql+pymysql://"
    f"{DB_USER}:{DB_PASSWORD}"
    f"@{DB_HOST}:{DB_PORT}/{DB_NAME}"
)

engine = create_engine(
    DATABASE_URL,
    pool_pre_ping=True
)


# =========================
# DOWNLOAD GOLD DATA
# =========================

logging.info(
    "Downloading gold price data..."
)

try:

    gold_data = yf.download(

        "GC=F",

        start="2020-01-01",

        interval="1d",

        auto_adjust=False,

        threads=False,

        progress=True

    )

except Exception as e:

    logging.error(
        f"Download failed: {e}"
    )

    sys.exit(1)


# =========================
# EMPTY CHECK
# =========================

if gold_data.empty:

    logging.error(
        "No gold data downloaded"
    )

    sys.exit(1)


logging.info(
    f"Downloaded {len(gold_data)} rows"
)


# =========================
# RESET INDEX
# =========================

gold_data.reset_index(
    inplace=True
)


# =========================
# FIX MULTIINDEX COLUMNS
# =========================

if isinstance(
    gold_data.columns,
    pd.MultiIndex
):

    gold_data.columns = [

        col[0]

        for col in gold_data.columns

    ]


# =========================
# DEBUG COLUMN NAMES
# =========================

logging.info(
    f"Columns: {gold_data.columns.tolist()}"
)


# =========================
# NORMALIZE DATE
# =========================

gold_data["Date"] = pd.to_datetime(
    gold_data["Date"]
).dt.date


# =========================
# CLEAN VOLUME
# =========================

gold_data["Volume"] = (

    gold_data["Volume"]

    .fillna(0)

    .astype(int)

)


# =========================
# RENAME COLUMNS
# =========================

gold_data.rename(

    columns={

        "Date": "price_date",

        "Open": "open_price",

        "High": "high_price",

        "Low": "low_price",

        "Close": "close_price",

        "Volume": "volume"

    },

    inplace=True

)


# =========================
# REMOVE DUPLICATES
# =========================

gold_data.drop_duplicates(

    subset=["price_date"],

    inplace=True

)


# =========================
# REMOVE INVALID ROWS
# =========================

gold_data.dropna(

    subset=[

        "open_price",

        "high_price",

        "low_price",

        "close_price"

    ],

    inplace=True

)


# =========================
# SORT DATA
# =========================

gold_data.sort_values(

    by="price_date",

    inplace=True

)


# =========================
# KEEP REQUIRED COLUMNS
# =========================

gold_data = gold_data[

    [

        "price_date",

        "open_price",

        "high_price",

        "low_price",

        "close_price",

        "volume"

    ]

]


# =========================
# RESET INDEX AGAIN
# =========================

gold_data.reset_index(

    drop=True,

    inplace=True

)


# =========================
# ENFORCE DATA TYPES
# =========================

gold_data = gold_data.astype({

    "open_price": float,

    "high_price": float,

    "low_price": float,

    "close_price": float,

    "volume": int

})


# =========================
# DEBUG PREVIEW
# =========================

logging.info(
    gold_data.tail()
)


# =========================
# UPSERT QUERY
# =========================

insert_stmt = """

INSERT INTO gold_price
(

    price_date,

    open_price,

    high_price,

    low_price,

    close_price,

    volume

)

VALUES
(
    %s,
    %s,
    %s,
    %s,
    %s,
    %s
)

ON DUPLICATE KEY UPDATE

    open_price=VALUES(open_price),

    high_price=VALUES(high_price),

    low_price=VALUES(low_price),

    close_price=VALUES(close_price),

    volume=VALUES(volume)

"""


# =========================
# BATCH CONFIG
# =========================

BATCH_SIZE = 500


# =========================
# SAVE TO DATABASE
# =========================

try:

    with engine.begin() as conn:

        # =========================
        # FIND LATEST DATE
        # =========================

        latest_date = conn.execute(

            text(
                """
                SELECT MAX(price_date)
                FROM gold_price
                """
            )

        ).scalar()


        if latest_date:

            latest_date = pd.to_datetime(
                latest_date
            ).date()


            logging.info(
                f"Latest date in DB: {latest_date}"
            )


            gold_data = gold_data[

                gold_data["price_date"]
                > latest_date

            ]


        # =========================
        # NO NEW DATA
        # =========================

        if gold_data.empty:

            logging.info(
                "No new data to insert"
            )

            sys.exit(0)


        logging.info(
            f"Inserting {len(gold_data)} rows"
        )


        # =========================
        # BATCH INSERT
        # =========================

        for start in range(
            0,
            len(gold_data),
            BATCH_SIZE
        ):

            end = start + BATCH_SIZE

            batch = gold_data.iloc[
                start:end
            ]


            cursor = conn.connection.cursor()


            cursor.executemany(

                insert_stmt,

                batch.values.tolist()

            )


            cursor.close()


            logging.info(
                f"Inserted batch {start} to {end-1}"
            )


    logging.info(
        "Gold prices saved successfully"
    )


except Exception as e:

    logging.error(
        f"Database insert failed: {e}"
    )

    sys.exit(1)
