<?php

declare(strict_types=1);

namespace App\Services\Pipeline\Contracts;

use App\Services\Pipeline\DTO\PipelineResult;

/**
 * Defines the contract that every pipeline must implement.
 *
 * A pipeline represents a complete business workflow such as
 * ingestion, prediction, evaluation, or system health checking.
 */
interface PipelineInterface
{
    /**
     * Returns the unique pipeline identifier.
     *
     * Example:
     *  - ingestion
     *  - prediction
     *  - evaluation
     *  - health
     */
    public function name(): string;

    /**
     * Returns a human-readable pipeline description.
     */
    public function description(): string;

    /**
     * Executes the pipeline.
     */
    public function execute(): PipelineResult;
}