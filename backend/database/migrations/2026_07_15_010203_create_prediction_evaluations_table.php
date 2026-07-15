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
        Schema::create('prediction_evaluations', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            /*
            |--------------------------------------------------------------------------
            | Relationships
            |--------------------------------------------------------------------------
            */

            $table->foreignId('prediction_result_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('ensemble_result_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Ground Truth
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'actual_price',
                12,
                2
            );

            $table->date(
                'actual_price_date'
            );

            /*
            |--------------------------------------------------------------------------
            | Error Metrics
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'absolute_error',
                12,
                6
            );

            $table->decimal(
                'squared_error',
                18,
                6
            );

            $table->decimal(
                'percentage_error',
                10,
                6
            );

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            $table->timestamp(
                'evaluated_at'
            );

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'prediction_evaluations'
        );
    }
};