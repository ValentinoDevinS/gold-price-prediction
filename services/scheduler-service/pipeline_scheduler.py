import logging
import os
import subprocess

from dotenv import load_dotenv


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

PROJECT_ROOT = os.getenv(
    "PROJECT_ROOT"
)


# =========================
# SERVICES
# =========================

SERVICES = [

    {
        "name": "scraper-service",
        "script": "scraper.py"
    },

    {
        "name": "downloader-service",
        "script": "downloader.py"
    },

    {
        "name": "cleaner-service",
        "script": "cleaner.py"
    },

    {
        "name": "finbert-service",
        "script": "finbert.py"
    },

    {
        "name": "gold-price-service",
        "script": "gold_price_loader.py"
    },

    {
        "name": "feature-service",
        "script": "feature_engineering.py"
    }

]


# =========================
# RUN SERVICE
# =========================

def run_service(service):

    service_name = service["name"]

    script_name = service["script"]


    # =========================
    # BUILD PATHS
    # =========================

    service_path = os.path.join(
        PROJECT_ROOT,
        service_name
    )


    script_path = os.path.join(
        service_path,
        script_name
    )


    venv_python = os.path.join(
        service_path,
        "venv",
        "bin",
        "python"
    )


    logging.info(
        f"Starting {service_name}"
    )


    # =========================
    # VALIDATE FILES
    # =========================

    if not os.path.exists(script_path):

        logging.error(
            f"Script not found: {script_path}"
        )

        return


    if not os.path.exists(venv_python):

        logging.error(
            f"Venv python not found: {venv_python}"
        )

        return


    # =========================
    # RUN SERVICE
    # =========================

    try:

        result = subprocess.run(

            [venv_python, script_path],

            capture_output=True,

            text=True,

            check=True

        )


        logging.info(
            f"Completed {service_name}"
        )


        # =========================
        # STDOUT LOG
        # =========================

        if result.stdout:

            logging.info(
                result.stdout
            )


        # =========================
        # STDERR LOG
        # =========================

        if result.stderr:

            logging.warning(
                result.stderr
            )


    except subprocess.CalledProcessError as e:

        logging.error(
            f"FAILED {service_name}"
        )


        logging.error(
            e.stderr
        )


# =========================
# MAIN PIPELINE
# =========================

def run_pipeline():

    logging.info(
        "Starting AI pipeline"
    )


    for service in SERVICES:

        run_service(service)


    logging.info(
        "Pipeline completed"
    )


# =========================
# ENTRY POINT
# =========================

if __name__ == "__main__":

    run_pipeline()
