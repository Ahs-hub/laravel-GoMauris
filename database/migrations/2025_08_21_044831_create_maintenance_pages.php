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
        Schema::create('maintenance_pages', function (Blueprint $table) {
            $table->id();

            $table->string('page_name');   // e.g. "tours", "car_rental", "contact"
            $table->boolean('is_active')->default(true); // true = online, false = maintenance

            // ✅ Maintenance message and toggle
            $table->string('maintenance_message')->nullable(); 
            $table->boolean('show_message')->default(false); 

            // ✅ Schedule maintenance times
            $table->timestamp('maintenance_start')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_pages');
    }
};
