<?php

use App\Http\Controllers\gestion_empresa\CompanyController;
use App\Http\Controllers\gestion_rol\RolController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\gestion_notificacion\NotificacionController;
use App\Http\Controllers\gestion_proceso\ProcesoController;
use App\Http\Controllers\gestion_rol\AsignacionRolPermiso;
use App\Http\Controllers\gestion_documento\TipoDocumentoController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

use App\Http\Controllers\gestion_pago\MedioPagoController;
use App\Http\Controllers\gestion_pago\TipoPagoController;
use App\Http\Controllers\gestion_pago\PagoController;
use App\Http\Controllers\gestion_pago\TipoTransaccionController;
use App\Http\Controllers\gestion_pago\TransaccionController;
use App\Http\Controllers\gestion_usuario\UserController;

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

Route::get('sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('active_users',[AuthController::class,'getActiveUsers']);
    Route::post('set_company', [AuthController::class, 'setCompany']);
    Route::post('roles', [AuthController::class, 'getRoles']);
    Route::post('permissions', [AuthController::class, 'getPermissions']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'tipo_documento'
],function (){
    Route::resource('', TipoDocumentoController::class);
});

Route::resource('roles', RolController::class);
Route::get('list_companies', [CompanyController::class, 'index']);

// traer listado de los usuario por empresa
Route::get('lista_usuarios', [UserController::class, 'getUsers']);

Route::resource('usuarios', UserController::class);

Route::put('asignar_roles', [UserController::class, 'asignation']);

//permisos
Route::get('permisos', [AsignacionRolPermiso::class, 'index']);
Route::get('permisos_rol', [AsignacionRolPermiso::class, 'permissionsByRole']);
Route::put('asignar_rol_permiso', [AsignacionRolPermiso::class, 'assignFunctionality']);

// notificaciones
Route::resource('notificaciones', NotificacionController::class);
Route::put('notificaciones/read/{id}', [NotificacionController::class, 'read']);

// proceso
Route::resource('procesos', ProcesoController::class);

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'pagos'
], function () {

    Route::apiResource('pagos', PagoController::class);

    Route::apiResource('medio_pagos', MedioPagoController::class);

    Route::apiResource('tipo_pagos', TipoPagoController::class);

    Route::apiResource('transacciones', TransaccionController::class);

    Route::apiResource('tipo_transacciones', TipoTransaccionController::class);

});