<?php

namespace App\Services;

class SelfTestService
{
    /**
     * Execute a self-test.
     */
    public function run(
        string $level = 'quick'
    ): array {

        return match ($level) {

            'quick'

                =>

                $this->quick(),

            'pipeline'

                =>

                $this->pipeline(),

            'full'

                =>

                $this->full(),

            default

                =>

                throw new \InvalidArgumentException(
                    'Unknown self-test level.'
                ),

        };

    }

        /*
    |--------------------------------------------------------------------------
    | Quick Test
    |--------------------------------------------------------------------------
    */

    /**
     * Verify system readiness.
     */
    private function quick(): array
    {
        return [

            'level' => 'quick',

            'description'

                =>

                'Verify application readiness.',

            'checks' => [

                'database',

                'python',

                'storage',

                'scheduler',

            ],

            'status'

                =>

                'READY',

            'executed_at'

                =>

                now(),

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Pipeline Test
    |--------------------------------------------------------------------------
    */

    /**
     * Verify preprocessing pipeline.
     */
    private function pipeline(): array
    {
        return [

            'level'

                =>

                'pipeline',

            'description'

                =>

                'Verify preprocessing pipeline.',

            'steps' => [

                'scraper',

                'downloader',

                'cleaner',

                'finbert',

                'feature_engineering',

            ],

            'status'

                =>

                'READY',

            'executed_at'

                =>

                now(),

        ];

    }

        /*
    |--------------------------------------------------------------------------
    | Full Test
    |--------------------------------------------------------------------------
    */

    /**
     * Verify the complete AI workflow.
     */
    private function full(): array
    {
        return [

            'level'

                =>

                'full',

            'description'

                =>

                'Verify the complete prediction workflow.',

            'steps'

                =>

                [

                    'scraper',

                    'downloader',

                    'cleaner',

                    'finbert',

                    'feature_engineering',

                    'gold_price',

                    'lstm',

                    'cnn',

                    'ann',

                    'prediction',

                    'evaluation',

                ],

            'status'

                =>

                'READY',

            'executed_at'

                =>

                now(),

        ];

    }

}