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
        Schema::create('clean_articles', function (Blueprint $table) {

            $table->id();

            $table->uuid()->unique();

            $table->foreignId('full_article_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Cleaned Content
            |--------------------------------------------------------------------------
            */

            $table->longText('clean_content');

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('original_word_count');

            $table->unsignedInteger('clean_word_count');

            /*
            |--------------------------------------------------------------------------
            | Processing Metadata
            |--------------------------------------------------------------------------
            */

            $table->string('cleaner_version', 50);

            $table->timestamp('cleaned_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clean_articles');
    }
};
