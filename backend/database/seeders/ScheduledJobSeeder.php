<?php

namespace Database\Seeders;

use App\Models\ScheduledJob;
use Illuminate\Database\Seeder;

class ScheduledJobSeeder extends Seeder
{
    /**
     * Seed the scheduled jobs table.
     */
    public function run(): void
    {
        $jobs = [

            /*
            |--------------------------------------------------------------------------
            | Data Collection
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::SCRAPER,

                'job_name' => 'News Scraper',

                'job_group' => 'Data Collection',

                'display_order' => 1,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::DOWNLOADER,

                'job_name' => 'Article Downloader',

                'job_group' => 'Data Collection',

                'display_order' => 2,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::CLEANER,

                'job_name' => 'Data Cleaner',

                'job_group' => 'Data Collection',

                'display_order' => 3,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Sentiment Analysis
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::FINBERT,

                'job_name' => 'FinBERT Analysis',

                'job_group' => 'Sentiment Analysis',

                'display_order' => 4,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Feature Engineering
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::FEATURE,

                'job_name' => 'Feature Engineering',

                'job_group' => 'Feature Engineering',

                'display_order' => 5,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Market Data
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::GOLD_PRICE,

                'job_name' => 'Gold Price Loader',

                'job_group' => 'Market Data',

                'display_order' => 6,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '08:00',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Machine Learning
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::LSTM,

                'job_name' => 'LSTM Training',

                'job_group' => 'Machine Learning',

                'display_order' => 7,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '22:00',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::CNN,

                'job_name' => 'CNN Training',

                'job_group' => 'Machine Learning',

                'display_order' => 8,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '22:15',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::ANN,

                'job_name' => 'ANN Training',

                'job_group' => 'Machine Learning',

                'display_order' => 9,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '22:30',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Prediction
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::PREDICTION,

                'job_name' => 'Generate Prediction',

                'job_group' => 'Prediction',

                'display_order' => 10,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '23:00',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::EVALUATION,

                'job_name' => 'Evaluate Prediction',

                'job_group' => 'Prediction',

                'display_order' => 11,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '23:15',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            /*
            |--------------------------------------------------------------------------
            | Monitoring
            |--------------------------------------------------------------------------
            */

            [

                'job_key' => ScheduledJob::HEALTH,

                'job_name' => 'System Health Check',

                'job_group' => 'Monitoring',

                'display_order' => 12,

                'schedule_type' => 'hourly',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => null,

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

            [

                'job_key' => ScheduledJob::SELF_TEST,

                'job_name' => 'System Self Test',

                'job_group' => 'Monitoring',

                'display_order' => 13,

                'schedule_type' => 'daily',

                'interval_value' => null,

                'cron_expression' => null,

                'run_time' => '23:45',

                'is_enabled' => true,

                'state' => ScheduledJob::IDLE,

                'last_run_at' => null,

                'next_run_at' => null,

            ],

        ];

        foreach ($jobs as $job) {

            ScheduledJob::updateOrCreate(

                [

                    'job_key' => $job['job_key'],

                ],

                $job

            );

        }
    }
}