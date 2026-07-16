<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Monitored Categories
    |--------------------------------------------------------------------------
    */

    'categories' => [

        'models' => [

            'label' => 'AI Models',

            'path' => realpath(
                base_path('../storage/models')
            ),

            'color' => '#2563EB',

        ],

        'logs' => [

            'label' => 'Logs',

            'path' => realpath(
                base_path('../storage/logs')
            ),

            'color' => '#F59E0B',

        ],

        'exports' => [

            'label' => 'Exports',

            'path' => realpath(
                base_path('../storage/exports')
            ),

            'color' => '#10B981',

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Warning Thresholds
    |--------------------------------------------------------------------------
    */

    'warning_percentage' => 85,

    'critical_percentage' => 95,

];