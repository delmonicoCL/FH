<?php

namespace App\Http\Controllers;

use App\Clases\Utilidad;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                        
            $riders = Rider::paginate(5);
            return view("rider.index", compact("rider"));

        }

        


        

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id=$request["id"];
        $apellidos=$request["apellidos"];
        $nickname=$request["nickname"];
        $avatar=$request["avatar"];
        return view("usuarios.rider",compact("id","apellidos","nickname","avatar"));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rider $rider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rider $rider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rider $rider)
    {
        //
    }
}
