<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Usuario;
use App\Models\Administrador;
use App\Models\Proveedor;
use App\Models\AvatarRider;
use App\Clases\Utilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{

    public function showLogin()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $correoElectronico = $request->input("CorreoElectronico");
        $contrasenia = $request->input("Contrasenia");

        $usuario = Usuario::where("email", $correoElectronico)->first();

        if ($usuario != null && Hash::check($contrasenia, $usuario->contrasenia))
        {
            Auth::login($usuario);
            $response = redirect("/home");
        }
        else
        {
            $request->session()->flash("error", "Usuario o contraseña incorrectos");
            $response = redirect("/login")->withInput();
        }
        return $response;
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/");
    }

    public function index()
    {
        $usuarios = Usuario::all();
        return redirect()->route('riders.index', compact("usuarios"));
    }

    public function create(Request $request)
    {
        $tipo = $request["tipo"];

        if ($tipo === "rider")
        {
            $avataresRider = AvatarRider::all();
            $listaAvatares = [];
            for ($i = 0; $i < count($avataresRider); $i++)
            {
                array_push($listaAvatares, $avataresRider[$i]["avatar"]);
            }
            $response = view("usuarios.usuario", compact("tipo", "listaAvatares"));
        }
        else
        {
            $response = view("usuarios.usuario", compact("tipo"));
        }

        return $response;
    }

    public function store(Request $request)
    {
        //Recuperar los datos del formulario
        $tipo = $request->input("Tipo");

        if ($tipo === "proveedor")
        {
            $nombreEmpresa = $request->input("NombreEmpresa");
        }
        else
        {
            $nombre = $request->input("Nombre");
        }

        $contrasenia = $request->input("Contrasenia");
        $email = $request->input("Email");
        $telefono = $request->input("Telefono");

        //Crear un objeto de la clase que representa un registro a la tabla
        $usuario = new Usuario();
        //Asignar los valores del formulario a su respectivo campo
        if ($tipo === "proveedor")
        {
            $usuario->nombre = $nombreEmpresa;
        }
        else
        {
            $usuario->nombre = $nombre;
        }
        $usuario->contrasenia = \bcrypt($contrasenia);
        $usuario->email = $email;
        $usuario->tipo = $tipo;
        $usuario->telefono = $telefono;

        try
        {
            //Hacer el insert en la tabla
            $usuario->save();
            $request->merge(['Id' => $usuario->id]);
            if ($tipo === "administrador")
            {
                $response = redirect()->route('administradores.create', compact('apellidos', 'id'));
            }
            else if ($tipo === "proveedor")
            {
                $response=app(ProveedorController::class)->store($request);
            }
            else if ($tipo === "rider")
            {
                $response=app(RiderController::class)->store($request);
            }
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilidad::errorMessage($ex);
            $request->session()->flash("error", $mensaje);
            $response = redirect()->action([UsuarioController::class, "create"],['tipo' => $tipo])->withInput();
        }

        return $response;
    }

    public function show(Usuario $usuario)
    {
        //
    }

    public function edit(Request $request, Usuario $usuario)
    {
        //Recuperar los datos del formulario
        $tipo=$request->tipo;
        $idAdministrador=$request->idAdministrador;
        $administrador=Administrador::where("id","=",$idAdministrador)->first();

        if ($tipo === "rider")
        {
            $avataresRider = AvatarRider::all();
            $listaAvatares = [];
            for ($i = 0; $i < count($avataresRider); $i++)
            {
                array_push($listaAvatares, $avataresRider[$i]["avatar"]);
            }
            $rider = Rider::where("id", "=", $usuario->id)->first();
            return view('administradores.updateRIDER', compact('usuario',"rider","listaAvatares","administrador"));
        }
        else if ($tipo === "proveedor")
        {
            $proveedor = Proveedor::where("id", "=", $usuario->id)->first();
            return view('administradores.updatePROVEEDOR', compact('usuario', "proveedor","administrador"));
        }
        else
        {
            $administrador = Administrador::where("id", "=", $usuario->id)->first();
            return view('administradores.updateADMIN', compact('usuario', "administrador"));
        }
        

        //$rider = Rider::where("id","=",$usuario->id)->first();
        //return view('administradores.updateRIDER', compact('usuario',"rider"));

        // $proveedor = Proveedor::where("id","=",$usuario->id)->first();
        // return view('administradores.updatePROVEEDOR', compact('usuario',"proveedor"));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $tipo=$request->tipo;

        if ($tipo === "proveedor")
        {
            $nombreEmpresa = $request->input("NombreEmpresa");
        }
        else
        {
            $nombre = $request->input("Nombre");
        }
        $email=$request->input("Email");
        $telefono=$request->input("Telefono");

        //Asignar los valores del formulario a su respectivo campo
        if ($tipo === "proveedor")
        {
            $usuario->nombre = $nombreEmpresa;
        }
        else
        {
            $usuario->nombre = $nombre;
        }
        $usuario->email=$email; 
        $usuario->telefono=$telefono;

        try
        {
            //Hacer el insert en la tabla
            $usuario->save();
            if ($tipo === "administrador")
            {
                $administradore=Administrador::where("id","=",$usuario->id)->first();
                $response=app(AdministradorController::class)->update($request,$administradore);
            }
            else if ($tipo === "proveedor")
            {
                $request->merge(['tipoDeModificacion' => "edicionGeneralDelProveedor"]);
                $proveedore=Proveedor::where("id","=",$usuario->id)->first();
                $response=app(ProveedorController::class)->update($request,$proveedore);
            }
            else if ($tipo === "rider")
            {
                $rider=Rider::where("id","=",$usuario->id)->first();
                $response=app(RiderController::class)->update($request,$rider);
            }
        }
        catch(QueryException $ex)
        {
            $mensaje=Utilidad::errorMessage($ex);
            $request->session()->flash("error",$mensaje);
            if(Auth::user()->tipo==="administrador")
            {
                $administrador=Administrador::where("id","=",Auth::user()->id)->first();
                $response=redirect()->action([UsuarioController::class, "edit"],["usuario"=>$usuario,'tipo'=>$tipo,"idAdministrador"=>$administrador->id])->withInput();
            }
            else if(Auth::user()->tipo==="proveedor")
            {
                $proveedore=Proveedor::where("id","=",$usuario->id)->first();
                $response=redirect()->route("proveedores.edit", compact("proveedore"))->withInput();
            }
            else
            {
                $rider=Rider::where("id","=",$usuario->id)->first();
                $response=redirect("/home");
            }
        }

        return $response;
    }

    public function destroy(Request $request, Usuario $usuario)
    {
        //Recuperar los datos del formulario
        $tipo = $request->input("tipo");

        if ($tipo === "rider")
        {
            $usuario->delete();

            return redirect()->action([UsuarioController::class, 'index']);
        }

        if ($tipo === "proveedor")
        {
            $usuario->delete();
            return redirect()->route("proveedores.index");
        }
    }
}