<?php

declare(strict_types=1);

namespace App\Services\Process;

use App\Exceptions\Python\PythonProcessException;
use JsonException;
use Symfony\Component\Process\Process;

final class PythonProcessService
{
    /**
     * Execute a Python service.
     *
     * @param array<int, string> $arguments
     * @param array<string, mixed>|array<int, mixed>|null $input
     *
     * @return array<string, mixed>|array<int, mixed>
     *
     * @throws PythonProcessException
     */
    public function run(
        string $script,
        array $arguments = [],
        ?array $input = null,
    ): array {

        $command = array_merge(
            [
                config('python.executable'),
                config('python.services_path')
                    . DIRECTORY_SEPARATOR
                    . $script,
            ],
            $arguments
        );

        $process = new Process($command);

        $process->setTimeout(
            config('python.timeout')
        );

        $process->setWorkingDirectory(
            config('python.working_directory')
        );

        if ($input !== null) {
            try {
                $process->setInput(
                    json_encode(
                        $input,
                        JSON_THROW_ON_ERROR
                    )
                );
            } catch (JsonException $exception) {
                throw new PythonProcessException(
                    'Unable to encode JSON input.',
                    previous: $exception
                );
            }
        }

        $process->run();

        if (! $process->isSuccessful()) {
            throw new PythonProcessException(
                sprintf(
                    "Python service [%s] failed.\n\n%s",
                    $script,
                    trim($process->getErrorOutput())
                )
            );
        }

        $output = trim(
            $process->getOutput()
        );

        if ($output === '') {
            return [];
        }

        try {
            $decoded = json_decode(
                $output,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (JsonException $exception) {
            throw new PythonProcessException(
                sprintf(
                    'Python service [%s] returned invalid JSON.',
                    $script
                ),
                previous: $exception
            );
        }

        if (! is_array($decoded)) {
            throw new PythonProcessException(
                sprintf(
                    'Python service [%s] did not return a JSON object or array.',
                    $script
                )
            );
        }

        return $decoded;
    }
}