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
        Schema::create('pipeline_runtime', function (Blueprint $table): void {

            $table->id();

            $table->boolean('pipeline_running')->default(false);

            $table->boolean('stop_requested')->default(false);

            $table->string('current_stage', 50)->nullable();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pipeline_runtime');
    }
};