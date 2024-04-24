<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Proveedor;
use App\Clases\Utilidad;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class ProveedorController extends Controller
{

    public function entregas()
    {
        
    }

    public function index()
    {
        // $reservas = Reserva::with('rider')->get();
        // echo $reservas;
        // return response()->json($reservas);<

        // $usuarios = Usuario::where("tipo", "=", "proveedor")->get();
        // $proveedores = Proveedor::all();
        // return view("administradores.gestionProveedor", compact("usuarios", "proveedores"));

        return redirect()->route("administradores.gestionProveedor");
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //Recuperar los valores del request
        $tipo = $request->input("Tipo");
        $id = $request->input("Id");
        $calle = $request->input("Calle");
        $numero = $request->input("Numero");
        $cp = $request->input("Cp");
        $ciudad = $request->input("Ciudad");
        $logo = $request->file("Logo");
        $nombreDelArchivoDelLogo = $id . "." . $logo->getClientOriginalExtension();
        $logo->storeAs('storage/logos', $nombreDelArchivoDelLogo);
        $latitud = $request->input("Latitud");
        $longitud = $request->input("Longitud");

        /*$file = $request->file('nombre_campo');
        // Acceder a información del archivo
        $nombre = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tipo = $file->getClientMimeType();
        $tamanio = $file->getSize();
        //modificar la informacion del archivo
        $name = $file->hashName(); // Generate a unique, random name...
        $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...
        // Almacenar el archivo
        $file->store('carpeta_destino');*/

        //Crear un objeto de la clase que representa un registro a la tabla
        $proveedor = new Proveedor();

        //Asignar los valores del formulario a su respectivo campo
        $proveedor->id = $id;
        $proveedor->calle = $calle;
        $proveedor->numero = $numero;
        $proveedor->cp = $cp;
        $proveedor->ciudad = $ciudad;
        $proveedor->logo = $nombreDelArchivoDelLogo;
        $proveedor->lat = $latitud;
        $proveedor->lng = $longitud;

        try {
            //Hacer el insert en la tabla
            $proveedor->save();
            $request->session()->flash("mensaje", "Proveedor inscrito correctamente.");
            $response = redirect("/login");
        } catch (QueryException $ex) {
            $mensaje = Utilidad::errorMessage($ex);
            $request->session()->flash("error", $mensaje);
            $response = redirect()->route("usuarios.create", compact("tipo"))->withInput();
        }

        return $response;
    }

    public function show(Proveedor $proveedor)
    {
        //
    }

    public function edit(Proveedor $proveedore)
    {
        $usuario = Usuario::where("id", "=", $proveedore->id)->first();
        $proveedor = $proveedore;
        return view('proveedor.formProveedor', compact('usuario', "proveedor"));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $tipoDeModificacion = $request->tipoDeModificacion;
        if ($tipoDeModificacion === "crearMenu") {
            $cant = $request->input("Cant");
            $stok = $proveedore->stock_proveedor;
            $nuevoStok = $cant + $stok;
            $proveedore->stock_proveedor = $nuevoStok;
            try {
                //Hacer el insert en la tabla
                $proveedore->save();
                $request->session()->flash("mensaje", "Menus creados exitosamente.");
                $response = redirect()->route('proveedor2');
            } catch (QueryException $ex) {
                $mensaje = Utilidad::errorMessage($ex);
                $request->session()->flash("error", $mensaje);
                $response = redirect()->route('proveedor2');
            }
        }
        return $response;
    }

    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
