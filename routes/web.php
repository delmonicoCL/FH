<?php

use App\Models\Rider;
use App\Models\Reserva;
use App\Models\Usuario;
use App\Models\Proveedor;
use App\Models\Administrador;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\AdministradorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::get("/login", [UsuarioController::class, "showLogin"])->name("login");
Route::post("/login", [UsuarioController::class, "login"]);
Route::get("/logout", [UsuarioController::class, "logout"]);

Route::middleware(["auth"])->group(function () {
    Route::get("/home", function () {
        $user = Auth::user();
        $id = $user["id"];
        switch ($user["tipo"]) {
            case "administrador":
                $administrador = Administrador::where("id", "=", $id)->first();
                $response = view("administradores/administrador", compact("user", "administrador"));
                break;
            case "proveedor":
                $proveedor = Proveedor::where("id", "=", $id)->first();
                $response = view("proveedor/proveedor1", compact("user", "proveedor"));
                break;
            default:
                $rider = Rider::where("id", "=", $id)->first();
                $reservas = Reserva::where("rider","=",$id)->where("estado","!=","finalizada")->get(); // Aquí se filtran las reservas finalizadas
                $response = view("riders/rider", compact("user", "rider","reservas"));
                break;
        }
        return $response;
    });
    Route::get('/proveedor1', function () {
        $user = Auth::user();
        if ($user["tipo"] === "proveedor") {
            return view('proveedor/proveedor1');
        } else {
            return view('auth.login');
        }
    })->name('proveedor1');

    Route::get('/proveedor2', function () {
        $user = Auth::user();
        $id = $user["id"];
        $proveedor = Proveedor::where("id", "=", $id)->first();
        $reservas = Reserva::where("proveedor","=",$id)->get();

        $riders = DB::table('reservas')
        ->join('usuarios', 'reservas.rider', '=', 'usuarios.id')
        ->select('usuarios.nombre AS nombre')
        ->where('reservas.proveedor',"=",$id)
        ->get();

        if ($user["tipo"] === "proveedor") {
            return view('proveedor/proveedor2',compact("user", "proveedor","reservas","riders"));
        } else {
            return view('auth.login');
        }
    })->name('proveedor2');

    Route::get('/formProveedor', function () {
        $user = Auth::user();
        $id = $user["id"];
        $proveedor = Proveedor::where("id", "=", $id)->first();
        if ($user["tipo"] === "proveedor") {
            return view('proveedor/formProveedor', compact("user", "proveedor"));
        } else {
            return view('auth.login');
        }
    })->name('formProveedor');
});

Route::get('/registros/elige_tipo_de_usuario', function () {
    return view('registros.elige_tipo_de_usuario');
})->name('registros.elige_tipo_de_usuario');

Route::get('/registros/administrador', function () {
    return view('registros.administrador');
});

Route::resource("usuarios", UsuarioController::class);

Route::resource("administradores", AdministradorController::class);

Route::resource("proveedores", ProveedorController::class);

Route::resource("riders", RiderController::class);

Route::resource("reservas", ReservaController::class);