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
        Schema::create('feature_snapshots', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            $table->foreignId('sentiment_analysis_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Sentiment Features
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'positive_score',
                8,
                6
            );

            $table->decimal(
                'neutral_score',
                8,
                6
            );

            $table->decimal(
                'negative_score',
                8,
                6
            );

            /*
            |--------------------------------------------------------------------------
            | Article Features
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'word_count'
            );

            $table->unsignedInteger(
                'article_count'
            );

            $table->decimal(
                'average_sentiment',
                8,
                6
            );

            /*
            |--------------------------------------------------------------------------
            | Rolling Features
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'rolling_sentiment_3d',
                8,
                6
            )->nullable();

            $table->decimal(
                'rolling_sentiment_7d',
                8,
                6
            )->nullable();

            $table->decimal(
                'rolling_sentiment_14d',
                8,
                6
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Time Features
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger(
                'weekday'
            );

            $table->unsignedTinyInteger(
                'month'
            );

            $table->unsignedTinyInteger(
                'quarter'
            );

            $table->boolean(
                'is_weekend'
            );

            /*
            |--------------------------------------------------------------------------
            | Gold Market
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'gold_price',
                12,
                2
            )->nullable();

            $table->decimal(
                'gold_change_percent',
                8,
                4
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Optional Features
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'usd_index',
                10,
                4
            )->nullable();

            $table->decimal(
                'etf_flow',
                12,
                2
            )->nullable();

            $table->decimal(
                'trading_volume',
                18,
                2
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            $table->string(
                'feature_version',
                30
            );

            $table->date(
                'snapshot_date'
            );

            $table->timestamp(
                'generated_at'
            );

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_snapshots');
    }
};
