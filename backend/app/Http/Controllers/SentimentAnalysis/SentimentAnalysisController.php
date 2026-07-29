<?php

declare(strict_types=1);

namespace App\Http\Controllers\SentimentAnalysis;

use App\Http\Controllers\Controller;
use App\Http\Requests\SentimentAnalysis\SentimentAnalysisIndexRequest;
use App\Http\Requests\SentimentAnalysis\SentimentAnalysisShowRequest;
use App\Services\SentimentAnalysis\SentimentAnalysisDashboardService;
use App\Services\SentimentAnalysis\SentimentAnalysisQueryService;

final class SentimentAnalysisController extends Controller
{
    public function __construct(
        private readonly SentimentAnalysisDashboardService $dashboardService,
        private readonly SentimentAnalysisQueryService $queryService,
    ) {
    }

    /**
     * Display sentiment analysis dashboard.
     */
    public function index(
        SentimentAnalysisIndexRequest $request,
    ) {

        $dashboard = $this->dashboardService
            ->getDashboard(

                perPage: (int) $request->validated(
                    'per_page',
                    20,
                ),

            );

        return view(
            'sentiment.index',
            compact('dashboard'),
        );
    }

    /**
     * Display sentiment analysis details.
     */
    public function show(
        SentimentAnalysisShowRequest $request,
        string $uuid,
    ) {

        $sentiment = $this->queryService
            ->findByUuid($uuid);

        abort_if(
            $sentiment === null,
            404,
        );

        return view(
            'sentiment.show',
            compact('sentiment'),
        );
    }
}