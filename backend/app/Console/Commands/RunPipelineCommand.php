<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Pipeline\IngestionPipelineService;
use Illuminate\Console\Command;
use Throwable;

final class RunPipelineCommand extends Command
{
    protected $signature = 'pipeline:run';

    protected $description = 'Run the complete gold prediction pipeline.';

    public function __construct(
        private readonly IngestionPipelineService $pipeline,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Starting pipeline...');

        try {

            $result = $this->pipeline->run();

            foreach ($result->stages() as $stage) {

                $this->line(sprintf(
                    '%s : %s',
                    $stage->name(),
                    $stage->status()->value,
                ));

            }

            $this->info('Pipeline completed.');

            return self::SUCCESS;

        } catch (Throwable $exception) {

            report($exception);

            $this->error($exception->getMessage());

            return self::FAILURE;

        }
    }
}