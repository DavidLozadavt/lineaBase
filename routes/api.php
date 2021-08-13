<?php

use App\Http\Controllers\gestion_empresa\CompanyController;
use App\Http\Controllers\gestion_rol\RolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list_roles', [RolController::class, 'index']);
Route::get('list_companies', [CompanyController::class, 'index']);
