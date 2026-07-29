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
        Schema::create('pipeline_schedules', function (Blueprint $table): void {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('stage', 50)->unique();

            $table->string('depends_on', 50)->nullable();

            $table->boolean('enabled')->default(true);

            $table->time('run_at');

            $table->unsignedInteger('max_wait_minutes')->default(30);

            $table->timestamps();

            $table->index('stage');

            $table->index('depends_on');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pipeline_schedules');
    }
};