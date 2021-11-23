<?php

namespace App\Http\Controllers;

use App\Models\Insumos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsumosControlador extends Controller
{
    public function consultar()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Activo");
        return view('insumos.insumos', compact('insumos'));
    }

    public function Consultar_Inactivos()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Inactivo");
        return view('insumos.insumos_inactivos', compact('insumos'));
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
            $mInsumos->user_id =  Auth::user()->id;
            $mInsumos->save();
            return "OK";
        } catch (Exception $err) {
            return $err;
        }
    }

    public function Modificar(Request $request)
    {
        try {
            $mInsumos = Insumos::find($request->id);
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

    public function Buscar(Request $request)
    {
        try {
            $mInsumos = Insumos::find($request->id);
            return $mInsumos;
        } catch (Exception $err) {
            return "ERROR";
        }
    }

    public function Eliminar(Request $request)
    {
        try {
            $mInsumos = Insumos::find($request->id);
            $mInsumos->estatus = 'Inactivo';
            $mInsumos->save();
            return "OK";
        } catch (Exception $err) {
            return $err;
        }
    }

    public function Activar(Request $request)
    {
        try {
            $mInsumos = Insumos::find($request->id);
            $mInsumos->estatus = 'Activo';
            $mInsumos->save();
            return "OK";
        } catch (Exception $err) {
            return $err;
        }
    }
}
