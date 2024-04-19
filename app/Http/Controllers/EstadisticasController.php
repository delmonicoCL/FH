<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Pua;
use App\Models\Usuario;
use App\Models\Entrega;
use App\Models\Rider;


class EstadisticasController extends Controller
{
    private $usuariosPorTipo;

    public function estadisticas()
    {
        // Histograma de reservas por estado
        $reservasPorEstado = Reserva::select('estado', \DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->pluck('total', 'estado');

        // Reservas por proveedor
        $reservasPorProveedor = Reserva::select('proveedor', 'estado')
            ->selectRaw('count(*) as total')
            ->groupBy('proveedor', 'estado')
            ->get();

        // Transformar los datos para el gráfico de proveedor
        $dataProveedor = [];
        foreach ($reservasPorProveedor as $reserva) {
            $dataProveedor[$reserva->proveedor][$reserva->estado] = $reserva->total;
        }

        // Reservas por raider
        $reservasPorRaider = Reserva::select('rider', 'estado')
            ->selectRaw('count(*) as total')
            ->groupBy('rider', 'estado')
            ->get();

        // Transformar los datos para el gráfico de raider
        $dataRaider = [];
        foreach ($reservasPorRaider as $reserva) {
            $dataRaider[$reserva->rider][$reserva->estado] = $reserva->total;
        }

        // Obtener los datos de las PUAs y la cantidad de personas en cada una
        $puaData = Pua::select('id as pua_id', 'cantidad_de_personas')->get();

        // Obtener usuarios por tipo
        $usuariosPorTipo = Usuario::select('tipo', \DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->pluck('total', 'tipo');

        return view('estadisticas.estadisticasResumen', compact('reservasPorEstado', 'dataProveedor', 'dataRaider', 'puaData', 'usuariosPorTipo'));
    }

}
