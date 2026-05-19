import logging
import os
import numpy as np
import pandas as pd

from math import sqrt

from sqlalchemy import create_engine

from dotenv import load_dotenv

from sklearn.preprocessing import MinMaxScaler
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_squared_error

from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import (
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

MODEL_PATH = "models/ann_gold_model.keras"
MIN_DATASET_SIZE = 2


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

df = pd.read_sql(query, engine)


# =========================
# DATA CHECK
# =========================

if len(df) < MIN_DATASET_SIZE:
    logging.warning("Not enough training data")
    exit()

logging.info(f"Loaded {len(df)} rows")


# =========================
# FEATURES
# =========================

X = df[
    [
        "avg_sentiment",
        "positive_ratio",
        "negative_ratio",
        "article_count",
        "rolling_sentiment_3d",
        "rolling_sentiment_7d",
        "sentiment_volatility"
    ]
]

y = df["close_price"]


# =========================
# NORMALIZATION
# =========================

scaler_X = MinMaxScaler()
X_scaled = scaler_X.fit_transform(X)

scaler_y = MinMaxScaler()
y_scaled = scaler_y.fit_transform(y.values.reshape(-1, 1))


# =========================
# TRAIN TEST SPLIT
# =========================

X_train, X_test, y_train, y_test = train_test_split(
    X_scaled,
    y_scaled,
    test_size=0.2,
    random_state=42,
    shuffle=False
)


# =========================
# BUILD ANN MODEL
# =========================

model = Sequential()

model.add(
    Dense(
        64,
        activation="relu",
        input_shape=(X_train.shape[1],)
    )
)

model.add(Dropout(0.2))
model.add(Dense(32, activation="relu"))
model.add(Dropout(0.2))
model.add(Dense(1))


# =========================
# COMPILE MODEL
# =========================

model.compile(
    optimizer="adam",
    loss="mean_squared_error"
)

logging.info("Training ANN...")


# =========================
# TRAIN MODEL
# =========================

model.fit(
    X_train,
    y_train,
    epochs=20,
    batch_size=4,
    validation_data=(X_test, y_test),
    verbose=1
)


# =========================
# PREDICTIONS
# =========================

predictions = model.predict(X_test)


# =========================
# INVERSE SCALE
# =========================

predictions = scaler_y.inverse_transform(predictions)
y_test_actual = scaler_y.inverse_transform(y_test)


# =========================
# RMSE
# =========================

rmse = sqrt(mean_squared_error(y_test_actual, predictions))
logging.info(f"RMSE: {rmse}")


# =========================
# OPTIONAL MODEL SAVE
# =========================

if SAVE_MODEL:
    os.makedirs("models", exist_ok=True)
    model.save(MODEL_PATH)
    logging.info(f"Model saved to {MODEL_PATH}")
else:
    logging.info("Model saving disabled")


# =========================
# FINISHED
# =========================

logging.info("ANN training completed")