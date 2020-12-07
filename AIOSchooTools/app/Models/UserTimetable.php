<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimetable extends Model
{
    use HasFactory;
    public $timestamps =false;

    public function user(){
        $this->belongsTo(User::class);
    }

    public function timetable(){
        $this->hasMany(Timetable::class);
    }
}
