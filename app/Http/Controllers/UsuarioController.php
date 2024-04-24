<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Reserva;
use App\Models\Usuario;
use App\Models\Administrador;
use App\Clases\Utilidad;
use App\Models\Proveedor;
use App\Models\AvatarRider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Http\Controllers\ProveedorController;

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
            $response = redirect()->action([UsuarioController::class, "create"], ['tipo' => $tipo])->withInput();
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
        $tipo = $request->input("tipo");

        if ($tipo === "rider")
        {
            $avataresRider = AvatarRider::all();
            $listaAvatares = [];
            for ($i = 0; $i < count($avataresRider); $i++)
            {
                array_push($listaAvatares, $avataresRider[$i]["avatar"]);
            }
            $rider = Rider::where("id", "=", $usuario->id)->first();
            return view('administradores.updateRIDER', compact('usuario', "rider","listaAvatares"));
        }
        if ($tipo === "proveedor")
        {
            $proveedor = Proveedor::where("id", "=", $usuario->id)->first();
            return view('administradores.updatePROVEEDOR', compact('usuario', "proveedor"));
        }

        //$rider = Rider::where("id","=",$usuario->id)->first();
        //return view('administradores.updateRIDER', compact('usuario',"rider"));

        // $proveedor = Proveedor::where("id","=",$usuario->id)->first();
        // return view('administradores.updatePROVEEDOR', compact('usuario',"proveedor"));
    }

    public function update(Request $request, Usuario $usuario)
    {
        //Recuperar los datos del formulario
        $tipo = $request->input("tipo");

        if ($tipo === "rider")
        {

            // Obtener el rider asociado con el usuario
            $rider = Rider::where("id", "=", $usuario->id)->first();

            // Actualizar los datos del usuario
            $usuario->nombre = $request->input("Nombre");
            $usuario->email = $request->input("Email");
            $usuario->telefono = $request->input("Telefono");

            // Actualizar los datos del rider si existe
            if ($rider)
            {
                $rider->apellidos = $request->input("Apellidos");
                $rider->nickname = $request->input("Nickname");
                $rider->avatar = $request->input("Avatar");
                // $rider->stock_rider = $request->input("Stock");
                $rider->save();
            }

        $nombre = $request->input("nombre");
        $email = $request->input("email");
        $telefono = $request->input("telefono");
    
        // Actualizar los datos del usuario
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        $usuario->telefono = $telefono;
    
        try {
            // Guardar los cambios en el usuario
            $usuario->save();
    
            // Redirigir a donde necesites después de actualizar el perfil
            return redirect()->route("ruta.donde.quieras.redirigir");
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir al guardar los cambios
            // Puedes mostrar un mensaje de error y redirigir a la página de edición del perfil
            return redirect()->back()->withInput()->withErrors("Error al actualizar el perfil: " . $e->getMessage());
        }

        if ($tipo === "proveedor")
        {
            // Obtener el rider asociado con el usuario
            $proveedor = Proveedor::where("id", "=", $usuario->id)->first();

            // Actualizar los datos del usuario
            $usuario->nombre = $request->input("nombre");
            $usuario->email = $request->input("email");
            $usuario->telefono = $request->input("telefono");

            // Actualizar los datos del rider si existe
            if ($proveedor)
            {
                $proveedor->calle = $request->input("calle");
                $proveedor->numero = $request->input("numero");
                $proveedor->cp = $request->input("cp");
                $proveedor->ciudad = $request->input("ciudad");
                //    $proveedor->logo = $request->input("logo");
                $proveedor->stock_proveedor = $request->input("stock");
                $proveedor->save();
            }

            // Guardar los cambios en el usuario
            $usuario->save();

            // Redirigir a la página de inicio, o a donde necesites
            if ($tipo === "proveedor")
            {
                return redirect()->route("proveedor2");
            }
            else
            {
                return redirect()->route("proveedores.index");
            }
        }

        if ($tipo === "administrador")
        {

            // Obtener el rider asociado con el usuario
            $administrador = Administrador::where("id", "=", $usuario->id)->first();

            // Actualizar los datos del usuario
            $usuario->nombre = $request->input("nombre");
            $usuario->email = $request->input("email");
            $usuario->telefono = $request->input("telefono");
            // $contrasenia = $request->input("contraseña");
            // $usuario->contrasenia =\bcrypt($contrasenia);
           
            // Guardar los cambios en el usuario
            $usuario->save();

            // Redirigir a la página de inicio, o a donde necesites
            // return redirect()->route("administradores/administrador");
            return view('administradores/administrador');
        }





        //  // Obtener el rider asociado con el usuario
        //  $rider = Rider::where("id","=",$usuario->id)->first();

        //  // Actualizar los datos del usuario
        //  $usuario->nombre = $request->input("nombre");
        //  $usuario->email = $request->input("email");
        //  $usuario->telefono = $request->input("telefono");

        //  // Actualizar los datos del rider si existe
        //  if ($rider) {
        //      $rider->apellidos = $request->input("apellido");
        //      $rider->nickname = $request->input("nickname");
        //      $rider->avatar = $request->input("avatar");
        //      $rider->stock_rider = $request->input("stock");
        //      $rider->save();
        //  }

        //  // Guardar los cambios en el usuario
        //  $usuario->save();

        //  // Redirigir a la página de inicio, o a donde necesites
        //  return redirect()->action([UsuarioController::class, 'index']);




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