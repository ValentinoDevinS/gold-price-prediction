<?php

declare(strict_types=1);

namespace App\Services\Process\DTO;

use JsonSerializable;

final class ProcessResult implements JsonSerializable
{
    /**
     * Create a new process result.
     */
    public function __construct(
        private readonly int $processed = 0,
        private readonly int $created = 0,
        private readonly int $updated = 0,
        private readonly int $skipped = 0,
        private readonly int $failed = 0,
        private readonly array $warnings = [],
        private readonly array $errors = [],
    ) {
    }

    /**
     * Total processed records.
     */
    public function processed(): int
    {
        return $this->processed;
    }

    /**
     * Total created records.
     */
    public function created(): int
    {
        return $this->created;
    }

    /**
     * Total updated records.
     */
    public function updated(): int
    {
        return $this->updated;
    }

    /**
     * Total skipped records.
     */
    public function skipped(): int
    {
        return $this->skipped;
    }

    /**
     * Total failed records.
     */
    public function failed(): int
    {
        return $this->failed;
    }

    /**
     * Process warnings.
     *
     * @return string[]
     */
    public function warnings(): array
    {
        return $this->warnings;
    }

    /**
     * Process errors.
     *
     * @return string[]
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Determine whether the process completed without failures.
     */
    public function isSuccessful(): bool
    {
        return $this->failed === 0;
    }

    /**
     * Convert the result to an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'processed' => $this->processed,
            'created' => $this->created,
            'updated' => $this->updated,
            'skipped' => $this->skipped,
            'failed' => $this->failed,
            'warnings' => $this->warnings,
            'errors' => $this->errors,
            'successful' => $this->isSuccessful(),
        ];
    }

    /**
     * Convert the result to JSON.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}