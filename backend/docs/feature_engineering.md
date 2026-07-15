# Feature Engineering Specification

## Version

Current Version: 1.0

---

## Purpose

FeatureSnapshot represents the complete feature vector supplied to the
machine learning prediction models (LSTM, CNN, ANN).

Each record corresponds to one prediction snapshot for a specific date.

---

## Sentiment Features

positive_score

Definition:
Probability that the article sentiment is positive.

Source:
SentimentAnalysis.positive_score

---

neutral_score

Definition:
Probability that the article sentiment is neutral.

Source:
SentimentAnalysis.neutral_score

---

negative_score

Definition:
Probability that the article sentiment is negative.

Source:
SentimentAnalysis.negative_score

---

## Article Features

word_count

Definition:
Number of words in the cleaned article.

Source:
CleanArticle.word_count

---

article_count

Definition:
Total number of articles collected for snapshot_date.

Formula:

COUNT(articles)

WHERE article_date = snapshot_date

---

average_sentiment

Definition:
Average positive sentiment across all articles
published on snapshot_date.

Formula:

SUM(positive_score)
/ COUNT(articles)

Alternative:

AVG(positive_score)

Current Version:

AVG(positive_score)

---

## Rolling Features

rolling_sentiment_3d

Definition:
Average positive sentiment during the previous
3 days.

Formula

AVG(positive_score)

Window

snapshot_date - 2 days

↓

snapshot_date

---

rolling_sentiment_7d

Definition

Average positive sentiment during previous 7 days.

Formula

AVG(positive_score)

Window

snapshot_date - 6 days

↓

snapshot_date

---

rolling_sentiment_14d

Definition

Average positive sentiment during previous
14 days.

Formula

AVG(positive_score)

Window

snapshot_date - 13 days

↓

snapshot_date

---

## Time Features

weekday

Definition

ISO weekday

1 = Monday

7 = Sunday

---

month

Definition

Month number

1-12

---

quarter

Definition

Quarter number

1-4

---

is_weekend

Definition

TRUE

Saturday

Sunday

FALSE

Monday-Friday

---

## Gold Market

gold_price

Definition

Closing gold price on snapshot_date.

Source

Yahoo Finance

---

gold_change_percent

Definition

Daily percentage change.

Formula

(Current - Previous)

/ Previous

×100

---

## Optional External Features

usd_index

Definition

US Dollar Index (DXY)

Nullable

Version 1 may leave NULL.

---

etf_flow

Definition

Gold ETF net inflow/outflow.

Nullable

---

trading_volume

Definition

Gold futures trading volume.

Nullable

---

## Metadata

feature_version

Current Version

1.0

---

snapshot_date

The market date represented by the feature vector.

---

generated_at

Timestamp when Python generated the feature vector.

---

created_at

Timestamp when Laravel stored the record.