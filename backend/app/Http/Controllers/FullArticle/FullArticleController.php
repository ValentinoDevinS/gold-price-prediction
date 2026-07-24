<?php

namespace App\Http\Controllers\FullArticle;

use App\Http\Controllers\Controller;
use App\Services\FullArticleService;
use Illuminate\Http\Request;

class FullArticleController extends Controller
{
    public function __construct(
        private readonly FullArticleService $service
    ) {
    }

    /**
     * Display a paginated list of full articles.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'download_status',
        ]);

        $fullArticles = $this->service->getPaginated(
            filters: $filters,
            search: $request->input('search'),
            sort: $request->input('sort'),
            direction: $request->input('direction'),
            perPage: (int) $request->input('per_page', 20),
        );

        return view(
            'full-articles.index',
            compact('fullArticles')
        );
    }

    /**
     * Display a single full article.
     */
    public function show(string $uuid)
    {
        $fullArticle = $this->service->findByUuid($uuid);

        return view(
            'full-articles.show',
            compact('fullArticle')
        );
    }
}