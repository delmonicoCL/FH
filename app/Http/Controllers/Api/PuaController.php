<?php
// Controllers/Api/PuaController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pua;
use Illuminate\Http\Request;

class PuaController extends Controller
{
    public function index()
    {
        $puas = Pua::all();
        return response()->json($puas); // Devuelve todas las PUAs como respuesta JSON
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
            $request->session()->flash("mensaje","Pua creada correctamente.");
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            $response=redirect("/login");
        }

        return response()->json($pua, 201);
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
