<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService
    ) {
    }

    public function store(StoreArticleRequest $request)
    {
        $article = $this->articleService->register(
            $request->validated()
        );

        if (!$article) {

            return ApiResponse::error(
                'Article already exists.',
                409
            );

        }

        return ApiResponse::success(
            new ArticleResource($article),
            'Article created successfully.',
            201
        );
    }
}