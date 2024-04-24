<?php

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
    public function entregarPua(Request $request, $id)
    {
        try {
            // Buscar la PUA por su ID
            $pua = Pua::findOrFail($id);

            // Actualizar el stock del rider
            $rider_id = $pua->rider_creador;
            $rider = Rider::findOrFail($rider_id);
            $rider->stock_rider -= $pua->cantidad_de_personas;
            $rider->save();

            // Aquí puedes realizar otras acciones relacionadas con la entrega de la PUA, como cambiar su estado, etc.

            // Devolver una respuesta adecuada
            return response()->json(['message' => 'PUA entregada exitosamente. Stock del rider actualizado.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el error de modelo no encontrado
            return response()->json(['error' => 'PUA not found'], 404);
        } catch (\Exception $e) {
            // Manejar otros tipos de excepciones
            return response()->json(['error' => 'Unknown error'], 500);
        }
    }

    public function index()
    {
        $puas = Pua::all();
        return response()->json($puas); // Devuelve todas las PUAs como respuesta JSON
    }

    public function update(Request $request, Pua $pua)
    {
        try {
            $request->validate([
                'cantidad_de_personas' => 'required|integer',
                'lng' => 'required|numeric',
                'lat' => 'required|numeric',
            ]);
    
            $pua->cantidad_de_personas = $request->cantidad_de_personas;
            $pua->lng = $request->lng;
            $pua->lat = $request->lat;
            $pua->save();
    
            $cantidadEntregada = $pua->cantidad_de_personas;
    
            // Obtener el rider asociado a la PUA
            $rider = $pua->rider;
    
            // Verificar si el rider existe y si tiene suficiente stock para realizar la entrega
            if ($rider && $rider->stock_rider >= $cantidadEntregada) {
                // Restar la cantidad entregada al stock del rider
                $rider->stock_rider -= $cantidadEntregada;
                $rider->save();
    
                return response()->json(['message' => 'Pua entregada exitosamente. Stock del rider actualizado.'], 200);
            }
    
            return response()->json(['error' => 'No se puede entregar la Pua. Stock insuficiente del rider.'], 400);
        } catch (\Exception $e) {
            // Manejar la excepción
            return response()->json(['error' => 'Error al actualizar la Pua: ' . $e->getMessage()], 500);
        }
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'cantidad_de_personas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
            'rider_creador' => 'required|integer' // Validación del rider_id
        ]);

        try {
            // Crear una nueva instancia de Pua
            $pua = new Pua();
            $pua->cantidad_de_personas = $request->cantidad_de_personas;
            $pua->lng = $request->lng;
            $pua->lat = $request->lat;
            $pua->rider_creador = $request->rider_creador; // Asignar el ID del rider

            // Guardar la Pua en la base de datos
            $pua->save();

            // Retornar una respuesta exitosa
            return response()->json(new PuaResource($pua), 201);
        } catch (QueryException $ex) {
            // Manejar errores de base de datos
            $mensaje = Utilidad::errorMessage($ex);
            return response()->json(["error" => $mensaje], 400);
        }
    }
    

    public function show(Pua $pua)
    {
        return response()->json($pua);
    }

    public function destroy(Pua $pua)
    {
        $pua->delete();
        return response()->json(null, 204);
    }
}
