<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledJob extends Model
{
    use HasFactory;
    use HasUuid;

    /*
    |--------------------------------------------------------------------------
    | Job Keys
    |--------------------------------------------------------------------------
    */

    public const SCRAPER = 'scraper';

    public const DOWNLOADER = 'downloader';

    public const CLEANER = 'cleaner';

    public const FINBERT = 'finbert';

    public const FEATURE = 'feature';

    public const GOLD_PRICE = 'gold_price';

    public const LSTM = 'lstm';

    public const CNN = 'cnn';

    public const ANN = 'ann';

    public const PREDICTION = 'prediction';

    public const EVALUATION = 'evaluation';

    public const HEALTH = 'health';

    public const SELF_TEST = 'self_test';

    /*
    |--------------------------------------------------------------------------
    | Execution States
    |--------------------------------------------------------------------------
    */

    public const IDLE = 'IDLE';

    public const QUEUED = 'QUEUED';

    public const RUNNING = 'RUNNING';

    public const SUCCESS = 'SUCCESS';

    public const FAILED = 'FAILED';

    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'uuid',

        'job_key',

        'job_name',

        'job_group',

        'display_order',

        'schedule_type',

        'interval_value',

        'cron_expression',

        'run_time',

        'is_enabled',

        'state',

        'last_run_at',

        'next_run_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'display_order'

                =>

                'integer',

            'interval_value'

                =>

                'integer',

            'is_enabled'

                =>

                'boolean',

            'last_run_at'

                =>

                'datetime',

            'next_run_at'

                =>

                'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Determine whether this job is enabled.
     */
    public function isEnabled(): bool
    {
        return $this->is_enabled;
    }

    /**
     * Determine whether this job is idle.
     */
    public function isIdle(): bool
    {
        return $this->state === self::IDLE;
    }

    /**
     * Determine whether this job is queued.
     */
    public function isQueued(): bool
    {
        return $this->state === self::QUEUED;
    }

    /**
     * Determine whether this job is currently running.
     */
    public function isRunning(): bool
    {
        return $this->state === self::RUNNING;
    }

    /**
     * Determine whether the last execution succeeded.
     */
    public function isSuccessful(): bool
    {
        return $this->state === self::SUCCESS;
    }

    /**
     * Determine whether the last execution failed.
     */
    public function hasFailed(): bool
    {
        return $this->state === self::FAILED;
    }
}