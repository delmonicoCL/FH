<?php
// ReservaController
namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Reserva;
use App\Clases\Utilidad;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ReservaController extends Controller
{
    public function index()
    {
        // Obtener el ID del rider actual
        $rider_id = auth()->user()->id;

        // Consulta SQL para obtener el número de reservas activas del rider actual
        $num_reservas_activas = Reserva::where('rider', $rider_id)->where('estado', 'finalizada')->count();

        // Obtener todas las reservas que no están finalizadas
        $reservas = Reserva::where('estado', '!=', 'finalizada')->get();

        // Pasar los datos a la vista raider.blade.php
        return view("riders.rider", compact("reservas", "num_reservas_activas"));
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
        // Obtener el proveedor
        $proveedor = Proveedor::find($request->proveedor);

        // Verificar si la cantidad solicitada es mayor que el stock disponible
        if ($request->cantidad > $proveedor->stock_proveedor) {
            // Si la cantidad solicitada es mayor que el stock disponible, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No hay suficiente stock disponible para realizar la reserva');
        }

        // Si la cantidad solicitada es menor o igual que el stock disponible, proceder con la reserva
        $reserva = new Reserva();
        $reserva->cantidad = $request->cantidad;
        $reserva->proveedor = $request->proveedor; // Aquí se guarda el ID del proveedor
        $reserva->rider = $request->rider;
        $reserva->estado = $request->estado;
        $reserva->save();

        // Actualizar el stock del proveedor
        $proveedor->stock_proveedor -= $request->cantidad;
        $proveedor->save();

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
        // $reserva->estado = $request->estado;
        // $reserva->save();
        // return redirect()->back()->with('success', 'Reserva marcada como entregada correctamente');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
