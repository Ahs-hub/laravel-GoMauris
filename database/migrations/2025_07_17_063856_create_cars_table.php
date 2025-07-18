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

            Schema::create('cars', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('transmission')->nullable();
                $table->string('type')->nullable();
                $table->string('fuel_type')->nullable();
                $table->integer('seats')->nullable();
                $table->integer('doors')->nullable();
                $table->string('model_years')->nullable();
                $table->json('available_colors')->nullable();
                $table->string('engine')->nullable();
                $table->string('consumption')->nullable();
                $table->string('policy')->nullable();
                $table->decimal('price_per_day', 8, 2)->nullable();
                $table->boolean('climate_control')->default(false);
                $table->string('image_path')->nullable(); // ✅ Picture location
                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
