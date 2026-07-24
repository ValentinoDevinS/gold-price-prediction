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
        Schema::create('job_executions', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            /*
            |--------------------------------------------------------------------------
            | Relationship
            |--------------------------------------------------------------------------
            */

            $table->foreignId('scheduled_job_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Execution Type
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_manual')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Execution Result
            |--------------------------------------------------------------------------
            */

            $table->string('status');

            $table->integer('exit_code')
                ->nullable();

            $table->integer('duration_ms')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Process Output
            |--------------------------------------------------------------------------
            */

            $table->longText('stdout')
                ->nullable();

            $table->longText('stderr')
                ->nullable();

            $table->text('error_message')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Execution Time
            |--------------------------------------------------------------------------
            */

            $table->timestamp('started_at');

            $table->timestamp('finished_at')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_executions');
    }
};