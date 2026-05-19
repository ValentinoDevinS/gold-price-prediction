import logging
import os
import regex as re
import nltk
from bs4 import BeautifulSoup
from sqlalchemy import create_engine, text
from dotenv import load_dotenv
from nltk.corpus import stopwords

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
# NLTK RESOURCES
# =========================
nltk.download("stopwords", quiet=True)

STOP_WORDS = set(stopwords.words("english"))

# =========================
# CLEANING FUNCTION
# =========================
def clean_text(text_content):
    # Remove HTML
    soup = BeautifulSoup(text_content, "html.parser")
    text_only = soup.get_text()

    # Unicode normalization
    text_only = text_only.encode("utf-8", errors="ignore").decode("utf-8")

    # Lowercase
    text_only = text_only.lower()

    # Remove URLs, emails, numbers, special chars, extra whitespace
    text_only = re.sub(r"http\S+", "", text_only)
    text_only = re.sub(r"\S+@\S+", "", text_only)
    text_only = re.sub(r"\d+", "", text_only)
    text_only = re.sub(r"[^a-zA-Z\s]", "", text_only)
    text_only = re.sub(r"\s+", " ", text_only).strip()

    # Tokenization (regex-based)
    words = re.findall(r"\b[a-zA-Z]+\b", text_only)

    # Remove stopwords
    filtered_words = [word for word in words if word not in STOP_WORDS]

    return " ".join(filtered_words)

# =========================
# PROCESS ARTICLES
# =========================
with engine.begin() as conn:
    articles = conn.execute(
        text("""
            SELECT full_article.article_id, full_article.content
            FROM full_article
            JOIN article ON article.id = full_article.article_id
            WHERE article.article_status='DOWNLOADED'
        """)
    ).fetchall()

    logging.info(f"Found {len(articles)} articles")

    for article in articles:
        article_id = article[0]
        content = article[1]

        try:
            # Empty content check
            if not content:
                logging.warning(f"Empty content: {article_id}")
                conn.execute(
                    text("UPDATE article SET article_status='FAILED_TO_CLEAN' WHERE id=:id"),
                    {"id": article_id}
                )
                continue

            # Duplicate prevention
            existing = conn.execute(
                text("SELECT id FROM clean_article WHERE article_id=:article_id"),
                {"article_id": article_id}
            ).fetchone()

            if existing:
                logging.info(f"Already cleaned: {article_id}")
                continue

            # Clean text
            cleaned_text = clean_text(content)

            # Quality filter
            if len(cleaned_text) < 100:
                logging.warning(f"Clean text too short: {article_id}")
                conn.execute(
                    text("UPDATE article SET article_status='FAILED_TO_CLEAN' WHERE id=:id"),
                    {"id": article_id}
                )
                continue

            # Save clean article
            conn.execute(
                text("""
                    INSERT INTO clean_article (article_id, clean_content)
                    VALUES (:article_id, :clean_content)
                """),
                {"article_id": article_id, "clean_content": cleaned_text}
            )

            # Update status
            conn.execute(
                text("UPDATE article SET article_status='CLEANED' WHERE id=:id"),
                {"id": article_id}
            )

            logging.info(f"Cleaned article {article_id}")

        except Exception as e:
            logging.error(f"ERROR article {article_id}: {e}")
            conn.execute(
                text("UPDATE article SET article_status='FAILED_TO_CLEAN' WHERE id=:id"),
                {"id": article_id}
            )

logging.info("Cleaner completed.")