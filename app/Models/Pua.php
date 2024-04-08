<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pua extends Model
{
    use HasFactory;
    protected $table="puas";
    //protected $primaryKey="nombreDeLaClavePrimaria"; //solo se pone cuando la clave primaria no se llama id.
    //public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    //protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function riders()
    {
        return $this->belongsTo(Rider::class,"rider_creador");
    }

    public function estadosPua()
    {
        return $this->belongsTo(EstadoPua::class,"estado");
    }
}
