<?php

namespace App\Exceptions;

use Exception;

abstract class BaseBusinessException extends Exception
{
    protected int $statusCode = 400;

    public function statusCode(): int
    {
        return $this->statusCode;
    }
}