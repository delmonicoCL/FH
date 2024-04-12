<?php
// ReservaController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
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
