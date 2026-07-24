<?php

namespace App\Http\Controllers\SentimentAnalysis;

use App\Http\Controllers\Controller;
use App\Services\SentimentAnalysisService;
use Illuminate\Http\Request;

class SentimentAnalysisController extends Controller
{
    public function __construct(
        private readonly SentimentAnalysisService $service
    ) {
    }

    /**
     * Display a paginated list of sentiment analyses.
     */
    public function index(Request $request)
    {
        $sentiments = $this->service->getPaginated(
            filters: array_filter([
                'sentiment_label' => $request->input('sentiment_label'),
                'model_name'      => $request->input('model_name'),
            ]),
            search: null,
            sort: $request->input('sort'),
            direction: $request->input('direction'),
            perPage: (int) $request->input('per_page', 20),
        );

        return view(
            'sentiment-analyses.index',
            compact('sentiments')
        );
    }

    /**
     * Display a single sentiment analysis.
     */
    public function show(string $uuid)
    {
        $sentiment = $this->service
            ->findByUuid($uuid);

        return view(
            'sentiment-analyses.show',
            compact('sentiment')
        );
    }
}