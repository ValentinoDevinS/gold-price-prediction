import logging
import os
import numpy as np
import pandas as pd

from datetime import datetime
from sqlalchemy import create_engine, text
from dotenv import load_dotenv
from sklearn.preprocessing import MinMaxScaler
from tensorflow.keras.models import load_model


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
# MODEL CONFIG
# =========================
MODELS = [
    {"name": "LSTM", "path": "models/lstm_gold_model.keras"},
    {"name": "CNN", "path": "models/cnn_gold_model.keras"},
    {"name": "ANN", "path": "models/ann_gold_model.keras"}
]


# =========================
# LOAD FEATURE DATA
# =========================
query = """
SELECT
    feature_date,
    avg_sentiment,
    positive_ratio,
    negative_ratio,
    article_count,
    rolling_sentiment_3d,
    rolling_sentiment_7d,
    sentiment_volatility
FROM feature_engineering
ORDER BY feature_date
"""

df = pd.read_sql(query, engine)


# =========================
# DATA CHECK
# =========================
if len(df) < 1:
    logging.warning("No feature data available")
    exit()

logging.info(f"Loaded {len(df)} rows")


# =========================
# FEATURE PREPARATION
# =========================
features = [
    "avg_sentiment",
    "positive_ratio",
    "negative_ratio",
    "article_count",
    "rolling_sentiment_3d",
    "rolling_sentiment_7d",
    "sentiment_volatility"
]

X = df[features].values
scaler = MinMaxScaler()
X_scaled = scaler.fit_transform(X)


# =========================
# USE LATEST FEATURE ROW
# =========================
latest_data = X_scaled[-1]
prediction_date = datetime.now().date()


# =========================
# RUN MODELS
# =========================
with engine.begin() as conn:
    for model_info in MODELS:
        model_name = model_info["name"]
        model_path = model_info["path"]

        logging.info(f"Loading {model_name}")

        if not os.path.exists(model_path):
            logging.warning(f"Model not found: {model_path}")
            continue

        try:
            model = load_model(model_path)

            # Prepare input shape
            if model_name in ["LSTM", "CNN"]:
                input_data = np.array([[latest_data]])
            else:
                input_data = np.array([latest_data])

            # Prediction
            prediction = model.predict(input_data, verbose=0)[0][0]
            logging.info(f"{model_name} prediction: {prediction}")

            # Save prediction
            conn.execute(
                text("""
                    INSERT INTO prediction_result
                    (model_name, prediction_date, predicted_price)
                    VALUES (:model_name, :prediction_date, :predicted_price)
                """),
                {
                    "model_name": model_name,
                    "prediction_date": prediction_date,
                    "predicted_price": float(prediction)
                }
            )

            logging.info(f"Saved {model_name} prediction")

        except Exception as e:
            logging.error(f"{model_name} failed: {e}")


logging.info("Prediction service completed")
