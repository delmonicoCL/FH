<?php
// Controllers/Api/PuaController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pua;
use Illuminate\Http\Request;
use App\Models\Rider;
use App\Http\Resources\PuaResource;
use App\Clases\Utilidad;
use Illuminate\Database\QueryException;

class PuaController extends Controller
{
    public function index()
    {
        $puas = Pua::all();
        return response()->json($puas); // Devuelve todas las PUAs como respuesta JSON
    }

    // PuaController.php



    public function entregar(Pua $pua)
    {
        $cantidadEntregada = $pua->cantidad_de_personas;

        // Obtener el rider asociado a la pua
        $rider = $pua->rider;

        // Verificar si el rider existe y si tiene suficiente stock para realizar la entrega
        if ($rider && $rider->stock_rider >= $cantidadEntregada) {
            // Restar la cantidad entregada al stock del rider
            $rider->stock_rider -= $cantidadEntregada;
            $rider->save();

            // Eliminar la pua entregada
            $pua->delete();

            return response()->json(['message' => 'Pua entregada exitosamente. Stock del rider actualizado.'], 200);
        }

        return response()->json(['error' => 'No se puede entregar la pua. Stock insuficiente del rider.'], 400);
    }


    public function store(Request $request)
    {
        $request->validate([
            'cantidad_de_personas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $pua = new Pua();
        $pua->cantidad_de_personas = $request->cantidad_de_personas;
        $pua->lng = $request->lng;
        $pua->lat = $request->lat;

        try
        {
            //Hacer el insert en la tabla
            $pua->save();
            $response=(new PuaResource($pua))->response()->setStatusCode(201);
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $response=\response()->json(["error"=>$mensaje],400);
        }

        return $response;
    }

    public function show(Pua $pua)
    {
        return response()->json($pua);
    }

    public function update(Request $request, Pua $pua)
    {
        $request->validate([
            'cantidad_de_personas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $pua->cantidad_de_personas = $request->cantidad_de_personas;
        $pua->lng = $request->lng;
        $pua->lat = $request->lat;
        $pua->save();

        return response()->json($pua, 200);
    }

    public function destroy(Pua $pua)
    {
        $pua->delete();
        return response()->json(null, 204);
    }
}