<?php

namespace App\Http\Controllers\PredictionEvaluation;

use App\Http\Controllers\Controller;
use App\Services\PredictionEvaluationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PredictionEvaluationController extends Controller
{
    public function __construct(
        private readonly PredictionEvaluationService $service
    ) {
    }

    public function index(Request $request): View
    {
        $evaluations = $this->service->getPaginated(
            filters: $request->only([
                'actual_price_date',
            ]),
            search: $request->string('search')->toString(),
            sort: $request->string('sort')->toString(),
            direction: $request->string('direction')->toString(),
            perPage: (int) $request->integer('per_page', 20),
        );

        return view(
            'prediction-evaluations.index',
            compact('evaluations')
        );
    }

    public function show(string $uuid): View
    {
        $evaluation = $this->service->findByUuid($uuid);

        return view(
            'prediction-evaluations.show',
            compact('evaluation')
        );
    }
}