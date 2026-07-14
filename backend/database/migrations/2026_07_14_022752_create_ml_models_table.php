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
        Schema::create('ml_models', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('model_name');

            $table->string('model_version');

            $table->enum('model_type', [
                'LSTM',
                'CNN',
                'ANN'
            ]);

            $table->string('model_path');

            $table->string('scaler_path')->nullable();

            $table->boolean('is_active')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('model_registries');
    }
};
