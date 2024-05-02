<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Resources\ReservaResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas=Reserva::all();

        return ReservaResource::collection($reservas);
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
    public function show(Reserva $reserva)
    {
        return new ReservaResource($reserva);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //Recuperar los datos del formulario
        /*$proveedor=$request->input("Proveedor");
        $rider=$request->input("Rider");
        $cantidad=$request->input("Cantidad");*/
        $estado=$request->input("Estado");
        
        //Asignar los valores del formulario a su respectivo campo
        /*$reserva->proveedor=$proveedor;
        $reserva->rider=$rider;
        $reserva->cantidad=$cantidad;*/
        $reserva->estado=$estado;

        try
        {
            //Hacer el insert en la tabla
            $reserva->save();
            $response=(new ReservaResource($reserva))->response()->setStatusCode(201);
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $response=\response()->json(["error"=>$mensaje],400);
        }


        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
