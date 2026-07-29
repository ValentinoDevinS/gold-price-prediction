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
        Schema::create('system_settings', function (Blueprint $table): void {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('category', 100)->index();

            $table->string('key', 100)->unique();

            $table->string('label', 150);

            $table->text('description')->nullable();

            $table->text('value')->nullable();

            $table->string('type', 50);

            $table->json('options')->nullable();

            $table->boolean('is_editable')->default(true);

            $table->timestamps();

            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};