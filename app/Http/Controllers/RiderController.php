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

    public function index(Request $request)
    {
               
       //aca le deberia pasar la informacion de las consultas a estadisticas //
        return redirect()->route("administradores.gestionRaider");
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //Recuperar los valores del request
        $tipo=$request->input("Tipo");
        $id=$request->input("Id");
        $apellidos = $request->input("Apellidos");
        $nickname = $request->input("Nickname");
        $avatar = $request->input("Avatar");

        //Crear un objeto de la clase que representa un registro a la tabla
        $rider=new Rider();
        //Asignar los valores del formulario a su respectivo campo
        $rider->id=$id;
        $rider->apellidos=$apellidos;
        $rider->nickname=$nickname;
        $rider->avatar=$avatar;

        try
        {
            //Hacer el insert en la tabla
            $rider->save();
            $request->session()->flash("mensaje","Rider inscrito correctamente.");
            $response=redirect("/login");
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            $response = redirect()->route("usuarios.create", compact("tipo"))->withInput();
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
        //Recuperar los datos del formulario
        $tipo=$request->tipo;
        $tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor=$request->tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor;
        $id = $rider->id;
        $apellidos=$request->input("Apellidos");
        $nickname=$request->input("Nickname");
        $avatar=$request->input("Avatar");

        //Asignar los valores del formulario a su respectivo campo
        $rider->apellidos=$apellidos;
        $rider->nickname=$nickname;
        $rider->avatar=$avatar;
        
        try
        {
            //Hacer el insert en la tabla
            $rider->save();
            $request->session()->flash("mensaje","Rider modificado correctamente.");
            $response=redirect("/administradores/gestionRaider");


            if($tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor==="administrador")
            {
                $response=redirect("/administradores/gestionRaider");
            }
            else
            {
                $response=redirect("/home");
            }
        }
        catch(QueryException $ex)
        {
            $usuario=Usuario::where("id", "=", $id)->first();
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            $response = redirect()->route("usuarios.edit", compact("tipo","usuario"))->withInput();



            if($tipoDeUsuarioQueEstaRealizandoLaEdicionDeProveedor==="administrador")
            {
                $response=redirect()->route("usuarios.edit", compact("tipo","usuario"))->withInput();
            }
            else
            {
                $response=redirect()->action([RiderController::class, "edit"],["rider"=>$rider])->withInput();
            }
        }
        return $response;
    }

    public function destroy(Rider $rider)
    {
        //
    }
}