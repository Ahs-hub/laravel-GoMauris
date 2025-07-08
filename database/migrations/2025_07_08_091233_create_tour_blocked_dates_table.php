<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tour_blocked_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->date('date');
            $table->timestamps();
    
            $table->unique(['tour_id', 'date']);
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_blocked_dates');
    }
};
