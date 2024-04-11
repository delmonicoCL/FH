<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvatarRider extends Model
{
    use HasFactory;

    protected $table="avatares_rider";
    protected $primaryKey="avatar"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function riders()
    {
        return $this->hasMany(Rider::class,"avatar");
    }
}
