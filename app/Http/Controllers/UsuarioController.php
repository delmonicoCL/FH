<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Models\Reserva;
use App\Models\Usuario;
use App\Clases\Utilidad;
use App\Models\Proveedor;
use App\Models\AvatarRider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuarioController extends Controller
{

    // FUNCIONES CHART.JS///
    private $usuariosPorTipo;

    public function __construct()
    {
        $this->usuariosPorTipo = Usuario::select('tipo', \DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->pluck('total', 'tipo');
    }

    public function usuariosPorTipo()
    {
        return view('estadisticas.usuarios_por_tipo', ['usuariosPorTipo' => $this->usuariosPorTipo]);
    }

    public function histogramaReservasPorEstado()
    {
        $reservasPorEstado = Reserva::select('estado', \DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->pluck('total', 'estado');

        return view('estadisticas.histograma', compact('reservasPorEstado'));
    }




    // FUNCIONES CHART.JS///


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
        $usuarios = Usuario::all();
        return redirect()->route('riders.index', compact("usuarios"));
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
    public function edit(Request $request, Usuario $usuario)
    {
        //Recuperar los datos del formulario
        $tipo=$request->input("tipo");

        if($tipo==="rider")
        {
            $rider = Rider::where("id","=",$usuario->id)->first();
            return view('administradores.updateRIDER', compact('usuario',"rider"));
        }
        if($tipo==="proveedor")
        {
            $proveedor = Proveedor::where("id","=",$usuario->id)->first();
            return view('administradores.updatePROVEEDOR', compact('usuario',"proveedor"));
        }

        //$rider = Rider::where("id","=",$usuario->id)->first();
        //return view('administradores.updateRIDER', compact('usuario',"rider"));

        // $proveedor = Proveedor::where("id","=",$usuario->id)->first();
        // return view('administradores.updatePROVEEDOR', compact('usuario',"proveedor"));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, Usuario $usuario)
     {


            //Recuperar los datos del formulario
            $tipo=$request->input("tipo");

            if($tipo==="rider")
            {
                
                // Obtener el rider asociado con el usuario
                $rider = Rider::where("id","=",$usuario->id)->first();
            
                // Actualizar los datos del usuario
                    $usuario->nombre = $request->input("nombre");
                    $usuario->email = $request->input("email");
                    $usuario->telefono = $request->input("telefono");
            
                // Actualizar los datos del rider si existe
                if ($rider) {
                    $rider->apellidos = $request->input("apellido");
                    $rider->nickname = $request->input("nickname");
                    $rider->avatar = $request->input("avatar");
                    $rider->stock_rider = $request->input("stock");
                    $rider->save();
                }
            
                // Guardar los cambios en el usuario
                $usuario->save();
            
                 // Redirigir a la página de inicio, o a donde necesites
                 return redirect()->route("riders.index");
            }
            if($tipo==="proveedor")
            {
               // Obtener el rider asociado con el usuario
               $proveedor = Proveedor::where("id","=",$usuario->id)->first();
            
               // Actualizar los datos del usuario
                   $usuario->nombre = $request->input("nombre");
                   $usuario->email = $request->input("email");
                   $usuario->telefono = $request->input("telefono");
           
               // Actualizar los datos del rider si existe
               if ($proveedor) {
                   $proveedor->calle = $request->input("calle");
                   $proveedor->numero = $request->input("numero");
                   $proveedor->cp = $request->input("cp");
                   $proveedor->ciudad = $request->input("ciudad");
                   $proveedor->logo = $request->input("logo");
                   $proveedor->stock_proveedor = $request->input("stock");
                   $proveedor->save();
               }
           
               // Guardar los cambios en el usuario
               $usuario->save();
           
               // Redirigir a la página de inicio, o a donde necesites
               return redirect()->route("proveedores.index");
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
     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Usuario $usuario)
    {

        //Recuperar los datos del formulario
        $tipo=$request->input("tipo");

        if($tipo==="rider")
        {
            $usuario->delete();

            return redirect()->action([UsuarioController::class, 'index']);
        }
        if($tipo==="proveedor")
        {
            $usuario->delete();
            return redirect()->route("proveedores.index");
        }        
    }
}
