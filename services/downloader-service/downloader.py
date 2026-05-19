import trafilatura
from sqlalchemy import create_engine, text
from dotenv import load_dotenv
import os

# =========================
# LOAD ENV VARIABLES
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
    f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
)
engine = create_engine(DATABASE_URL)

# =========================
# PROCESS ARTICLES
# =========================
with engine.begin() as conn:
    articles = conn.execute(
        text("""
            SELECT id, url
            FROM article
            WHERE article_status = 'NEW'
        """)
    ).fetchall()

    print(f"Found {len(articles)} articles")

    for article in articles:
        # Safe row access
        article_id = article[0]
        article_url = article[1]

        print(f"Downloading: {article_url}")

        try:
            downloaded = trafilatura.fetch_url(article_url)

            if not downloaded:
                print(f"Failed download: {article_url}")
                conn.execute(
                    text("UPDATE article SET article_status='FAILED' WHERE id=:id"),
                    {"id": article_id}
                )
                continue

            content = trafilatura.extract(downloaded)

            if not content:
                print(f"No content extracted: {article_url}")
                conn.execute(
                    text("UPDATE article SET article_status='FAILED' WHERE id=:id"),
                    {"id": article_id}
                )
                continue

            # Save full article
            conn.execute(
                text("""
                    INSERT INTO full_article (article_id, content)
                    VALUES (:article_id, :content)
                """),
                {"article_id": article_id, "content": content}
            )

            # Update status
            conn.execute(
                text("""
                    UPDATE article
                    SET article_status='DOWNLOADED'
                    WHERE id=:id
                """),
                {"id": article_id}
            )

            print(f"Downloaded article {article_id}")

        except Exception as e:
            print(f"ERROR: {e}")
            conn.execute(
                text("UPDATE article SET article_status='FAILED' WHERE id=:id"),
                {"id": article_id}
            )

print("Downloader completed.")
