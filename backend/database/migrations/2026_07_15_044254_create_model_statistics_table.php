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
        Schema::create('model_statistics', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            /*
            |--------------------------------------------------------------------------
            | Model
            |--------------------------------------------------------------------------
            */

            $table->string(
                'model_name'
            );

            /*
            |--------------------------------------------------------------------------
            | Ranking
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'ranking_position'
            );

            $table->unsignedInteger(
                'total_predictions'
            )->default(0);

            $table->unsignedInteger(
                'best_prediction_count'
            )->default(0);

            $table->decimal(
                'win_rate',
                8,
                4
            )->default(0);

            /*
            |--------------------------------------------------------------------------
            | Metrics
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'mae',
                12,
                6
            )->default(0);

            $table->decimal(
                'rmse',
                12,
                6
            )->default(0);

            $table->decimal(
                'mape',
                12,
                6
            )->default(0);

            $table->decimal(
                'average_absolute_error',
                12,
                6
            )->default(0);

            $table->decimal(
                'average_percentage_error',
                12,
                6
            )->default(0);

            $table->decimal(
                'difference_from_best',
                12,
                6
            )->default(0);

            /*
            |--------------------------------------------------------------------------
            | Dates
            |--------------------------------------------------------------------------
            */

            $table->date(
                'latest_prediction_date'
            )->nullable();

            $table->timestamp(
                'calculated_at'
            )->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'model_statistics'
        );
    }
};