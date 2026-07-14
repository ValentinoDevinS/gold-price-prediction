<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService
    ) {
    }

    public function store(StoreArticleRequest $request): JsonResponse
    {
        $article = $this->articleService->register(
            $request->validated()
        );

        if (!$article) {

            return response()->json([
                'success' => false,
                'message' => 'Article already exists.'
            ], 409);

        }

        return response()->json([
            'success' => true,
            'message' => 'Article registered successfully.',
            'data' => $article
        ], 201);
    }
}