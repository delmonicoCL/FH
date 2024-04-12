<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('rider')->get();
        echo $reservas;
        // return response()->json($reservas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request["id"];
        $calle = $request["calle"];
        $numero = $request["numero"];
        $cp = $request["cp"];
        $ciudad = $request["ciudad"];
        $logo = $request["nombreDelArchivoDelLogo"];
        return view("usuarios.proveedor", compact("id", "calle", "numero", "cp", "ciudad", "logo"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $id = $request->input("Id");
        $calle = $request->input("Calle");
        $numero = $request->input("Numero");
        $cp = $request->input("Cp");
        $ciudad = $request->input("Ciudad");
        $logo = $request->input("Logo");
        $latitud = $request->input("Latitud");
        $longitud = $request->input("Longitud");

        //Crear un objeto de la clase que representa un registro a la tabla
        $proveedor = new Proveedor();
        //Asignar los valores del formulario a su respectivo campo
        $proveedor->id = $id;
        $proveedor->calle = $calle;
        $proveedor->numero = $numero;
        $proveedor->cp = $cp;
        $proveedor->ciudad = $ciudad;
        $proveedor->logo = $logo;
        $proveedor->lt = $latitud;
        $proveedor->lng = $longitud;


        try {
            //Hacer el insert en la tabla
            $proveedor->save();
            $request->session()->flash("mensaje", "Usuario inscrito correctamente.");
            $response = redirect("/login");
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            $request->session()->flash("error", $mensaje);
            $response = redirect("/login");
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedore, Usuario $user)
    {
        return view("proveedor/formProveedor", compact("proveedore", "user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
