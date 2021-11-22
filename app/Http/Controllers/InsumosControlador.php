<?php

namespace App\Http\Controllers;

use App\Models\Insumos;
use Exception;
use Illuminate\Http\Request;

class InsumosControlador extends Controller
{
    public function consultar()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Activo");
        return view('insumos.insumos', compact('insumos'));
    }

    public function Agregar(Request $request)
    {
        try {
            $mInsumos = new Insumos();
            $mInsumos->fill($request->all());
            if ($request->tipo === 'true') {
                $mInsumos->tipo_producto = "Consumible";
            } else {
                $mInsumos->tipo_producto = "No Consumible";
            }
            $mInsumos->save();
            return "OK";
        } catch (Exception $err) {
            return $err;
        }
    }
}
