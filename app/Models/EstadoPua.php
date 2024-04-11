<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPua extends Model
{
    use HasFactory;
    protected $table="estados_pua";
    protected $primaryKey="estado"; //solo se pone cuando la clave primaria no se llama id.
    public $incrementing=false; //solo se pone cuando la clave primaria no es autoincremental.
    protected $keyType="string"; //solo se pone cuando la clave primaria no es entero.
    public $timestamps=false;

    public function puas()
    {
        return $this->hasMany(Pua::class,"estado");
    }
}
