<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends BaseApiController
{
    public function __construct(
        private readonly ArticleService $service
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | CRUD
    |--------------------------------------------------------------------------
    */

    /**
     * Display a paginated list of articles.
     */
    public function index(
        Request $request
    ): JsonResponse {

        $filters = $this->filters(
            $request,
            [
                'status',
                'source',
                'country',
                'language',
                'scraper',
            ]
        );

        $articles = $this->service->getPaginated(
            filters: $filters,
            search: $this->search($request),
            sort: $this->sort($request),
            direction: $this->direction($request),
            perPage: $this->perPage($request)
        );

        return $this->paginated(
            ArticleResource::collection(
                $articles
            )
        );

    }

    /**
     * Store a newly created article.
     */
    public function store(
        StoreArticleRequest $request
    ): JsonResponse {

        $article = $this->service->create(
            $request->validated()
        );

        return $this->created(
            new ArticleResource(
                $article
            )
        );

    }

    /**
     * Display a single article.
     */
    public function show(
        string $uuid
    ): JsonResponse {

        $article = $this->service
            ->findByUuid($uuid);

        return $this->success(
            new ArticleResource(
                $article
            )
        );

    }

    /**
     * Update an existing article.
     */
    public function update(
        UpdateArticleRequest $request,
        string $uuid
    ): JsonResponse {

        $this->service->update(
            $uuid,
            $request->validated()
        );

        $article = $this->service
            ->findByUuid($uuid);

        return $this->updated(
            new ArticleResource(
                $article
            )
        );

    }

    /**
     * Remove an article.
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