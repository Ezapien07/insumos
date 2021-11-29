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
    Route::get('/reporte_insumos', 'ReportesController@consultarReporteInsumos');
    Route::get('/reporte_compras', 'ReportesController@consultarReporteCompras');
    Route::get('/reporte_compras_graficas', 'ReportesController@consultarReporteComprasG');
    Route::get('/consultarInsumos', 'ReportesController@consultarReporteInsumosG');
    Route::get('/consultarComprasG', 'ReportesController@consultarReporteComprasGrafica');
    Route::get('/compras', 'ComprasControlador@Consultar')->name('compras');
    Route::get('/compras_inactivas', 'ComprasControlador@ConsultarInactivos')->name('compras');
    Route::get('/compras_contador', 'ComprasControlador@ConsultarContador')->name('compras');
    Route::get('/compras_directivo', 'ComprasControlador@ConsultarDirectivo')->name('compras');
});

Route::group(['prefix' => 'insumos/acciones'], function () {
    Route::post('/agregar', 'InsumosControlador@Agregar');
    Route::post('/buscar', 'InsumosControlador@Buscar');
    Route::post('/modificar', 'InsumosControlador@Modificar');
    Route::post('/eliminar', 'InsumosControlador@Eliminar');
    Route::post('/activar', 'InsumosControlador@Activar');
});

Route::group(['prefix' => 'compras/acciones'], function () {
    Route::post('/agregar', 'ComprasControlador@Agregar');
    Route::post('/buscar', 'ComprasControlador@Buscar');
    Route::post('/modificar', 'ComprasControlador@Modificar');
    Route::post('/eliminar', 'ComprasControlador@Eliminar');
    Route::post('/directivo', 'ComprasControlador@EstatusDirectivo');
    Route::post('/contador', 'ComprasControlador@EstatusContador');
    Route::post('/almacen_solicitar', 'ComprasControlador@EstatusCompraSolicitado');
    Route::post('/almacen_recibido', 'ComprasControlador@EstatusCompraRecibido');
});
