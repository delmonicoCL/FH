<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use Illuminate\Http\Request;

class EntregaController extends Controller
{

    public function entregasPorTipoPua()
    {
        // Obtener las entregas por tipo de punto de entrega (Pua)
        $entregas = Entrega::select('pua', 'estado')
            ->selectRaw('count(*) as total')
            ->groupBy('pua', 'estado')
            ->get();

        // Transformar los datos para el gráfico
        $data = [];
        foreach ($entregas as $entrega) {
            $data[$entrega->pua][$entrega->estado] = $entrega->total;
        }

        return view('estadisticas.entregas_por_tipo_pua', compact('data'));
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
    public function show(Entrega $entrega)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrega $entrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrega $entrega)
    {
        //
    }
}
