<?php
// Reserva.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table="reservas";
    //protected $primaryKey="nombreDeLaClavePrimaria"; //solo se pone cuando la clave primaria no se llama id.
    //public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    //protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function riders()
    {
        return $this->belongsTo(Rider::class,"rider");
    }

    public function estadosReserva()
    {
        return $this->belongsTo(EstadoReserva::class,"estado");
    }

    public function proveedores()
    {
        return $this->belongsTo(Proveedor::class,"proveedor");
    }
}