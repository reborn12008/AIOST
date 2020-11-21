<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Material extends Model
{
    use HasFactory;

    public function request(){
        $this->belongsTo(Request::class);
    }

    public function material(){
        $this->hasMany(Material::class);
    }
}
