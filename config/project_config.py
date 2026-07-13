from pathlib import Path

# =====================================
# PROJECT ROOT
# =====================================

PROJECT_ROOT = Path(__file__).resolve().parent.parent

# =====================================
# STORAGE
# =====================================

STORAGE_DIR = PROJECT_ROOT / "storage"

MODEL_DIR = STORAGE_DIR / "models"

LOG_DIR = STORAGE_DIR / "logs"

EXPORT_DIR = STORAGE_DIR / "exports"

# =====================================
# SERVICES
# =====================================

SERVICES_DIR = PROJECT_ROOT / "services"

# =====================================
# BACKEND
# =====================================

BACKEND_DIR = PROJECT_ROOT / "backend"