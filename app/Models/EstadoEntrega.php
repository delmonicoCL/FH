<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEntrega extends Model
{
    use HasFactory;
    protected $table="estados_entrega";
    protected $primaryKey="estado"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function entregas()
    {
        return $this->hasMany(Entrega::class,"estado");
    }
}
