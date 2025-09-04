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
        Schema::create('taxi_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pickup');
            //location lalitude longitude
            $table->decimal('pickup_latitude', 10, 8)->nullable();
            $table->decimal('pickup_longitude', 11, 8)->nullable();

            $table->string('destination');
            //location lalitude longitude
            $table->decimal('destination_latitude', 10, 8)->nullable();
            $table->decimal('destination_longitude', 11, 8)->nullable();
      
            $table->date('date');
            $table->string('time');
            $table->integer('passengers');
            $table->string('category');
            $table->string('name');
            $table->string('email');
            $table->string('country');
            $table->string('phone');
            $table->text('comments')->nullable();

            // 🚖 Return Ride fields
            $table->boolean('has_return_ride')->default(false); // Toggle for return trip
            $table->date('return_date')->nullable();
            $table->string('return_time')->nullable();

            // 🪑 Optional child seat
            $table->integer('child_seat')->default(0);

            $table->enum('status', ['pending', 'confirmed', 'cancelled','completed'])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid' ,'refund'])->default('unpaid');

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
        Schema::dropIfExists('taxi_bookings');
    }
};
