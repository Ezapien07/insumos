<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login.login');
});

Route::post('/login', 'LoginController@loginPost');
Route::get('/logout', 'LoginController@logout');
Route::get('/login', 'LoginController@login')->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/pagina_principal', 'LoginController@home')->name('home');
    Route::get('/insumos_inactivos', 'InsumosControlador@Consultar_Inactivos')->name('insumos');
    Route::get('/insumos', 'InsumosControlador@consultar')->name('insumos');
});

Route::group(['prefix' => 'insumos/acciones'], function () {
    Route::post('/agregar', 'InsumosControlador@Agregar');
    Route::post('/buscar', 'InsumosControlador@Buscar');
    Route::post('/modificar', 'InsumosControlador@Modificar');
    Route::post('/eliminar', 'InsumosControlador@Eliminar');
    Route::post('/activar', 'InsumosControlador@Activar');
});
