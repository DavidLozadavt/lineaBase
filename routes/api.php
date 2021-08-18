<?php

use App\Http\Controllers\gestion_empresa\CompanyController;
use App\Http\Controllers\gestion_rol\RolController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\gestion_rol_permisos\AsignacionRolPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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
Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user', [UserController::class, 'logged']);
    Route::post('/user_company/{idCompany}', [UserController::class, 'setCompany']);
});

Route::resource('roles', RolController::class);
Route::get('list_companies', [CompanyController::class, 'index']);

//permisos
Route::get('permisos', [AsignacionRolPermiso::class, 'index']);
Route::get('permisos_rol', [AsignacionRolPermiso::class, 'permissionsByRole']);
Route::put('asignar_rol_permiso', [AsignacionRolPermiso::class, 'assignFunctionality']);
