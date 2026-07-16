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
        Schema::create('system_health_histories', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            /*
            |--------------------------------------------------------------------------
            | Overall Status
            |--------------------------------------------------------------------------
            */

            $table->string(
                'overall_status'
            );

            $table->boolean(
                'is_healthy'
            )->default(true);

            $table->unsignedInteger(
                'health_score'
            )->default(100);

            /*
            |--------------------------------------------------------------------------
            | Component Status
            |--------------------------------------------------------------------------
            */

            $table->string(
                'database_status'
            );

            $table->string(
                'storage_status'
            );

            $table->string(
                'scheduler_status'
            );

            $table->string(
                'python_status'
            );

            $table->string(
                'pipeline_status'
            );

            /*
            |--------------------------------------------------------------------------
            | Performance
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'response_time_ms'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Details
            |--------------------------------------------------------------------------
            */

            $table->json(
                'details'
            )->nullable();

            $table->text(
                'error_message'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Time
            |--------------------------------------------------------------------------
            */

            $table->timestamp(
                'checked_at'
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
            'system_health_histories'
        );
    }
};