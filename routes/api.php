<?php

use App\Http\Controllers\gestion_empresa\CompanyController;
use App\Http\Controllers\gestion_rol\RolController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\gestion_notificacion\NotificacionController;
use App\Http\Controllers\gestion_proceso\ProcesoController;
use App\Http\Controllers\gestion_rol\AsignacionRolPermiso;
use App\Http\Controllers\gestion_documento\TipoDocumentoController;
use App\Http\Controllers\gestion_jornada\DiaController;
use App\Http\Controllers\gestion_jornada\JornadaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\gestion_pago\MedioPagoController;
use App\Http\Controllers\gestion_pago\TipoPagoController;
use App\Http\Controllers\gestion_pago\PagoController;
use App\Http\Controllers\gestion_pago\TipoTransaccionController;
use App\Http\Controllers\gestion_pago\TransaccionController;
use App\Http\Controllers\gestion_proceso\AsignacionProcesoTipoDocumentoController;
use App\Http\Controllers\gestion_usuario\PersonaController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('active_users', [AuthController::class, 'getActiveUsers']);
    Route::post('set_company', [AuthController::class, 'setCompany']);
    Route::post('roles', [AuthController::class, 'getRoles']);
    Route::post('permissions', [AuthController::class, 'getPermissions']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'users'
], function () {

    Route::resource('users', UserController::class);

    Route::resource('person', PersonaController::class);

});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'permisos'
], function () {

    Route::apiResource('permisos', AsignacionRolPermiso::class)->only(['index']);

    Route::get('permisos_rol', [AsignacionRolPermiso::class, 'permissionsByRole']);

    Route::put('asignar_rol_permiso', [AsignacionRolPermiso::class, 'assignFunctionality']);

    Route::put('asignar_roles', [AsignacionRolPermiso::class, 'asignation']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'roles'
], function () {
    Route::apiResource('roles', RolController::class);

    Route::get('roles_by_company', [RolController::class, 'getRoleByCompany']);
});


Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'documentos'
], function () {
    Route::resource('tipo_documento', TipoDocumentoController::class);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'procesos'
], function () {
    Route::resource('proceso', ProcesoController::class);
    Route::resource('tipo_documento_proceso', AsignacionProcesoTipoDocumentoController::class);
});

Route::resource('ciudades', CiudadController::class);
Route::resource('departamentos', DepartamentoController::class);

Route::get('list_companies', [CompanyController::class, 'index']);

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

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'jornadas'
], function () {

    Route::apiResource('jornadas', JornadaController::class);

    Route::apiResource('dias', DiaController::class)->only(['index']);
    
});
