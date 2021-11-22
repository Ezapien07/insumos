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
    return view('layouts.layout');
});

Route::get('/insumos', 'InsumosControlador@consultar')->name('insumos');
Route::group(['prefix' => 'insumos/acciones'], function () {
    Route::post('/agregar', 'InsumosControlador@Agregar');
    /*Route::post('/buscar', 'MateriaPrimaController@buscar');
    Route::post('/modificar', 'MateriaPrimaController@modificar');
    Route::post('/eliminar', 'MateriaPrimaController@eliminar');
    Route::post('/buscarExistente', 'MateriaPrimaController@buscarExistente');
    Route::post('/activar', 'MateriaPrimaController@activar');*/
});
