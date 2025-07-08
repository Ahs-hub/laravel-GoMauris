<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourBlockedDate extends Model
{
    protected $fillable = ['tour_id', 'date'];
    public $timestamps = true;
}
