<?php

declare(strict_types=1);

namespace App\Http\Controllers\FullArticle;

use App\Http\Controllers\Controller;
use App\Services\FullArticle\FullArticleDashboardService;
use App\Services\FullArticle\FullArticleQueryService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class FullArticleController extends Controller
{
    public function __construct(
        private readonly FullArticleDashboardService $dashboardService,
        private readonly FullArticleQueryService $queryService,
    ) {
    }

    public function index(
        Request $request,
    ): View {

        return view(
            'pages.full-article.index',
            [
                'dashboard' => $this->dashboardService->build($request),
            ],
        );

    }

    public function show(
        string $uuid,
    ): View {

        $fullArticle = $this->queryService
            ->findByUuid($uuid);

        if ($fullArticle === null) {
            throw new NotFoundHttpException();
        }

        return view(
            'pages.full-article.show',
            [
                'fullArticle' => $fullArticle,
            ],
        );

    }
}