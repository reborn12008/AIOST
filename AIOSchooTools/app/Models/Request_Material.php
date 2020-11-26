<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Material extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function request(){
        $this->belongsTo(Requests::class);
    }

    public function material(){
        $this->hasMany(Material::class);
    }
}
