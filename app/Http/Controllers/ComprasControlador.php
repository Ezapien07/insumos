<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\Insumos;
use App\Models\ValidacionCompras;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComprasControlador extends Controller
{
    public function Consultar()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Activo");
        $compras = Compras::join('validacion_compras', 'compras.id', '=', 'validacion_compras.id_compra')->where('compras.estatus', '=', 'Activo')->get();
        return view('compras.compras', compact('insumos', 'compras'));
    }
    public function ConsultarContador()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Activo");
        $compras = Compras::join('validacion_compras', 'compras.id', '=', 'validacion_compras.id_compra')
            ->where('compras.estatus', '=', 'Activo')
            ->where('validacion_compras.estatus', '=', 'Pendiente Contador')
            ->get();
        return view('compras.compras', compact('insumos', 'compras'));
    }
    public function ConsultarDirectivo()
    {
        $insumos = Insumos::all()->where("estatus", "=", "Activo");
        $compras = Compras::join('validacion_compras', 'compras.id', '=', 'validacion_compras.id_compra')
        ->where('compras.estatus', '=', 'Activo')
        ->where('validacion_compras.estatus', '=', 'Pendiente Directivo')
        ->get();
        return view('compras.compras', compact('insumos', 'compras'));
    }
    public function ConsultarInactivos()
    {
        $compras = Compras::join('validacion_compras', 'compras.id', '=', 'validacion_compras.id_compra')->where('compras.estatus', '=', 'Inactivo')->get();
        return view('compras.compras_inactivas', compact('compras'));
    }

    public function Agregar(Request $request)
    {
        try {
            $mCompras = new Compras();
            $mCompras->fill($request->all());
            $mCompras->id_user = Auth::user()->id;
            $mCompras->id_insumo = (int)$request->id_insumo;
            $mCompras->cantidad_solicitada = (int)$request->cantidad_solicitada;
            $mCompras->save();

            $mComprasValidacion = new ValidacionCompras();
            $mComprasValidacion->estatus = $request->estatus_validacion;
            $mComprasValidacion->id_compra = $mCompras->id;
            $mComprasValidacion->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function Buscar(Request $request)
    {
        try {
            $compras = Compras::join('validacion_compras', 'compras.id', '=', 'validacion_compras.id_compra')
            ->where('compras.id', '=', $request->id)
            ->get();
            return $compras;
        } catch (Exception $err) {
            return $err;
        }
    }

    public function Modificar(Request $request)
    {
        try {
            $mCompras = Compras::find($request->id);
            $mCompras->link_op1 = $request->link_op1;
            $mCompras->precio_op1 = $request->precio_op1;
            $mCompras->link_op2 = $request->link_op2;
            $mCompras->precio_op2 = $request->precio_op2;
            $mCompras->cantidad_solicitada = (int)$request->cantidad_solicitada;
            $mCompras->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function Eliminar(Request $request)
    {
        try {
            $mCompras = Compras::find($request->id);
            $mCompras->estatus = 'Inactivo';
            $mCompras->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function EstatusDirectivo(Request $request)
    {
        try {
            $mValidacionCompra = ValidacionCompras::where('id_compra', '=', $request->id)->get()->first();;
            if ($request->estatus == "Aceptado Directivo") {
                $mValidacionCompra->estatus = 'Pendiente Contador';
                $mValidacionCompra->datos_autoriza .= 'Directivo: Autorizado';
                $mValidacionCompra->fechas_autoriza .= date('Y/m/d');
                $mValidacionCompra->id_directivo = Auth::user()->id;
            } else {
                $mValidacionCompra->estatus = 'Rechazado';
                $mValidacionCompra->datos_autoriza .= 'Directivo: Rechazado';
                $mValidacionCompra->fechas_autoriza .= date('Y/m/d');
                $mValidacionCompra->motivo_rechazo = $request->motivo_rechazo;
                $mValidacionCompra->id_directivo = Auth::user()->id;
                $mCompras = Compras::find($request->id);
                $mCompras->estatus = 2;
                $mCompras->save();
            }
            $mValidacionCompra->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function EstatusContador(Request $request)
    {
        try {
            $mValidacionCompra = ValidacionCompras::where('id_compra', '=', $request->id)->get()->first();;
            if ($request->estatus == "Aceptado Contador") {
                $mValidacionCompra->estatus = 3;
                $mValidacionCompra->datos_autoriza .= '     Contador: Autorizado';
                $mValidacionCompra->fechas_autoriza .= "   ".date('Y/m/d');
                $mValidacionCompra->producto_comprar = $request->producto_comprar;
                $mValidacionCompra->precio_producto = (int) $request->precio_producto;
                $mValidacionCompra->total_pagar = (int)$request->precio_producto * (int)$request->cantidad;
                $mValidacionCompra->id_contador = Auth::user()->id;
            } else {
                $mValidacionCompra->estatus = 4;
                $mValidacionCompra->datos_autoriza .= '  Contador: Rechazado';
                $mValidacionCompra->fechas_autoriza .= "   ".date('Y/m/d');
                $mValidacionCompra->motivo_rechazo = $request->motivo_rechazo;
                $mValidacionCompra->id_contador = Auth::user()->id;
                $mCompras = Compras::find($request->id);
                $mCompras->estatus = 2;
                $mCompras->save();
            }
            $mValidacionCompra->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function EstatusCompraSolicitado(Request $request)
    {
        try {
            $mComprasValidacion = ValidacionCompras::where('id_compra', '=', $request->id)->get()->first();
            $mComprasValidacion->estatus = 5;
            $mComprasValidacion->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }

    public function EstatusCompraRecibido(Request $request)
    {
        try {
            $mComprasValidacion = ValidacionCompras::where('id_compra', '=', $request->id)->get()->first();;
            $mComprasValidacion->estatus = 6;
            $mCompras = Compras::find($request->id);
            $mCompras->estatus = 2;
            $mInsumos = Insumos::find($mCompras->id_insumo);
            $mInsumos->cantidad += $mCompras->cantidad_solicitada;
            $mInsumos->save();
            $mCompras->save();
            $mComprasValidacion->save();
            return 'OK';
        } catch (Exception $err) {
            return $err;
        }
    }
}
