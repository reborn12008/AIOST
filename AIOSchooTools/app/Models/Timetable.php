<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public function user(){
        $this->belongsTo(User::class);
    }

    public function place(){
        $this->hasOne(Place::class);
    }
}
