<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ActivityPhoto extends Model
{
    Schema::create('activity_photos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tour_id')->constrained()->onDelete('cascade');
        $table->string('image_path');
        $table->boolean('is_main')->default(false);
        $table->timestamps();
    });
}
