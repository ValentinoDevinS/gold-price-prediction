<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prediction_results', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            $table->foreignId('feature_snapshot_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Model
            |--------------------------------------------------------------------------
            */

            $table->string(
                'model_name',
                30
            );

            $table->string(
                'model_version',
                30
            );

            /*
            |--------------------------------------------------------------------------
            | Prediction
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'predicted_price',
                12,
                2
            );

            $table->decimal(
                'confidence_score',
                8,
                6
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Prediction Metadata
            |--------------------------------------------------------------------------
            */

            $table->date(
                'prediction_date'
            );

            $table->timestamp(
                'predicted_at'
            );

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediction_results');
    }
};
