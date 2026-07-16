<?php

namespace App\Services;

class StorageService
{
    /**
     * Storage dashboard.
     */
    public function summary(): array
    {
        return [

            'overview'

                =>

                $this->overview(),

            'categories'

                =>

                $this->categories(),

            'forecast'

                =>

                $this->forecast(),

            'health'

                =>

                $this->health(),

            'generated_at'

                =>

                now(),

        ];

    }

        /*
    |--------------------------------------------------------------------------
    | Overview
    |--------------------------------------------------------------------------
    */

    /**
     * Storage overview.
     */
    public function overview(): array
    {
        $categories =

            $this->categories();

        $total =

            collect($categories)

                ->sum(
                    'size_bytes'
                );

        return [

            'total_bytes'

                =>

                $total,

            'total_human'

                =>

                $this->humanSize(
                    $total
                ),

            'category_count'

                =>

                count($categories),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    /**
     * Storage categories.
     */
    public function categories(): array
    {
        $config =

            config(
                'storage.categories',
                []
            );

        $categories = [];

        foreach (

            $config

            as

            $key => $category

        ) {

            $bytes =

                $this->folderSize(

                    $category['path']

                );

            $categories[] = [

                'key'

                    =>

                    $key,

                'label'

                    =>

                    $category['label'],

                'color'

                    =>

                    $category['color'],

                'path'

                    =>

                    $category['path'],

                'size_bytes'

                    =>

                    $bytes,

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | Sort Largest First
        |--------------------------------------------------------------------------
        */

        usort(

            $categories,

            fn (

                array $a,

                array $b

            )

                =>

                $b['size_bytes']

                <=>

                $a['size_bytes']

        );

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $total =

            collect($categories)

                ->sum(
                    'size_bytes'
                );

        foreach (

            $categories

            as

            $index => &$category

        ) {

            $percentage =

                $total > 0

                    ?

                    (

                        $category['size_bytes']

                        /

                        $total

                    )

                    * 100

                    :

                    0;

            $category['rank']

                =

                $index + 1;

            $category['size']

                =

                $this->humanSize(

                    $category['size_bytes']

                );

            $category['percentage']

                =

                round(

                    $percentage,

                    2

                );

            $category['status']

                =

                $index === 0

                    ?

                    'LARGEST'

                    :

                    'NORMAL';

        }

        unset($category);

        return $categories;

    }

        /*
    |--------------------------------------------------------------------------
    | Forecast
    |--------------------------------------------------------------------------
    */

    /**
     * Storage forecast.
     *
     * Placeholder until historical storage tracking
     * is implemented.
     */
    public function forecast(): array
    {
        return [

            'status'

                =>

                'NOT_AVAILABLE',

            'message'

                =>

                'Storage forecasting requires historical storage data.',

            'estimated_days_remaining'

                =>

                null,

            'daily_growth_bytes'

                =>

                null,

            'generated_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Health
    |--------------------------------------------------------------------------
    */

    /**
     * Storage health.
     */
    public function health(): array
    {
        $overview =

            $this->overview();

        $storagePath = config(
            'python.storage_path'
        );

        $free = disk_free_space(
            $storagePath
        );

        $total = disk_total_space(
            $storagePath
        );

        if (

            $free === false ||

            $total === false ||

            $total === 0

        ) {

            return [

                'status'

                    =>

                    'UNKNOWN',

                'usage_percent'

                    =>

                    null,

                'free_bytes'

                    =>

                    null,

                'free'

                    =>

                    null,

                'total_bytes'

                    =>

                    null,

                'total'

                    =>

                    null,

                'message'

                    =>

                    'Unable to determine disk usage.',

            ];

        }

        $usage =

            (($total - $free)

            / $total)

            * 100;

        $warning = config(
            'storage.warning_percentage',
            85
        );

        $critical = config(
            'storage.critical_percentage',
            95
        );

        $status = match (true) {

            $usage >= $critical

                =>

                'CRITICAL',

            $usage >= $warning

                =>

                'WARNING',

            default

                =>

                'HEALTHY',

        };

        return [

            'status'

                =>

                $status,

            'usage_percent'

                =>

                round(
                    $usage,
                    2
                ),

            'used_bytes'

                =>

                $overview['total_bytes'],

            'used'

                =>

                $overview['total_human'],

            'free_bytes'

                =>

                $free,

            'free'

                =>

                $this->humanSize(
                    $free
                ),

            'total_bytes'

                =>

                $total,

            'total'

                =>

                $this->humanSize(
                    $total
                ),

            'message'

                =>

                sprintf(

                    '%.2f%% disk usage.',

                    $usage

                ),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Calculate folder size.
     */
    private function folderSize(
        ?string $directory
    ): int
    {
        if (

            ! $directory ||

            ! is_dir($directory)

        ) {

            return 0;

        }

        $size = 0;

        $iterator = new \RecursiveIteratorIterator(

            new \RecursiveDirectoryIterator(

                $directory,

                \FilesystemIterator::SKIP_DOTS

            )

        );

        foreach (

            $iterator

            as

            $file

        ) {

            if (

                $file->isFile()

            ) {

                $size += $file->getSize();

            }

        }

        return $size;

    }

    /**
     * Human readable size.
     */
    private function humanSize(
        int $bytes
    ): string
    {
        $units = [

            'B',

            'KB',

            'MB',

            'GB',

            'TB',

        ];

        $bytes = max(
            $bytes,
            0
        );

        $power = $bytes > 0
            ? floor(
                log($bytes, 1024)
            )
            : 0;

        $power = min(
            $power,
            count($units) - 1
        );

        $value =

            $bytes /

            (1024 ** $power);

        return round(
            $value,
            2
        )

        .' '

        .$units[$power];

    }

}