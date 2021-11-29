<?php

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
Route::post('/loginApi', 'LoginController@loginApi');
Route::middleware('auth:api')->get('/empleados/all', 'EmpleadoController@showAll');
Route::middleware('auth:api')->post('/empleado/create','EmpleadoController@create');
Route::middleware('auth:api')->post('/empleado/edit','EmpleadoController@edit');
Route::middleware('auth:api')->post('/empleado/delete','EmpleadoController@delete');
Route::middleware('auth:api')->post('/prestamo/solicitud','PrestamoController@solicitarPrestamos');
Route::middleware('auth:api')->post('/prestamo/aprobarAdmin','PrestamoController@aprobarAdmin');
Route::middleware('auth:api')->get('/prestamos','PrestamoController@getAll');
Route::middleware('auth:api')->get('/insumos/getAll', 'InsumosController@getAll');
Route::middleware('auth:api')->post('/prestamo/aprobarGerente','PrestamoController@aprobarGerente');
/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
