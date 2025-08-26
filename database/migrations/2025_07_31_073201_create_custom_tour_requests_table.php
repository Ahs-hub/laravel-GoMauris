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
        Schema::create('custom_tour_requests', function (Blueprint $table) {
            $table->id();

            // Tour Details
            $table->string('vehicle_category');          // standard, accommodate, luxury
            $table->unsignedInteger('passengers');
            $table->date('tour_date');
            $table->time('start_time')->nullable();
            $table->string('hotel_name')->nullable();
            $table->string('preferred_tour')->nullable();
            $table->text('comments')->nullable();

            // User Info
            $table->string('full_name');
            $table->string('email');
            $table->string('country');
            $table->string('phone');

            $table->enum('status', ['pending', 'confirmed', 'cancelled','completed'])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid','refund'])->default('unpaid');

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
        Schema::dropIfExists('custom_tour_requests');
    }
};
