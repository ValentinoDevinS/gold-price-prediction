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
        Schema::create('full_articles', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            $table->foreignId('article_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Raw Download
            |--------------------------------------------------------------------------
            */

            $table->longText('content');

            $table->longText('html')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Metadata
            |--------------------------------------------------------------------------
            */

            $table->string('author')->nullable();

            $table->string(
                'image_url',
                2000
            )->nullable();

            $table->unsignedInteger('word_count')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Download
            |--------------------------------------------------------------------------
            */

            $table->string(
                'download_status',
                30
            );

            $table->timestamp('downloaded_at')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('full_articles');
    }
};
