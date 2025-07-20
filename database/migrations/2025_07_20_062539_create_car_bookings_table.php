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
        Schema::create('car_bookings', function (Blueprint $table) {
            $table->id();
    
            // Customer Info
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedTinyInteger('driver_age');
            $table->string('mobile');
            $table->string('email');
            $table->text('special_requests')->nullable();
        
            // Booking Info
            $table->string('pickup_location');
            $table->dateTime('pickup_date');
            $table->string('return_location');
            $table->dateTime('return_date');
            $table->boolean('same_location')->default(true);
        
            // Car
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
        
            // Addons
            $table->boolean('has_driver')->default(false);
            $table->unsignedTinyInteger('child_seats')->default(0);
        
            // Status
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_bookings');
    }
};
