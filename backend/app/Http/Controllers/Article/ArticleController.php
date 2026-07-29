<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleIndexRequest;
use App\Services\Article\ArticleDashboardService;
use App\Services\Article\ArticleQueryService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleDashboardService $dashboardService,
        private readonly ArticleQueryService $queryService,
    ) {
    }

    public function index(
        ArticleIndexRequest $request,
    ): View {

        return view(
            'pages.article.index',
            [
                'dashboard' => $this->dashboardService
                    ->build($request),
            ],
        );
    }

    public function show(
        string $uuid,
    ): View {

        $article = $this->queryService
            ->findByUuid($uuid);

        if ($article === null) {
            throw new NotFoundHttpException();
        }

        return view(
            'pages.article.show',
            [
                'article' => $article,
            ],
        );
    }
}