<?php

declare(strict_types=1);

namespace App\DTOs\Pipeline;

use Carbon\Carbon;

final readonly class PipelineStageData
{
    private function __construct(
        public string $stage,
        public int $recordCount,
        public ?Carbon $lastExecution,
        public string $status,
    ) {
    }

    public static function make(
        string $stage,
        int $recordCount,
        ?Carbon $lastExecution,
        string $status,
    ): self {

        return new self(
            stage: $stage,
            recordCount: $recordCount,
            lastExecution: $lastExecution,
            status: $status,
        );

    }

    public function displayRecordCount(): string
    {
        return number_format($this->recordCount);
    }

    public function displayLastExecution(): string
    {
        return $this->lastExecution?->format('Y-m-d H:i:s')
            ?? 'Never';
    }

    public function displayStatus(): string
    {
        return match ($this->status) {
            'Complete' => 'Complete',
            'Warning' => 'Warning',
            'Empty' => 'Empty',
            default => 'Unknown',
        };
    }

    public function isComplete(): bool
    {
        return $this->status === 'Complete';
    }

    public function isWarning(): bool
    {
        return $this->status === 'Warning';
    }

    public function isEmpty(): bool
    {
        return $this->status === 'Empty';
    }
}