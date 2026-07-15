<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\CleanArticle\StoreCleanArticleRequest;
use App\Http\Requests\CleanArticle\UpdateCleanArticleRequest;
use App\Http\Resources\CleanArticle\CleanArticleResource;
use App\Services\CleanArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CleanArticleController extends BaseApiController
{
    public function __construct(
        private readonly CleanArticleService $service
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Display a paginated list of Clean Article.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'language',
                'processing_status',
            ]
        );

        $cleanArticle = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request),
        );

        return $this->paginated(
            CleanArticleResource::collection(
                $cleanArticle
            )
        );
    }

    /**
     * Store a newly created Clean Article.
     */
    public function store(
        StoreCleanArticleRequest $request
    ): JsonResponse {

        $cleanArticle = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new CleanArticleResource(
                $cleanArticle
            )
        );
    }

    /**
     * Display a single Clean Article.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $cleanArticle = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new CleanArticleResource(
                $cleanArticle
            )
        );
    }

    /**
     * Update an existing Clean Article.
     */
    public function update(
        UpdateCleanArticleRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        return $this->updated(
            new CleanArticleResource(
                $this->service->findByUuid($uuid)
            )
        );
    }

    /**
     * Delete a Clean Article.
     */
    public function destroy(
        string $uuid
    ): JsonResponse {

        $this->service->delete(
            $uuid
        );

        return $this->deleted();
    }
}
