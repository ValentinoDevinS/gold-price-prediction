import logging
import os
import torch
from sqlalchemy import create_engine, text
from dotenv import load_dotenv
from transformers import (
    AutoTokenizer,
    AutoModelForSequenceClassification,
    pipeline
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
MODEL_DEVICE = os.getenv("MODEL_DEVICE", "cpu")

# =========================
# TORCH CPU OPTIMIZATION
# =========================
torch.set_num_threads(4)

# =========================
# DEVICE SETUP
# =========================
if MODEL_DEVICE == "cuda" and torch.cuda.is_available():
    DEVICE = 0
    logging.info("Using GPU")
else:
    DEVICE = -1
    logging.info("Using CPU")

# =========================
# DATABASE CONNECTION
# =========================
DATABASE_URL = f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
engine = create_engine(DATABASE_URL, pool_pre_ping=True)

# =========================
# LOAD FINBERT MODEL
# =========================
MODEL_NAME = "ProsusAI/finbert"
logging.info("Loading FinBERT model...")

tokenizer = AutoTokenizer.from_pretrained(MODEL_NAME)
model = AutoModelForSequenceClassification.from_pretrained(MODEL_NAME)

classifier = pipeline(
    "sentiment-analysis",
    model=model,
    tokenizer=tokenizer,
    device=DEVICE
)

# =========================
# MODEL WARMUP
# =========================
logging.info("Warming up model...")
classifier("Gold prices remain stable.", truncation=True, max_length=512)
logging.info("FinBERT loaded successfully")

# =========================
# PROCESS ARTICLES
# =========================
with engine.begin() as conn:
    articles = conn.execute(
        text("""
            SELECT clean_article.article_id, clean_article.clean_content
            FROM clean_article
            JOIN article ON article.id = clean_article.article_id
            WHERE article.article_status='CLEANED'
        """)
    ).fetchall()

    logging.info(f"Found {len(articles)} articles")

    for article in articles:
        article_id = article[0]
        clean_content = article[1]

        try:
            # Duplicate prevention
            existing = conn.execute(
                text("SELECT id FROM analysis_sentiment WHERE article_id=:article_id"),
                {"article_id": article_id}
            ).fetchone()

            if existing:
                logging.info(f"Already analyzed: {article_id}")
                continue

            # Content validation
            if not clean_content:
                logging.warning(f"No content: {article_id}")
                conn.execute(
                    text("UPDATE article SET article_status='FAILED_ANALYSIS' WHERE id=:id"),
                    {"id": article_id}
                )
                continue

            # Character limit safeguard
            clean_content = clean_content[:4000]

            # FinBERT inference
            result = classifier(clean_content, truncation=True, max_length=512)[0]
            label = result["label"].lower()
            score = float(result["score"])

            # Score mapping
            positive_score = score if label == "positive" else 0.0
            negative_score = score if label == "negative" else 0.0
            neutral_score = score if label == "neutral" else 0.0

            # Compound score
            compound_score = positive_score - negative_score

            # Save result
            conn.execute(
                text("""
                    INSERT INTO analysis_sentiment
                    (article_id, positive_score, negative_score, neutral_score, compound_score, sentiment_label)
                    VALUES (:article_id, :positive_score, :negative_score, :neutral_score, :compound_score, :sentiment_label)
                """),
                {
                    "article_id": article_id,
                    "positive_score": positive_score,
                    "negative_score": negative_score,
                    "neutral_score": neutral_score,
                    "compound_score": compound_score,
                    "sentiment_label": label
                }
            )

            # Update status
            conn.execute(
                text("UPDATE article SET article_status='ANALYZED' WHERE id=:id"),
                {"id": article_id}
            )

            logging.info(f"Analyzed article {article_id}")

        except Exception as e:
            logging.error(f"ERROR article {article_id}: {e}")
            conn.execute(
                text("UPDATE article SET article_status='FAILED_ANALYSIS' WHERE id=:id"),
                {"id": article_id}
            )
            logging.warning(f"Marked article {article_id} as FAILED_ANALYSIS")

logging.info("FinBERT analysis completed.")
