<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Models\AvatarRider;

class UsuarioController extends Controller
{
    public function showLogin()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $correoElectronico=$request->input("CorreoElectronico");
        $contrasenia=$request->input("Contrasenia");

        $usuario=Usuario::where("email",$correoElectronico)->first();

        if($usuario !=null && Hash::check($contrasenia,$usuario->contrasenia))
        {
            Auth::login($usuario);
            $response=redirect("/home");
        }
        else
        {
            $request->session()->flash("error","Usuario o contraseña incorrectos");
            $response=redirect("/login")->withInput();
        }
        return $response;
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

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
        $tipo=$request["tipo"];
        if($tipo==="rider")
        {
            $avataresRider=AvatarRider::all();
            $listaAvatares=[];
            for ($i=0; $i <count($avataresRider); $i++)
            {
                array_push($listaAvatares,$avataresRider[$i]["avatar"]);
            }
            $response=view("usuarios.usuario",compact("tipo","listaAvatares"));
        }
        else
        {
            $response=view("usuarios.usuario",compact("tipo"));
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $tipo=$request->input("Tipo");

        if($tipo==="proveedor")
        {
            $nombreEmpresa=$request->input("NombreEmpresa");
        }
        else
        {
            $nombre=$request->input("Nombre");
        }
        $contrasenia=$request->input("Contrasenia");
        $email=$request->input("Email");
        $telefono=$request->input("Telefono");

        if($tipo==="administrador"||$tipo==="rider")
        {
            $apellidos=$request->input("Apellidos");
        }
        if($tipo==="proveedor")
        {
            $calle=$request->input("Calle");
            $numero=$request->input("Numero");
            $cp=$request->input("Cp");
            $ciudad=$request->input("Ciudad");
            $logo=$request->file("Logo");
            $nombreDelArchivoDelLogo=$nombreEmpresa.".".$logo->getClientOriginalExtension();
            $logo->storeAs('storage/logos',$nombreDelArchivoDelLogo);

            // $file = $request->file('nombre_campo');

            // // Acceder a información del archivo
            // $nombre = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            // $tipo = $file->getClientMimeType();
            // $tamanio = $file->getSize();

            // //modificar la informacion del archivo
            // $name = $file->hashName(); // Generate a unique, random name...
            // $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...

            // // Almacenar el archivo
            // $file->store('carpeta_destino');
        }
        if($tipo==="rider")
        {
            $nickname=$request->input("Nickname");
            $avatar=$request->input("Avatar");
        }

        //Crear un objeto de la clase que representa un registro a la tabla
        $usuario=new Usuario();
        //Asignar los valores del formulario a su respectivo campo
        if($tipo==="proveedor")
        {
            $usuario->nombre=$nombreEmpresa;
        }
        else
        {
            $usuario->nombre=$nombre;
        }
        $usuario->contrasenia=\bcrypt($contrasenia);
        $usuario->email=$email;
        $usuario->tipo=$tipo;
        $usuario->telefono=$telefono;

        try
        {
            //Hacer el insert en la tabla
            $usuario->save();
            $id=$usuario["id"];
            if($tipo==="administrador")
            {
                $response=redirect()->route('administradores.create',compact('apellidos', 'id'));
            }
            else if($tipo==="proveedor")
            {
                $response=redirect()->route('proveedores.create',compact("id",'calle',"numero","cp","ciudad",'nombreDelArchivoDelLogo'));
            }
            else if($tipo==="rider")
            {
                $response=redirect()->route('riders.create',compact("id",'apellidos',"nickname","avatar"));
            }
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            $response=redirect()->action([UsuarioController::class,"create"],['tipo' =>$tipo])->withInput();
        }
        

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
