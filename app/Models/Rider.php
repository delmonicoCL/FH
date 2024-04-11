<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    protected $table="riders";
    //protected $primaryKey="nombreDeLaClavePrimaria"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    //protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function usuarios()
    {
        return $this->belongsTo(Usuario::class,"id");
    }

    public function avataresRider()
    {
        return $this->belongsTo(AvatarRider::class,"avatar");
    }

    public function puas()
    {
        return $this->hasMany(Pua::class,"rider_creador");
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class,"rider");
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class,"rider");
    }
}
