<?php

declare(strict_types=1);

namespace App\Services\Pipeline\Registry;

use InvalidArgumentException;

final class PipelineRegistry
{
    /**
     * @var array<string, PipelineConfiguration>
     */
    private array $pipelines = [];

    /**
     * Register a pipeline configuration.
     *
     * @throws InvalidArgumentException
     */
    public function register(PipelineConfiguration $configuration): self
    {
        $name = $configuration->name();

        if ($this->has($name)) {
            throw new InvalidArgumentException(
                sprintf('Pipeline "%s" is already registered.', $name)
            );
        }

        $this->pipelines[$name] = $configuration;

        return $this;
    }

    /**
     * Determine whether the pipeline exists.
     */
    public function has(string $name): bool
    {
        return isset($this->pipelines[$name]);
    }

    /**
     * Get a pipeline configuration.
     *
     * @throws InvalidArgumentException
     */
    public function get(string $name): PipelineConfiguration
    {
        if (! $this->has($name)) {
            throw new InvalidArgumentException(
                sprintf('Pipeline "%s" is not registered.', $name)
            );
        }

        return $this->pipelines[$name];
    }

    /**
     * Return all registered pipelines.
     *
     * @return PipelineConfiguration[]
     */
    public function all(): array
    {
        $pipelines = array_values($this->pipelines);

        usort(
            $pipelines,
            fn (
                PipelineConfiguration $a,
                PipelineConfiguration $b
            ) => $a->order() <=> $b->order()
        );

        return $pipelines;
    }

    /**
     * Return only enabled pipelines.
     *
     * @return PipelineConfiguration[]
     */
    public function enabled(): array
    {
        return array_values(
            array_filter(
                $this->all(),
                fn (PipelineConfiguration $configuration)
                    => $configuration->enabled()
            )
        );
    }

    /**
     * Return only automatically executable pipelines.
     *
     * @return PipelineConfiguration[]
     */
    public function automatic(): array
    {
        return array_values(
            array_filter(
                $this->enabled(),
                fn (PipelineConfiguration $configuration)
                    => $configuration->automatic()
            )
        );
    }

    /**
     * Return only manually executable pipelines.
     *
     * @return PipelineConfiguration[]
     */
    public function manual(): array
    {
        return array_values(
            array_filter(
                $this->enabled(),
                fn (PipelineConfiguration $configuration)
                    => $configuration->manual()
            )
        );
    }

    /**
     * Total registered pipelines.
     */
    public function count(): int
    {
        return count($this->pipelines);
    }
}