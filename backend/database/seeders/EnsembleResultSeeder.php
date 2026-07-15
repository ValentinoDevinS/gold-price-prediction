<?php

namespace Database\Seeders;

use App\Models\FeatureSnapshot;
use App\Services\EnsembleResultService;
use Illuminate\Database\Seeder;

class EnsembleResultSeeder extends Seeder
{
    public function run(): void
    {
        $service = app(
            EnsembleResultService::class
        );

        FeatureSnapshot::all()->each(

            function ($featureSnapshot) use ($service) {

                $service->generateFromFeatureSnapshot(
                    $featureSnapshot->uuid
                );

            }

        );
    }
}