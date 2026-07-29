<?php

declare(strict_types=1);

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
        Schema::create('pipeline_logs', function (Blueprint $table): void {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('stage', 50);

            $table->string('status', 30);

            $table->timestamp('started_at')->nullable();

            $table->timestamp('finished_at')->nullable();

            $table->unsignedInteger('duration_seconds')->nullable();

            $table->longText('message')->nullable();

            $table->timestamps();

            $table->index('stage');

            $table->index('status');

            $table->index('started_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pipeline_logs');
    }
};