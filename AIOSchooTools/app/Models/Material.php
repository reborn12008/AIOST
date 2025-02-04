<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['amount'];
    public $timestamps = false;

    public function request_material(){
        $this->belongsTo(Request_Material::class);
    }
}
