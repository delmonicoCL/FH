<?php

namespace App\Http\Controllers;


use App\Models\Rider;
use App\Models\Entrega;
use App\Models\Reserva;
use App\Models\Pua;
use App\Clases\Utilidad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RiderController extends Controller
{
    // funciones chart.js//

    public function listaRaidersPuasPersonas()
    {
        $listaRaidersPuasPersonas = Rider::with(['puas', 'puas.entregas'])
            ->get()
            ->map(function ($rider) {
                $puas = $rider->puas->map(function ($pua) {
                    $cantidadPersonas = $pua->entregas->sum('cantidad_de_personas');
                    return [
                        'id' => $pua->id,
                        'cantidad_personas' => $cantidadPersonas,
                    ];
                });
                return [
                    'rider' => $rider->nombre, // Suponiendo que hay una columna 'nombre' en la tabla de riders
                    'puas' => $puas,
                ];
            });

        return $listaRaidersPuasPersonas;
    }

    // funciones chart.js//  
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
               
       //aca le deberia pasar la informacion de las consultas a estadisticas //
        return redirect()->route("administradores.gestionRaider");
    }
        
  }

    

    public function create(Request $request)
    {
        $id=$request["id"];
        $apellidos=$request["apellidos"];
        $nickname=$request["nickname"];
        $avatar=$request["avatar"];
        return view("usuarios.rider",compact("id","apellidos","nickname","avatar"));
    }

    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $id=$request->input("Id");
        $apellidos=$request->input("Apellidos");
        $nickname=$request->input("Nickname");
        $avatar=$request->input("Avatar");

        //Crear un objeto de la clase que representa un registro a la tabla
        $rider=new Rider();
        //Asignar los valores del formulario a su respectivo campo
        $rider["id"]=$id;
        $rider["apellidos"]=$apellidos;
        $rider["nickname"]=$nickname;
        $rider["avatar"]=$avatar;

        try
        {
            //Hacer el insert en la tabla
            $rider->save();
            $request->session()->flash("mensaje","Usuario inscrito correctamente.");
            $response=redirect("/login");
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            $response=redirect("/login");
        }
        
        return $response;
    }

    public function show(Rider $rider)
    {
        $stockRider = $rider->stock_rider;

        // Pasar el stock del rider a la vista
        return view("riders.rider", compact("rider", "stockRider"));
    }

    public function edit(Rider $rider)
    {
        $usuarios = Usuario::all();
        $riders = Rider::all();

        
        return view("administradores.updateRIDER", compact("usuarios", "riders"));
    }

    public function update(Request $request, Rider $rider)
    {
        //
    }

    public function destroy(Rider $rider)
    {
        //
    }
}
