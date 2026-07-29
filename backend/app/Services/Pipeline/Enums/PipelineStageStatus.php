<?php

declare(strict_types=1);

namespace App\Services\Pipeline\Enums;

/**
 * Represents the status of a single pipeline stage.
 */
enum PipelineStageStatus: string
{
    case Pending = 'pending';

    case Running = 'running';

    case Completed = 'completed';

    case Failed = 'failed';

    case Skipped = 'skipped';

    /**
     * Determine whether this stage has finished.
     */
    public function isFinished(): bool
    {
        return match ($this) {
            self::Completed,
            self::Failed,
            self::Skipped => true,
            default => false,
        };
    }

    /**
     * Determine whether the stage completed successfully.
     */
    public function isSuccessful(): bool
    {
        return match ($this) {
            self::Completed,
            self::Skipped => true,
            default => false,
        };
    }

    /**
     * Determine whether the stage is currently running.
     */
    public function isRunning(): bool
    {
        return $this === self::Running;
    }
}