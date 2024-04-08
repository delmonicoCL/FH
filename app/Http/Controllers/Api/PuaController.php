<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pua;
use Illuminate\Http\Request;

class PuaController extends Controller
{
    public function index()
    {
        $puas = Pua::all();
        return response()->json($puas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'localizacion' => 'required|string',
            'cantidad_de_personas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $pua = new Pua();
        $pua->localizacion = $request->localizacion;
        $pua->cantidad_de_personas = $request->cantidad_de_personas;
        $pua->lng = $request->lng;
        $pua->lat = $request->lat;
        $pua->save();

        return response()->json($pua, 201);
    }

    // Método para manejar la creación de PUAs desde un formulario HTML
    public function storeFromForm(Request $request)
    {
        $request->validate([
            'nombrePua' => 'required|string',
            'numpersonas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $pua = new Pua();
        $pua->localizacion = $request->nombrePua;
        $pua->cantidad_de_personas = $request->numpersonas;
        $pua->lng = $request->lng;
        $pua->lat = $request->lat;
        $pua->save();

        return response()->json($pua, 201);
    }

    public function show(Pua $pua)
    {
        return response()->json($pua);
    }

    public function update(Request $request, Pua $pua)
    {
        $request->validate([
            'localizacion' => 'required|string',
            'cantidad_de_personas' => 'required|integer',
            'lng' => 'required|numeric',
            'lat' => 'required|numeric',
        ]);

        $pua->localizacion = $request->localizacion;
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

?>
