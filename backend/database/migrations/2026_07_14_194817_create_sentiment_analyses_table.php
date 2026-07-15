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
        Schema::create('sentiment_analyses', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            $table->foreignId('clean_article_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | FinBERT Result
            |--------------------------------------------------------------------------
            */

            $table->decimal('positive_score', 8, 6);

            $table->decimal('neutral_score', 8, 6);

            $table->decimal('negative_score', 8, 6);

            $table->string(
                'sentiment_label',
                20
            );

            /*
            |--------------------------------------------------------------------------
            | Model Information
            |--------------------------------------------------------------------------
            */

            $table->string(
                'model_name',
                100
            );

            $table->string(
                'model_version',
                30
            );

            /*
            |--------------------------------------------------------------------------
            | Analysis
            |--------------------------------------------------------------------------
            */

            $table->timestamp(
                'analyzed_at'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sentiment_analyses');
    }
};
