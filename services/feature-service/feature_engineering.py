import logging
import os
import pandas as pd
import numpy as np
from sqlalchemy import create_engine, text
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
DATABASE_URL = f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
engine = create_engine(DATABASE_URL, pool_pre_ping=True)

# =========================
# LOAD SENTIMENT DATA
# =========================
query = """
SELECT
    DATE(analyzed_at) AS feature_date,
    positive_score,
    negative_score,
    neutral_score,
    compound_score,
    sentiment_label
FROM analysis_sentiment
"""

df = pd.read_sql(query, engine)

if df.empty:
    logging.warning("No sentiment data found")
    exit()

logging.info(f"Loaded {len(df)} sentiment rows")

# =========================
# DAILY AGGREGATION
# =========================
daily_features = df.groupby("feature_date").agg(
    avg_sentiment=("compound_score", "mean"),
    positive_ratio=("positive_score", "mean"),
    negative_ratio=("negative_score", "mean"),
    neutral_ratio=("neutral_score", "mean"),
    article_count=("compound_score", "count"),
    sentiment_volatility=("compound_score", "std")
).reset_index()

# =========================
# HANDLE NaN
# =========================
daily_features = daily_features.fillna(0)

# =========================
# SORT BY DATE
# =========================
daily_features = daily_features.sort_values("feature_date")

# =========================
# ROLLING FEATURES
# =========================
daily_features["rolling_sentiment_3d"] = (
    daily_features["avg_sentiment"].rolling(3).mean()
)

daily_features["rolling_sentiment_7d"] = (
    daily_features["avg_sentiment"].rolling(7).mean()
)

# Fill rolling NaN
daily_features = daily_features.fillna(0)

logging.info("Feature engineering completed")

# =========================
# SAVE FEATURES
# =========================
with engine.begin() as conn:
    for _, row in daily_features.iterrows():
        existing = conn.execute(
            text("SELECT id FROM feature_engineering WHERE feature_date=:feature_date"),
            {"feature_date": row["feature_date"]}
        ).fetchone()

        if existing:
            logging.info(f"Already exists: {row['feature_date']}")
            continue

        conn.execute(
            text("""
                INSERT INTO feature_engineering
                (
                    feature_date,
                    avg_sentiment,
                    positive_ratio,
                    negative_ratio,
                    neutral_ratio,
                    article_count,
                    rolling_sentiment_3d,
                    rolling_sentiment_7d,
                    sentiment_volatility
                )
                VALUES
                (
                    :feature_date,
                    :avg_sentiment,
                    :positive_ratio,
                    :negative_ratio,
                    :neutral_ratio,
                    :article_count,
                    :rolling_sentiment_3d,
                    :rolling_sentiment_7d,
                    :sentiment_volatility
                )
            """),
            {
                "feature_date": row["feature_date"],
                "avg_sentiment": float(row["avg_sentiment"]),
                "positive_ratio": float(row["positive_ratio"]),
                "negative_ratio": float(row["negative_ratio"]),
                "neutral_ratio": float(row["neutral_ratio"]),
                "article_count": int(row["article_count"]),
                "rolling_sentiment_3d": float(row["rolling_sentiment_3d"]),
                "rolling_sentiment_7d": float(row["rolling_sentiment_7d"]),
                "sentiment_volatility": float(row["sentiment_volatility"])
            }
        )

logging.info("Features saved successfully")
