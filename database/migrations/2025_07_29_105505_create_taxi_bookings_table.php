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
            $table->string('destination');
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
