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
}
