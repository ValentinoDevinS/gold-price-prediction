<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Throwable;

abstract class BaseService
{
    protected function execute(callable $callback)
    {
        try {

            return DB::transaction($callback);

        } catch (Throwable $exception) {

            report($exception);

            throw $exception;

        }
    }
}