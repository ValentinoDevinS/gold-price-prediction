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

            $table->string('model_name',100);

            $table->string('model_version',20);

            $table->enum('model_type',[
                'LSTM',
                'CNN',
                'ANN'
            ]);

            $table->enum('status',[
                'ACTIVE',
                'INACTIVE',
                'ARCHIVED'
            ])->default('INACTIVE');

            $table->date('trained_from');

            $table->date('trained_until');

            $table->integer('dataset_size');

            $table->decimal('training_time',10,2);

            $table->string('model_hash',64)->unique();

            $table->string('model_path');

            $table->string('scaler_path')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('model_registries');
    }
};
