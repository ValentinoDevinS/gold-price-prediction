<?php

declare(strict_types=1);

namespace App\Services\Pipeline\Registry;

use App\Services\Pipeline\Contracts\PipelineInterface;

final class PipelineConfiguration
{
    public function __construct(
        private readonly PipelineInterface $pipeline,
        private readonly bool $enabled = true,
        private readonly bool $manual = true,
        private readonly bool $automatic = true,
        private readonly int $order = 1,
    ) {
    }

    public function pipeline(): PipelineInterface
    {
        return $this->pipeline;
    }

    public function name(): string
    {
        return $this->pipeline->name();
    }

    public function description(): string
    {
        return $this->pipeline->description();
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function manual(): bool
    {
        return $this->manual;
    }

    public function automatic(): bool
    {
        return $this->automatic;
    }

    public function order(): int
    {
        return $this->order;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name(),
            'description' => $this->description(),
            'enabled' => $this->enabled,
            'manual' => $this->manual,
            'automatic' => $this->automatic,
            'order' => $this->order,
        ];
    }
}