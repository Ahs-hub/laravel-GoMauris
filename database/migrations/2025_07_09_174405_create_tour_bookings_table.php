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
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();

            // Tour Info
            $table->string('tour_type');        // e.g., catamaran, dolphin, etc.
            $table->date('tour_date');          // date of the booking
    
            // Participants
            $table->unsignedInteger('adults');
            $table->unsignedInteger('children')->default(0);

            // Relationship to tour (after id)
            $table->unsignedBigInteger('tour_id')->after('id'); // or after whichever column you want
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
    
            // Transport
            $table->enum('transport_required', ['yes', 'no']);
    
            // Hotel details
            $table->string('hotel_name')->nullable();
            $table->string('room_number')->nullable();
    
            // Lunch preferences
            $table->unsignedInteger('lunch_non_veg')->default(0);
            $table->unsignedInteger('lunch_veg')->default(0);
    
            // Special requests
            $table->text('special_requests')->nullable();
    
            // Personal info
            $table->string('full_name');
            $table->string('email');
            $table->string('country');
            $table->string('phone');

            // Status of book bouking
            $table->enum('status', ['pending', 'confirmed', 'cancelled','completed'])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid','refund'])->default('unpaid');

             // Price & Payment
            $table->decimal('total_amount', 10, 2)->default(0);   // total = per-day * days
            $table->string('currency', 3)->default('EUR');        // default currency
            $table->string('payment_method')->nullable();         // e.g., 'card', 'paypal'
            $table->string('transaction_id')->nullable();         // gateway reference
            $table->timestamp('paid_at')->nullable();             // when payment confirmed

            $table->text('admin_comment')->nullable(); // <- admin comment field
    
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_bookings');
    }
};
