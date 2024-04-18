<?php

namespace App\Http\Controllers;

use App\Models\Pua;
use Illuminate\Http\Request;

class PuaController extends Controller
{

    public function datosPUA()
    {
        // Obtener la cantidad de PUA creados por cada rider
        $puasPorRider = Pua::select('id', \DB::raw('count(*) as total_puas'))
            ->groupBy('id')
            ->pluck('total_puas', 'id');

        // Obtener el promedio de personas por PUA
        $promedioPersonasPorPua = Pua::select(\DB::raw('avg(cantidad_de_personas) as promedio_personas'))
            ->pluck('promedio_personas')
            ->first();

        return view('estadisticas.datos_pua', compact('puasPorRider', 'promedioPersonasPorPua'));
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pua $pua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pua $pua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pua $pua)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pua $pua)
    {
        //
    }
}
