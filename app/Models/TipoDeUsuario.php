<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeUsuario extends Model
{
    use HasFactory;
    protected $table="tipos_de_usuario";
    protected $primaryKey="tipo"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function usuarios()
    {
        return $this->hasMany(Usuario::class,"tipo");
    }
}
