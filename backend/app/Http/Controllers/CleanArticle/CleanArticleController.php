<?php

declare(strict_types=1);

namespace App\Http\Controllers\CleanArticle;

use App\Http\Controllers\Controller;
use App\Http\Requests\CleanArticle\CleanArticleIndexRequest;
use App\Services\CleanArticle\CleanArticleDashboardService;
use App\Services\CleanArticle\CleanArticleQueryService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class CleanArticleController extends Controller
{
    public function __construct(
        private readonly CleanArticleDashboardService $dashboardService,
        private readonly CleanArticleQueryService $queryService,
    ) {
    }

    /**
     * Display a listing of clean articles.
     */
    public function index(
        CleanArticleIndexRequest $request,
    ): View {

        return view(
            'clean-articles.index',
            [
                'dashboard' => $this->dashboardService
                    ->dashboard($request),
            ]
        );
    }

    /**
     * Display the specified clean article.
     */
    public function show(
        string $uuid,
    ): View {

        $cleanArticle = $this->queryService
            ->findByUuid($uuid);

        if ($cleanArticle === null) {
            throw new NotFoundHttpException();
        }

        return view(
            'clean-articles.show',
            [
                'cleanArticle' => $cleanArticle,
            ]
        );
    }
}