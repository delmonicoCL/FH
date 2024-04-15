<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id=$request["id"];
        $apellidos=$request["apellidos"];
        return view("usuarios.administrador",compact("id","apellidos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $id=$request->input("Id");
        $apellidos=$request->input("Apellidos");

        //Crear un objeto de la clase que representa un registro a la tabla
        $administrador=new Administrador();
        //Asignar los valores del formulario a su respectivo campo
        $administrador->id=$id;
        $administrador->apellidos=$apellidos;

        try
        {
            //Hacer el insert en la tabla
            $administrador->save();
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
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
