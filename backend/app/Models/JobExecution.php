<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobExecution extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [

        'uuid',

        'scheduled_job_id',

        'is_manual',

        'status',

        'exit_code',

        'duration_ms',

        'stdout',

        'stderr',

        'error_message',

        'started_at',

        'finished_at',

    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'is_manual'

                =>

                'boolean',

            'exit_code'

                =>

                'integer',

            'duration_ms'

                =>

                'integer',

            'started_at'

                =>

                'datetime',

            'finished_at'

                =>

                'datetime',

        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Scheduled job.
     */
    public function scheduledJob(): BelongsTo
    {
        return

            $this->belongsTo(

                ScheduledJob::class

            );

    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Determine whether this execution was started manually.
     */
    public function isManual(): bool
    {
        return $this->is_manual;
    }

    /**
     * Determine whether this execution was started by the scheduler.
     */
    public function isAutomatic(): bool
    {
        return ! $this->is_manual;
    }

    /**
     * Determine whether execution completed successfully.
     */
    public function isSuccessful(): bool
    {
        return $this->status === ScheduledJob::SUCCESS;
    }

    /**
     * Determine whether execution failed.
     */
    public function hasFailed(): bool
    {
        return $this->status === ScheduledJob::FAILED;
    }

    /**
     * Execution duration in seconds.
     */
    public function durationInSeconds(): float
    {
        return round(

            $this->duration_ms / 1000,

            2

        );
    }

    /**
     * Determine whether the execution has finished.
     */
    public function isFinished(): bool
    {
        return $this->finished_at !== null;
    }
}