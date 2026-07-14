<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseApiController extends Controller
{
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200
    ): JsonResponse {

        return ApiResponse::success(
            $data,
            $message,
            $status
        );

    }

    protected function created(
        mixed $data,
        string $message = 'Created successfully.'
    ): JsonResponse {

        return $this->success(
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

    protected function updated(
        mixed $data = null,
        string $message = 'Updated successfully.'
    ): JsonResponse {

        return $this->success(
            $data,
            $message
        );

    }

    protected function deleted(
        string $message = 'Deleted successfully.'
    ): JsonResponse {

        return $this->success(
            null,
            $message
        );

    }

    protected function paginated(
        mixed $data,
        string $message = 'Success'
    ): JsonResponse {

        return ApiResponse::success(
            $data,
            $message
        );

    }

    protected function noContent(): JsonResponse
    {
        return response()->json(
            null,
            204
        );
    }

    /**
     * Extract allowed filter parameters from the request.
     */
    protected function filters(
        Request $request,
        array $allowed
    ): array {

        return array_filter(

            $request->only($allowed),

            static fn ($value) => $value !== null && $value !== ''

        );

    }

    /**
     * Get requested page size.
     */
    protected function perPage(
        Request $request,
        int $default = 20
    ): int {

        return (int) $request->input(
            'per_page',
            $default
        );

    }

    /**
     * Get search keyword.
     */
    protected function search(
        Request $request
    ): ?string {

        return $request->input(
            'search'
        );

    }

    /**
     * Get requested sort column.
     */
    protected function sort(
        Request $request
    ): ?string {

        return $request->input(
            'sort'
        );

    }

    /**
     * Get requested sort direction.
     */
    protected function direction(
        Request $request
    ): ?string {

        return $request->input(
            'direction'
        );

    }
}