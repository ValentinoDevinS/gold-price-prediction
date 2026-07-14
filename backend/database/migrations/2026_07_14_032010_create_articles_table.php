<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('title',500);

            $table->string('url',1000)->unique();

            $table->string('source',100);

            $table->timestamp('published_at')->nullable();

            $table->string('language',20)->default('en');

            $table->string('country',50)->nullable();

            $table->string('keyword',100);

            $table->string('scraper',100);

            $table->enum('status',[
                'NEW',
                'DOWNLOADED',
                'FAILED',
                'SKIPPED'
            ])->default('NEW');

            $table->timestamp('scraped_at');

            $table->timestamps();

            // ---------- INDEX ----------
            $table->index('published_at');
            $table->index('status');
            $table->index('source');
            $table->index('keyword');
            $table->index('country');

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
