<?php

namespace App\Services;

use App\Models\ScheduledJob;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PythonProcessService
{
    /**
     * Default timeout (seconds).
     */
    private int $timeout;

    /**
     * Python executable.
     *
     * Change this if using a virtual environment.
     */
    private string $pythonExecutable;

    public function __construct()
    {
        $this->pythonExecutable = config(
            'python.executable',
            'python3'
        );

        $this->timeout = config(
            'python.timeout',
            600
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    /**
     * Determine whether Python is installed.
     */
    public function isPythonInstalled(): bool
    {
        $process = new Process([

            $this->pythonExecutable,

            '--version',

        ]);

        $process->run();

        return $process->isSuccessful();
    }

    /**
     * Python version.
     */
    public function pythonVersion(): ?string
    {
        $process = new Process([

            $this->pythonExecutable,

            '--version',

        ]);

        $process->run();

        if (! $process->isSuccessful()) {

            return null;

        }

        return trim(

            $process->getOutput()

                ?: $process->getErrorOutput()

        );
    }

    /**
     * Execute one Python script.
     */
    public function runScript(
        string $script,
        array $arguments = []
    ): array {

        $command = array_merge(

            [

                $this->pythonExecutable,

                $script,

            ],

            $arguments

        );

        return $this->execute(

            $command

        );

    }

    /**
     * Execute multiple scripts sequentially.
     */
    public function runPipeline(
        array $scripts
    ): array {

        $results = [];

        foreach (

            $scripts

            as

            $script

        ) {

            $result =

                $this->runScript(

                    $script

                );

            $results[] = $result;

            if (

                ! $result['success']

            ) {

                return [

                    'success' => false,

                    'results' => $results,

                    'failed_step' => $script,

                ];

            }

        }

        return [

            'success' => true,

            'results' => $results,

        ];

    }

    /**
     * Execute one scheduled job.
     */
    public function runJob(
        string $jobKey
    ): array
    {
        return match ($jobKey) {

            ScheduledJob::SCRAPER

                =>

                $this->runScript(

                    $this->scriptPath(

                        'scraper-service/scraper.py'

                    )

                ),

            ScheduledJob::DOWNLOADER

                =>

                $this->runScript(

                    $this->scriptPath(

                        'downloader-service/downloader.py'

                    )

                ),

            ScheduledJob::CLEANER

                =>

                $this->runScript(

                    $this->scriptPath(

                        'cleaner-service/cleaner.py'

                    )

                ),

            ScheduledJob::FINBERT

                =>

                $this->runScript(

                    $this->scriptPath(

                        'finbert-service/finbert.py'

                    )

                ),

            ScheduledJob::FEATURE

                =>

                $this->runScript(

                    $this->scriptPath(

                        'feature-service/feature_engineering.py'

                    )

                ),

            ScheduledJob::GOLD_PRICE

                =>

                $this->runScript(

                    $this->scriptPath(

                        'gold-price-service/gold_price_loader.py'

                    )

                ),

            ScheduledJob::LSTM

                =>

                $this->runScript(

                    $this->scriptPath(

                        'lstm-service/lstm_model.py'

                    )

                ),

            ScheduledJob::CNN

                =>

                $this->runScript(

                    $this->scriptPath(

                        'cnn-service/cnn_model.py'

                    )

                ),

            ScheduledJob::ANN

                =>

                $this->runScript(

                    $this->scriptPath(

                        'ann-service/ann_model.py'

                    )

                ),

            ScheduledJob::PREDICTION

                =>

                $this->runScript(

                    $this->scriptPath(

                        'predict-service/predict.py'

                    )

                ),

            ScheduledJob::EVALUATION

                =>

                [

                    'success' => false,

                    'status' => 'NOT_IMPLEMENTED',

                    'message'

                        =>

                        'Evaluation service has not been implemented.',

                ],

            ScheduledJob::HEALTH

                =>

                [

                    'success' => false,

                    'status' => 'NOT_IMPLEMENTED',

                    'message'

                        =>

                        'Health service is handled by Laravel.',

                ],

            ScheduledJob::SELF_TEST

                =>

                [

                    'success' => false,

                    'status' => 'NOT_IMPLEMENTED',

                    'message'

                        =>

                        'Self-test service has not been implemented.',

                ],

            default

                =>

                [

                    'success' => false,

                    'status' => 'UNKNOWN_JOB',

                    'message'

                        =>

                        "Unknown job key: {$jobKey}",

                ],

        };

    }

    /*
    |--------------------------------------------------------------------------
    | Internal Execution
    |--------------------------------------------------------------------------
    */

        /**
     * Execute a command.
     */
    private function execute(
        array $command
    ): array {

        $start = microtime(true);

        $process = new Process($command);

        $process->setTimeout(
            $this->timeout
        );

        try {

            $process->mustRun();

        } catch (ProcessFailedException $exception) {

            return [

                'success' => false,

                'status' => $this->interpretExitCode(

                    $process->getExitCode()

                ),

                'exit_code' => $process->getExitCode(),

                'duration_ms' => $this->duration(

                    $start

                ),

                'stdout' => $process->getOutput(),

                'stderr' => $process->getErrorOutput(),

                'command' => implode(
                    ' ',
                    $command
                ),

                'message' => $exception->getMessage(),

            ];

        }

        return [

            'success' => true,

            'status' => 'SUCCESS',

            'exit_code' => 0,

            'duration_ms' => $this->duration(
                $start
            ),

            'stdout' => $process->getOutput(),

            'stderr' => $process->getErrorOutput(),

            'command' => implode(
                ' ',
                $command
            ),

            'message' => 'Python script executed successfully.',

        ];

    }

    /**
     * Execution duration.
     */
    private function duration(
        float $start
    ): int
    {
        return (int) round(

            (microtime(true) - $start)

            * 1000

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Exit Codes
    |--------------------------------------------------------------------------
    */

        /**
     * Interpret Python exit code.
     */
    private function interpretExitCode(
        ?int $exitCode
    ): string {

        return match ($exitCode) {

            0

                =>

                'SUCCESS',

            1

                =>

                'GENERAL_ERROR',

            2

                =>

                'CONFIGURATION_ERROR',

            3

                =>

                'MISSING_INPUT_DATA',

            4

                =>

                'MODEL_ERROR',

            5

                =>

                'DATABASE_ERROR',

            6

                =>

                'TIMEOUT',

            7

                =>

                'UNKNOWN_ERROR',

            default

                =>

                'UNHANDLED_ERROR',

        };

    }

    /**
     * Get configured scripts path.
     */
    public function scriptsPath(): string
    {
        return config(
            'python.scripts_path'
        );
    }

    /**
     * Build an absolute script path.
     */
    public function scriptPath(
        string $script
    ): string {

        return

            rtrim(

                $this->scriptsPath(),

                DIRECTORY_SEPARATOR

            )

            .

            DIRECTORY_SEPARATOR

            .

            ltrim(

                $script,

                DIRECTORY_SEPARATOR

            );

    }

}