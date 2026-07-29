<?php

declare(strict_types=1);

namespace App\Services\Pipeline\DTO;

use App\Services\Pipeline\Enums\PipelineStatus;
use JsonSerializable;

final class PipelineResult implements JsonSerializable
{
    /**
     * @param array<string, mixed> $metadata
     * @param array<int, string> $warnings
     * @param array<int, string> $errors
     */
    public function __construct(
        private readonly string $executionId,
        private readonly string $pipeline,
        private readonly string $description,
        private readonly PipelineStatus $status,
        private readonly PipelineProgress $progress,
        private readonly \DateTimeImmutable $startedAt,
        private readonly \DateTimeImmutable $finishedAt,
        private readonly int $processed = 0,
        private readonly int $failed = 0,
        private readonly int $skipped = 0,
        private readonly array $metadata = [],
        private readonly array $warnings = [],
        private readonly array $errors = [],
        private readonly ?string $message = null,
    ) {
    }

    public function executionId(): string
    {
        return $this->executionId;
    }

    public function pipeline(): string
    {
        return $this->pipeline;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function status(): PipelineStatus
    {
        return $this->status;
    }

    public function progress(): PipelineProgress
    {
        return $this->progress;
    }

    public function startedAt(): \DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function finishedAt(): \DateTimeImmutable
    {
        return $this->finishedAt;
    }

    public function durationInSeconds(): int
    {
        return $this->finishedAt->getTimestamp()
            - $this->startedAt->getTimestamp();
    }

    public function processed(): int
    {
        return $this->processed;
    }

    public function failed(): int
    {
        return $this->failed;
    }

    public function skipped(): int
    {
        return $this->skipped;
    }

    /**
     * @return array<string,mixed>
     */
    public function metadata(): array
    {
        return $this->metadata;
    }

    /**
     * @return string[]
     */
    public function warnings(): array
    {
        return $this->warnings;
    }

    /**
     * @return string[]
     */
    public function errors(): array
    {
        return $this->errors;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function isSuccessful(): bool
    {
        return $this->status === PipelineStatus::Completed;
    }

    public function isFailed(): bool
    {
        return $this->status === PipelineStatus::Failed;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'execution_id' => $this->executionId,
            'pipeline' => $this->pipeline,
            'description' => $this->description,
            'status' => $this->status->value,
            'message' => $this->message,

            'started_at' => $this->startedAt->format(DATE_ATOM),
            'finished_at' => $this->finishedAt->format(DATE_ATOM),
            'duration_seconds' => $this->durationInSeconds(),

            'processed' => $this->processed,
            'failed' => $this->failed,
            'skipped' => $this->skipped,

            'progress' => $this->progress->toArray(),

            'metadata' => $this->metadata,
            'warnings' => $this->warnings,
            'errors' => $this->errors,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}