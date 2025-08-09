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
            $table->time('time');
            $table->integer('passengers');
            $table->string('category');
            $table->string('name');
            $table->string('email');
            $table->string('country');
            $table->string('mobile');
            $table->text('comments')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');

            $table->enum('payment_status', ['unpaid', 'paid'])->default('unpaid');

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
