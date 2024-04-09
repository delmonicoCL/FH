<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    protected $table="entregas";
    //protected $primaryKey="nombreDeLaClavePrimaria"; //solo se pone cuando la clave primaria no se llama id.
    //public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    //protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function riders()
    {
        return $this->belongsTo(Rider::class,"rider");
    }

    public function puas()
    {
        return $this->belongsTo(Pua::class,"pua");
    }

    public function estadosEntrega()
    {
        return $this->belongsTo(EstadoEntrega::class,"estado");
    }
}
