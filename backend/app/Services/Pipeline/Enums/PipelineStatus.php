<?php

declare(strict_types=1);

namespace App\Services\Pipeline\Enums;

/**
 * Represents the overall status of a pipeline execution.
 */
enum PipelineStatus: string
{
    case Pending = 'pending';

    case Running = 'running';

    case Completed = 'completed';

    case Failed = 'failed';

    /**
     * Determine whether the pipeline has finished execution.
     */
    public function isFinished(): bool
    {
        return match ($this) {
            self::Completed,
            self::Failed => true,
            default => false,
        };
    }

    /**
     * Determine whether the pipeline is currently active.
     */
    public function isRunning(): bool
    {
        return $this === self::Running;
    }

    /**
     * Determine whether the pipeline completed successfully.
     */
    public function isSuccessful(): bool
    {
        return $this === self::Completed;
    }
}