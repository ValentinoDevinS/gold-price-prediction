# Database Relationships


Article
    │
    └──────────────┐
                   │
                   ▼
             FullArticle
                   │
                   ▼
             CleanArticle
                   │
                   ▼
          SentimentAnalysis
                   │
                   ▼
          FeatureSnapshot
                   │
                   ▼
          PredictionResult
                   │
                   ▼
          EnsembleResult

User

Role

AuditLog

TrainingHistory

MlModel

SchedulerLog          