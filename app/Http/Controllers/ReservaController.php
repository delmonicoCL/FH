<?php
// ReservaController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{


// FUNCION CHART.JS//

    public function histogramaReservasPorEstado()
    {
        $reservasPorEstado = Reserva::select('estado', \DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->pluck('total', 'estado');

        return view('estadisticas.histograma', compact('reservasPorEstado'));
    }


    public function ReservasPorProveedor()
    {
        // Obtener las reservas por proveedor y estado
        $reservas = Reserva::select('proveedor', 'estado')
                            ->selectRaw('count(*) as total')
                            ->groupBy('proveedor', 'estado')
                            ->get();

        // Transformar los datos para el gráfico
        $data = [];
        foreach ($reservas as $reserva) {
            $data[$reserva->proveedor][$reserva->estado] = $reserva->total;
        }

        
        return view('estadisticas.reservas_por_proveedor', compact('data'));
    }
    
    public function ReservasPorRaider()
    {
        // Obtener las reservas por raider y estado
        $reservas = Reserva::select('rider', 'estado')
            ->selectRaw('count(*) as total')
            ->groupBy('rider', 'estado')
            ->get();

        // Transformar los datos para el gráfico
        $data = [];
        foreach ($reservas as $reserva) {
            $data[$reserva->rider][$reserva->estado] = $reserva->total;
        }

        return view('estadisticas.reservas_por_raider', compact('data'));
    }

// FUNCION CHART.JS//


    public function index()
    {
        // Obtener todas las reservas
        $reservas = Reserva::all();
        
        // Pasar los datos a la vista raider.blade.php
        // return view('raiders', ['reservas' => $reservas]);
        return view("riders.rider",compact("reservas"));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->cantidad = $request->cantidad;
        $reserva->proveedor = $request->proveedor; // Aquí se guarda el ID del proveedor
        $reserva->rider = $request->rider;
        $reserva->estado = $request->estado;
        $reserva->save();

        // Puedes retornar una respuesta o redirigir a alguna página después de guardar la reserva
        return redirect()->back()->with('success', 'Reserva creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
