import requests
from sqlalchemy import create_engine, text
from dotenv import load_dotenv
import os
from datetime import datetime
from dateutil import parser  # to parse published_date strings

# =========================
# LOAD ENVIRONMENT VARIABLES
# =========================
load_dotenv()

SERPAPI_KEY = os.getenv("SERPAPI_KEY")
DB_HOST = os.getenv("DB_HOST")
DB_PORT = os.getenv("DB_PORT")
DB_NAME = os.getenv("DB_NAME")
DB_USER = os.getenv("DB_USER")
DB_PASSWORD = os.getenv("DB_PASSWORD")

# =========================
# DATABASE CONNECTION
# =========================
DATABASE_URL = f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}@{DB_HOST}:{DB_PORT}/{DB_NAME}"
engine = create_engine(DATABASE_URL)

# =========================
# SEARCH QUERY
# =========================
SEARCH_QUERY = "gold price inflation federal reserve economy interest rate recession"

# =========================
# SERPAPI REQUEST
# =========================
url = "https://serpapi.com/search.json"
params = {
    "engine": "google_news",
    "q": SEARCH_QUERY,
    "api_key": SERPAPI_KEY,
    "hl": "en",
    "gl": "us"
}

print("Requesting articles from SerpAPI...")
response = requests.get(url, params=params)

if response.status_code != 200:
    print("ERROR:", response.status_code)
    exit()

data = response.json()
news_results = data.get("news_results", [])
print(f"Found {len(news_results)} articles")

# =========================
# SAVE TO DATABASE
# =========================
with engine.begin() as conn:  # auto-commit at the end
    for article in news_results:
        title = article.get("title")
        summary = article.get("snippet")
        article_url = article.get("link")
        source = article.get("source", {}).get("name")  # fix source extraction
        published_date_raw = article.get("date")

        # Try parsing published_date
        try:
            published_date = parser.parse(published_date_raw)
        except Exception:
            published_date = None

        # Prevent duplicate URLs
        existing = conn.execute(
            text("SELECT id FROM article WHERE url = :url"),
            {"url": article_url}
        ).fetchone()

        if existing:
            print(f"Skipped duplicate: {title}")
            continue

        conn.execute(
            text("""
                INSERT INTO article
                (title, summary, url, source, published_date, article_status)
                VALUES (:title, :summary, :url, :source, :published_date, :article_status)
            """),
            {
                "title": title,
                "summary": summary,
                "url": article_url,
                "source": source,
                "published_date": published_date,
                "article_status": "NEW"
            }
        )

        print(f"Inserted: {title}")

print("Scraping completed.")
