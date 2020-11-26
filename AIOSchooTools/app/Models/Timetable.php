<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public function usertimetable(){
        $this->belongsTo(UserTimetable::class);
    }

    public function place(){
        $this->hasOne(Place::class);
    }
}
