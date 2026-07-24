<?php

namespace App\Http\Controllers\EnsembleResult;

use App\Http\Controllers\Controller;
use App\Services\EnsembleResultService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EnsembleResultController extends Controller
{
    public function __construct(
        private readonly EnsembleResultService $service
    ) {
    }

    /**
     * Display a listing of ensemble results.
     */
    public function index(Request $request): View
    {
        $ensembleResults = $this->service->getPaginated(
            filters: $request->only([
                'ensemble_method',
                'prediction_date',
            ]),
            search: $request->input('search'),
            sort: $request->input('sort'),
            direction: $request->input('direction'),
            perPage: (int) $request->input('per_page', 20),
        );

        return view('ensemble-results.index', [
            'ensembleResults' => $ensembleResults,
        ]);
    }

    /**
     * Display the specified ensemble result.
     */
    public function show(string $uuid): View
    {
        $ensembleResult = $this->service->findByUuid($uuid);

        return view('ensemble-results.show', [
            'ensembleResult' => $ensembleResult,
        ]);
    }
}