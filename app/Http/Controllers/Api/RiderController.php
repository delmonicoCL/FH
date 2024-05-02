<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rider;
use Illuminate\Http\Request;
use App\Http\Resources\RiderResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riders=Rider::all();

        return RiderResource::collection($riders);
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
    public function show(Rider $rider)
    {
        return new RiderResource($rider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rider $rider)
    {
        //Recuperar los datos del formulario
        /*$apellidos=$request->input("Apellidos");
        $nickname=$request->input("Nickname");*/
        $stock_rider=$request->input("StockRider");
        /*$avatar=$request->input("Avatar");*/
        
        //Asignar los valores del formulario a su respectivo campo
        /*$rider->apellidos=$apellidos;
        $rider->nickname=$nickname;*/
        $rider->stock_rider=$stock_rider;
        //$rider->avatar=$avatar;

        try
        {
            //Hacer el insert en la tabla
            $rider->save();
            $response=(new RiderResource($rider))->response()->setStatusCode(201);
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
    public function destroy(Rider $rider)
    {
        //
    }
}