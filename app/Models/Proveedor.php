<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table="proveedores";
    //protected $primaryKey="id"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria es autoincremental.
    //protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;
}
