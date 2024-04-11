<?php
// models/Pua.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pua extends Model
{
    use HasFactory;
  
    protected $table = "puas";
    protected $primaryKey = "id"; // Se establece la clave primaria
    public $timestamps = false; // Se desactiva la gestión de los timestamps
    
    protected $fillable = [ // Se especifican los campos que se pueden llenar
        'cantidad_de_personas',
    ];

    public function riders()
    {
        return $this->belongsTo(Rider::class,"rider_creador");
    }

    public function estadosPua()
    {
        return $this->belongsTo(EstadoPua::class,"estado");
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class,"pua");
    }
}
