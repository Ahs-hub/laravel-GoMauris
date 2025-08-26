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
            $table->string('phone');
            $table->string('email');
            $table->text('special_requests')->nullable();
        
            // Booking Info
            $table->string('pickup_location');
            //location lalitude longitude
            $table->decimal('pickup_latitude', 10, 8)->nullable();
            $table->decimal('pickup_longitude', 11, 8)->nullable();

            $table->dateTime('pickup_date');

            $table->string('return_location');
            //location lalitude longitude
            $table->decimal('return_latitude', 10, 8)->nullable();
            $table->decimal('return_longitude', 11, 8)->nullable();

            $table->dateTime('return_date');
            $table->boolean('same_location')->default(true);
        
            // Car
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
        
            // Addons
            $table->boolean('has_driver')->default(false);
            $table->unsignedTinyInteger('child_seats')->default(0);
        
            // Status
            $table->enum('status', ['pending', 'confirmed', 'cancelled','completed'])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid','refund'])->default('unpaid');

            // Price & Payment
            $table->decimal('total_amount', 10, 2)->default(0);   // total = per-day * days
            $table->string('currency', 3)->default('EUR');        // default currency
            $table->string('payment_method')->nullable();         // e.g., 'card', 'paypal'
            $table->string('transaction_id')->nullable();         // gateway reference
            $table->timestamp('paid_at')->nullable();             // when payment confirmed

            $table->text('admin_comment')->nullable(); // <- admin comment field
        
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
