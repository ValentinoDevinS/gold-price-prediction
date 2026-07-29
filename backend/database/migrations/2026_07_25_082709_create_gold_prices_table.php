<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gold_prices', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->date('price_date')->unique();

            $table->decimal('open_price', 12, 4);

            $table->decimal('high_price', 12, 4);

            $table->decimal('low_price', 12, 4);

            $table->decimal('close_price', 12, 4);

            $table->decimal('adjusted_close_price', 12, 4);

            $table->unsignedBigInteger('volume');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gold_prices');
    }
};