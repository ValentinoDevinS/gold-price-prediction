<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Python Executable
    |--------------------------------------------------------------------------
    */

    'executable' => env(
        'PYTHON_EXECUTABLE',
        'python3'
    ),

    /*
    |--------------------------------------------------------------------------
    | Python Timeout (seconds)
    |--------------------------------------------------------------------------
    */

    'timeout' => (int) env(
        'PYTHON_TIMEOUT',
        600
    ),

    /*
    |--------------------------------------------------------------------------
    | Python Services Directory
    |--------------------------------------------------------------------------
    */

    'services_path' => base_path(
        '../services'
    ),

    /*
    |--------------------------------------------------------------------------
    | Python Working Directory
    |--------------------------------------------------------------------------
    */

    'working_directory' => base_path(
        '../services'
    ),

    /*
    |--------------------------------------------------------------------------
    | Python Service Scripts
    |--------------------------------------------------------------------------
    */

    'scripts' => [

        'scraper' => 'scraper/scraper.py',

        'downloader' => 'downloader/downloader.py',

        'cleaner' => 'cleaner/cleaner.py',

        'sentiment' => 'sentiment/finbert.py',

        'feature' => 'feature/feature_engineering.py',

        'lstm' => 'prediction/lstm.py',

        'cnn' => 'prediction/cnn.py',

        'ann' => 'prediction/ann.py',

        'evaluation' => 'evaluation/evaluation.py',

    ],

];