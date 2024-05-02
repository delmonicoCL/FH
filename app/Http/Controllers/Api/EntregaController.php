<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use Illuminate\Http\Request;
use App\Http\Resources\EntregaResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class EntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $escalaDeConsulta=$request->EscalaDeConsulta;
        $idRider=$request->IdRider;
        if($escalaDeConsulta==="consultarLasEntregasDeUnRiderEnEspecifico")
        {
            $entregas=Entrega::where("rider", "=", $idRider)->get();
        }
        else
        {
            $entregas=Entrega::all();
        }

        return EntregaResource::collection($entregas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $rider=$request->input("Rider");
        /*$pua=$request->input("Pua");*/
        /*$estado=$request->input("Estado");*/

        //Crear un objeto de la clase que representa una consulta a la tabla
        $entrega=new Entrega();
        //Asignar los valores del formulario a su respectivo campo
        $entrega->rider=$rider;
        /*$entrega->pua=$pua;*/
        /*$entrega->estado=$estado;*/
        
        try
        {
            //Hacer el insert en la tabla
            $entrega->save();
            $response=(new EntregaResource($entrega))->response()->setStatusCode(201);
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $response=\response()->json(["error"=>$mensaje],400);
        }
        

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrega $entrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrega $entrega)
    {
        //Recuperar los datos del formulario
        /*$rider=$request->input("Rider");*/
        $pua=$request->input("Pua");
        $estado=$request->input("Estado");
        
        //Asignar los valores del formulario a su respectivo campo
        /*$entrega->rider=$rider;*/
        $entrega->pua=$pua;
        $entrega->estado=$estado;

        try
        {
            //Hacer el insert en la tabla
            $entrega->save();
            $response=(new EntregaResource($entrega))->response()->setStatusCode(201);
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
    public function destroy(Entrega $entrega)
    {
        //
    }
}
