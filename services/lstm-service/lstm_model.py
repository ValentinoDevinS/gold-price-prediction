import logging
import os
import numpy as np
import pandas as pd

from math import sqrt

from sqlalchemy import create_engine

from dotenv import load_dotenv

from sklearn.preprocessing import MinMaxScaler

from sklearn.metrics import mean_squared_error

from tensorflow.keras.models import Sequential

from tensorflow.keras.layers import (
    LSTM,
    Dense,
    Dropout
)


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

SAVE_MODEL = os.getenv(
    "SAVE_MODEL",
    "false"
).lower() == "true"


# =========================
# MODEL CONFIG
# =========================

MODEL_PATH = "models/lstm_gold_model.keras"


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
# LOAD DATA
# =========================

query = """
SELECT

    f.feature_date,

    f.avg_sentiment,
    f.positive_ratio,
    f.negative_ratio,
    f.article_count,
    f.rolling_sentiment_3d,
    f.rolling_sentiment_7d,
    f.sentiment_volatility,

    g.close_price

FROM feature_engineering f

JOIN gold_price g
ON f.feature_date = g.price_date

ORDER BY f.feature_date
"""


df = pd.read_sql(
    query,
    engine
)


# =========================
# DATA CHECK
# =========================

if len(df) < 5:

    logging.warning(
        "Not enough training data"
    )

    exit()


logging.info(
    f"Loaded {len(df)} rows"
)


# =========================
# FEATURES
# =========================

features = [

    "avg_sentiment",

    "positive_ratio",

    "negative_ratio",

    "article_count",

    "rolling_sentiment_3d",

    "rolling_sentiment_7d",

    "sentiment_volatility",

    "close_price"

]


dataset = df[
    features
].values


# =========================
# NORMALIZATION
# =========================

scaler = MinMaxScaler()

scaled_data = scaler.fit_transform(
    dataset
)


# =========================
# CREATE SEQUENCES
# =========================

SEQUENCE_LENGTH = 3

X = []
y = []


for i in range(
    SEQUENCE_LENGTH,
    len(scaled_data)
):

    X.append(
        scaled_data[
            i-SEQUENCE_LENGTH:i
        ]
    )

    y.append(
        scaled_data[i, -1]
    )


X = np.array(X)
y = np.array(y)


# =========================
# TRAIN TEST SPLIT
# =========================

split_index = int(
    len(X) * 0.8
)


X_train = X[:split_index]
X_test = X[split_index:]

y_train = y[:split_index]
y_test = y[split_index:]


# =========================
# BUILD LSTM MODEL
# =========================

model = Sequential()


model.add(

    LSTM(

        64,

        return_sequences=True,

        input_shape=(
            X_train.shape[1],
            X_train.shape[2]
        )

    )

)


model.add(
    Dropout(0.2)
)


model.add(
    LSTM(32)
)


model.add(
    Dropout(0.2)
)


model.add(
    Dense(1)
)


# =========================
# COMPILE MODEL
# =========================

model.compile(

    optimizer="adam",

    loss="mean_squared_error"

)


logging.info(
    "Training LSTM..."
)


# =========================
# TRAIN MODEL
# =========================

model.fit(

    X_train,
    y_train,

    epochs=20,

    batch_size=4,

    validation_data=(
        X_test,
        y_test
    ),

    verbose=1

)


# =========================
# PREDICTIONS
# =========================

predictions = model.predict(
    X_test
)


# =========================
# RMSE
# =========================

rmse = sqrt(

    mean_squared_error(
        y_test,
        predictions
    )

)


logging.info(
    f"RMSE: {rmse}"
)


# =========================
# OPTIONAL MODEL SAVE
# =========================

if SAVE_MODEL:

    # Create models folder if missing
    os.makedirs(
        "models",
        exist_ok=True
    )

    model.save(
        MODEL_PATH
    )

    logging.info(
        f"Model saved to {MODEL_PATH}"
    )

else:

    logging.info(
        "Model saving disabled"
    )


# =========================
# FINISHED
# =========================

logging.info(
    "LSTM training completed"
)
