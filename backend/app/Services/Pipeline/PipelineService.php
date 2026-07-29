<?php

declare(strict_types=1);

namespace App\Services\Pipeline;

use App\Services\Pipeline\DTO\PipelineResult;
use App\Services\Pipeline\Registry\PipelineConfiguration;
use App\Services\Pipeline\Registry\PipelineRegistry;
use InvalidArgumentException;

final class PipelineService
{
    public function __construct(
        private readonly PipelineRegistry $registry,
    ) {
    }

    /**
     * Execute a pipeline by name.
     *
     * @throws InvalidArgumentException
     */
    public function run(string $name): PipelineResult
    {
        $configuration = $this->registry->get($name);

        $this->ensureEnabled($configuration);

        return $configuration
            ->pipeline()
            ->execute();
    }

    /**
     * Execute all automatic pipelines.
     *
     * @return PipelineResult[]
     */
    public function runAll(): array
    {
        $results = [];

        foreach ($this->registry->automatic() as $configuration) {
            $results[] = $configuration
                ->pipeline()
                ->execute();
        }

        return $results;
    }

    /**
     * Return all registered pipeline configurations.
     *
     * @return PipelineConfiguration[]
     */
    public function available(): array
    {
        return $this->registry->all();
    }

    /**
     * Ensure a pipeline is enabled.
     */
    private function ensureEnabled(
        PipelineConfiguration $configuration
    ): void {
        if (! $configuration->enabled()) {
            throw new InvalidArgumentException(
                sprintf(
                    'Pipeline "%s" is disabled.',
                    $configuration->name()
                )
            );
        }
    }
}