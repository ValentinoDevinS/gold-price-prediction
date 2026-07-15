# AI Processing Pipeline

Google News
RSS
SERP API
Yahoo Finance
        │
        ▼
Article
(news metadata)
        │
        ▼
FullArticle
(raw downloaded article)
        │
        ▼
CleanArticle
(cleaned text)
        │
        ▼
SentimentAnalysis
(FinBERT)
        │
        ▼
FeatureSnapshot
(feature engineering)
        │
        ▼
PredictionResult
(LSTM/CNN/ANN)
        │
        ▼
EnsembleResult
(final prediction)

## Python Services

### Scraper Service

Creates Article.

---

### Downloader Service

Downloads article body.

Creates FullArticle.

---

### Cleaner Service

Processes raw text.

Creates CleanArticle.

---

### FinBERT Service

Calculates sentiment.

Creates SentimentAnalysis.

---

### Feature Engineering Service

Creates FeatureSnapshot.

---

### ML Service

Creates PredictionResult.

---

### Ensemble Service

Creates EnsembleResult.