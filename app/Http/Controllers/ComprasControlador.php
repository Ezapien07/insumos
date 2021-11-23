<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComprasControlador extends Controller
{
    public function Consultar()
    {
        $insumos =[];
        return view('compras.compras', compact('insumos'));
    }
    public function ConsultarInactivos()
    {
        $insumos =[];
        return view('compras.compras_inactivas', compact('insumos'));
    }
}
