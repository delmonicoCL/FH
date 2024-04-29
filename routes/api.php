<?php
// routes/api.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PuaController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\RiderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/api/puas', 'App\Http\Controllers\Api\PuaController@storeFromForm')->name('puas.storeFromForm');

Route::apiResource('puas', PuaController::class);

Route::apiResource("proveedores",ProveedorController::class);

Route::apiResource("riders",RiderController::class);