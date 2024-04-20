<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AdministradorController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $id=$request["id"];
        $apellidos=$request["apellidos"];
        return view("usuarios.administrador",compact("id","apellidos"));
    }

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

    public function show(Administrador $administrador)
    {
        //
    }

    public function edit(Administrador $administrador)
    {
        //
    }

    public function update(Request $request, Administrador $administrador)
    {
        //
    }
    
    public function destroy(Administrador $administrador)
    {
        //
    }
}
