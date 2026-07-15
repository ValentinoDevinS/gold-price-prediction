# Gold Price Prediction Backend Architecture

## Architecture Pattern

The backend follows a layered architecture using the Repository-Service pattern.



HTTP Request
        │
        ▼
Controller
        │
        ▼
Service
        │
        ▼
Repository
        │
        ▼
Eloquent Model
        │
        ▼
Database

## Layers

### Controller

Responsibilities

- Validate request
- Return API response
- Call Service

Controllers contain no business logic.

---

### Service

Responsibilities

- Business logic
- Transactions
- Cross-module operations

---

### Repository

Responsibilities

- Database access
- Query filtering
- Search
- Sorting
- Pagination

Repositories never contain business rules.

---

### Model

Responsibilities

- Relationships
- Casting
- UUID generation