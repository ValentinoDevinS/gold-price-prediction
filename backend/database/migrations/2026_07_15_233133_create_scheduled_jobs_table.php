<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_jobs', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            /*
            |--------------------------------------------------------------------------
            | Identity
            |--------------------------------------------------------------------------
            */

            $table->string(
                'job_key'
            )->unique();

            $table->string(
                'job_name'
            );

            $table->string(
                'job_group'
            );

            $table->unsignedSmallInteger(
                'display_order'
            )->default(1);

            /*
            |--------------------------------------------------------------------------
            | Schedule
            |--------------------------------------------------------------------------
            */

            $table->enum(
                'schedule_type',
                [
                    'manual',
                    'hourly',
                    'daily',
                    'weekly',
                    'monthly',
                    'custom',
                ]
            );

            $table->unsignedInteger(
                'interval_value'
            )->nullable();

            $table->string(
                'cron_expression'
            )->nullable();

            $table->time(
                'run_time'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Execution
            |--------------------------------------------------------------------------
            */

            $table->boolean(
                'is_enabled'
            )->default(true);

            $table->enum(
                'state',
                [
                    'IDLE',
                    'QUEUED',
                    'RUNNING',
                    'SUCCESS',
                    'FAILED',
                ]
            )->default('IDLE');

            /*
            |--------------------------------------------------------------------------
            | Runtime
            |--------------------------------------------------------------------------
            */

            $table->timestamp(
                'last_run_at'
            )->nullable();

            $table->timestamp(
                'next_run_at'
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'scheduled_jobs'
        );
    }
};