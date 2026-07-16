<?php

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
    | Timeout
    |--------------------------------------------------------------------------
    */

    'timeout' => env(
        'PYTHON_TIMEOUT',
        600
    ),

     /*
    |--------------------------------------------------------------------------
    | Python Services Path
    |--------------------------------------------------------------------------
    |
    | Laravel is located in:
    |   project/backend
    |
    | Python services are located in:
    |   project/services
    |
    | Therefore we move one directory up from the Laravel
    | base path and then into the services directory.
    |
    */

    'scripts_path' => base_path(
        '../services'
    ),

];