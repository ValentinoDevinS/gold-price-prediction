<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleService $articleService,
    ) {
    }

    /**
     * Display a listing of articles.
     */
    public function index(Request $request): View
    {
        $articles = $this->articleService->getPaginated(
            filters: [
                'status' => $request->string('status')->toString(),
                'source' => $request->string('source')->toString(),
                'country' => $request->string('country')->toString(),
                'language' => $request->string('language')->toString(),
                'scraper' => $request->string('scraper')->toString(),
            ],
            search: $request->string('search')->toString(),
            sort: $request->string('sort')->toString() ?: null,
            direction: $request->string('direction')->toString() ?: null,
            perPage: (int) $request->integer('per_page', 20),
        );

        return view(
            'articles.index',
            [

                'articles' => $articles,

                'statistics' => $this
                    ->articleService
                    ->statistics(),

            ]
        );
    }

    /**
     * Display a single article.
     */
    public function show(
        string $uuid
    ): View
    {
        return view(
            'articles.show',
            [
                'article' => $this->articleService
                    ->findPipelineOrFailByUuid($uuid),
            ]
        );
    }
}