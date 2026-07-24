<?php

namespace App\Http\Controllers\PredictionResult;

use App\Http\Controllers\Controller;
use App\Services\PredictionResultService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PredictionResultController extends Controller
{
    public function __construct(
        private readonly PredictionResultService $predictionService,
    ) {
    }

    public function index(
        Request $request
    ): View {

        $predictions = $this->predictionService->getPaginated(

            filters: $request->only([
                'model_name',
                'model_version',
                'prediction_date',
            ]),

            search: $request->input('search'),

            sort: $request->input('sort'),

            direction: $request->input('direction'),

            perPage: (int) $request->input('per_page', 20),

        );

        return view(
            'prediction-results.index',
            compact('predictions')
        );

    }

    public function show(
        string $uuid
    ): View {

        $prediction =

            $this->predictionService
                ->findByUuid(
                    $uuid
                );

        return view(
            'prediction-results.show',
            compact('prediction')
        );

    }
}