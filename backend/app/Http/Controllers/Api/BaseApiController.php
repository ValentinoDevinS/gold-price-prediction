<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class BaseApiController extends Controller
{
    protected function success(
        mixed $data = null,
        string $message = 'Success'
    ): JsonResponse {

        return ApiResponse::success(
            $data,
            $message
        );
    }

    protected function created(
        mixed $data,
        string $message = 'Created successfully.'
    ): JsonResponse {

        return ApiResponse::success(
            $data,
            $message,
            201
        );
    }

    protected function error(
        string $message,
        int $status = 400,
        mixed $errors = null
    ): JsonResponse {

        return ApiResponse::error(
            $message,
            $status,
            $errors
        );
    }

    protected function notFound(
        string $message = 'Resource not found.'
    ): JsonResponse {

        return ApiResponse::error(
            $message,
            404
        );
    }
}