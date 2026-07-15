<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\FullArticle\StoreFullArticleRequest;
use App\Http\Requests\FullArticle\UpdateFullArticleRequest;
use App\Http\Resources\FullArticle\FullArticleResource;
use App\Services\FullArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FullArticleController extends BaseApiController
{
    public function __construct(
        private readonly FullArticleService $service
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Display a paginated list of full articles.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'download_status',
            ]
        );

        $fullArticles = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request),
        );

        return $this->paginated(
            FullArticleResource::collection(
                $fullArticles
            )
        );
    }

    /**
     * Store a newly created full article.
     */
    public function store(
        StoreFullArticleRequest $request
    ): JsonResponse {

        $fullArticle = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new FullArticleResource(
                $fullArticle
            )
        );
    }

    /**
     * Display a single full article.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $fullArticle = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new FullArticleResource(
                $fullArticle
            )
        );
    }

    /**
     * Update an existing full article.
     */
    public function update(
        UpdateFullArticleRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        return $this->updated(
            new FullArticleResource(
                $this->service->findByUuid($uuid)
            )
        );
    }

    /**
     * Delete a full article.
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