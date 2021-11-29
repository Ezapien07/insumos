<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class ReportesController extends Controller
{
    public function consultarReporteInsumos()
    {
        $insumos = DB::select("SELECT * FROM insumos");
        $tipos = DB::select("SELECT tipo_producto, COUNT(id) AS cantidad FROM insumos GROUP BY tipo_producto");
        return view('reportes.reporte_insumos', compact('insumos', 'tipos'));
    }

    public function consultarReporteInsumosG()
    {
        $data = [];
        $cantidad_insumos = DB::select("SELECT * FROM insumos");
        $data['cantidad_insumos'] = $cantidad_insumos;
        $tipos_insumos = DB::select("SELECT tipo_producto, COUNT(id) AS cantidad FROM insumos GROUP BY tipo_producto");
        $data['tipos_insumos'] = $tipos_insumos;
        return $data;
    }

    public function consultarReporteCompras()
    {
        $compras = DB::select("SELECT compras.clave, insumos.nombre AS nombre_insumo, insumos.descripcion AS descripcion_insumo, link_op1, precio_op1, cantidad_solicitada, link_op2, precio_op2, compras.estatus, fecha_compra, CONCAT('Orden de compra registrada el día ', DAY(fecha_compra),  ' de ',  ELT(MONTH(fecha_compra), 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'), ' del ', YEAR(fecha_compra), ' por ', em_registro.nombre, ' ', em_registro.apePaterno, ' ', em_registro.apeMaterno) AS descripcion_registro, IF (ISNULL(validacion_compras.id_directivo), 'Orden de compra pendiente por autorizar', CASE WHEN (validacion_compras.estatus + 0) = 4 && ISNULL(validacion_compras.id_contador) THEN CONCAT('Orden de compra rechazada', ' por ', em_directivo.nombre, ' ', em_directivo.apePaterno, ' ', em_directivo.apeMaterno, ' con el siguiente motivo: ', validacion_compras.motivo_rechazo) WHEN (validacion_compras.estatus + 0) = 2 THEN CONCAT('Orden de compra autotrizada',' por ', em_directivo.nombre, ' ', em_directivo.apePaterno, ' ', em_directivo.apeMaterno) END) AS descripcion_directivo, IF (ISNULL(validacion_compras.id_contador), IF((validacion_compras.estatus + 0) = 4, 'No aplica', 'Orden de compra pendiente por autorizar'), CASE WHEN (validacion_compras.estatus + 0) = 4 THEN CONCAT('Orden de compra rechazada',' por ', em_contador.nombre, ' ', em_contador.apePaterno, ' ', em_contador.apeMaterno, ' con el siguiente motivo: ', validacion_compras.motivo_rechazo)  when (validacion_compras.estatus + 0) = 3 then CONCAT('Orden de compra autorizada', ' por ', em_contador.nombre, ' ', em_contador.apePaterno, ' ', em_contador.apeMaterno) END) AS descripcion_contador, IF (ISNULL(validacion_compras.total_pagar), IF((validacion_compras.estatus + 0) = 4, 'No aplica', 'Orden de compra en proceso') , total_pagar) AS total_pagar, IF (ISNULL(validacion_compras.producto_comprar), IF((validacion_compras.estatus + 0) = 4, 'No aplica', 'Orden de compra en proceso') , producto_comprar) AS producto_comprar, IF (ISNULL(validacion_compras.precio_producto), IF((validacion_compras.estatus + 0) = 4, 'No aplica', 'Orden de compra en proceso') , precio_producto) AS precio_producto,  validacion_compras.estatus AS estatus_orden_compra FROM compras  INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id INNER JOIN insumos ON insumos.id = compras.id_insumo  INNER JOIN  empleados AS em_registro  ON em_registro.id_user = compras.id_user LEFT JOIN empleados AS em_directivo ON em_directivo.id_user = validacion_compras.id_directivo LEFT JOIN empleados AS em_contador ON em_contador.id_user = validacion_compras.id_contador");
        return view('reportes.reporte_compras', compact('compras'));
    }

    public function consultarReporteComprasG()
    {
        $data = [];
        $insumos_compras = DB::select("SELECT COUNT(compras.id) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0) = 3 GROUP BY compras.id_insumo");
        $data['insumos_compras'] = $insumos_compras;
        $insumos_solicitados = DB::select("SELECT SUM(compras.cantidad_solicitada) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0 ) = 3 GROUP BY compras.id_insumo");
        $data['insumos_solicitados'] = $insumos_solicitados;
        $insumos_total = DB::select("SELECT SUM(validacion_compras.total_pagar) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0 ) = 3 GROUP BY compras.id_insumo");
        $data['insumos_total'] = $insumos_total;
        return view('reportes.reporte_compras_graficas', compact('insumos_compras', 'insumos_solicitados', 'insumos_total'));
    }

    public function consultarReporteComprasGrafica()
    {
        $data = [];
        $insumos_compras = DB::select("SELECT COUNT(compras.id) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0) = 3 GROUP BY compras.id_insumo");
        $data['insumos_compras'] = $insumos_compras;
        $insumos_solicitados = DB::select("SELECT SUM(compras.cantidad_solicitada) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0 ) = 3 GROUP BY compras.id_insumo");
        $data['insumos_solicitados'] = $insumos_solicitados;
        $insumos_total = DB::select("SELECT SUM(validacion_compras.total_pagar) AS cantidad, insumos.nombre, insumos.descripcion, insumos.codigo FROM insumos INNER JOIN compras ON compras.id_insumo = insumos.id INNER JOIN validacion_compras ON validacion_compras.id_compra = compras.id WHERE (validacion_compras.estatus + 0 ) = 3 GROUP BY compras.id_insumo");
        $data['insumos_total'] = $insumos_total;
        return $data;
    }
}
