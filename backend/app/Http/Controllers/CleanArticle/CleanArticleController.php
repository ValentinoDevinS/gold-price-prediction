<?php

namespace App\Http\Controllers\CleanArticle;

use App\Http\Controllers\Controller;
use App\Services\CleanArticleService;
use Illuminate\Http\Request;

class CleanArticleController extends Controller
{
    public function __construct(
        private readonly CleanArticleService $service
    ) {
    }

    /**
     * Display a paginated list of clean articles.
     */
    public function index(Request $request)
    {
        $cleanArticles = $this->service->getPaginated(
            search: $request->input('search'),
            sort: $request->input('sort'),
            direction: $request->input('direction'),
            perPage: (int) $request->input('per_page', 20),
        );

        return view(
            'clean-articles.index',
            compact('cleanArticles')
        );
    }

    /**
     * Display a single clean article.
     */
    public function show(string $uuid)
    {
        $cleanArticle = $this->service
            ->findByUuid($uuid);

        return view(
            'clean-articles.show',
            compact('cleanArticle')
        );
    }
}