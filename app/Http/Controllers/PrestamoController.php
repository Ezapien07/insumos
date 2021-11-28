<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prestamos;
use App\Models\Validacion_prestamo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\Return_;

class PrestamoController extends Controller
{
    public function solicitarPrestamos(Request $request)
    {
        try {
            $prestamo = new Prestamos();
            $prestamo->motivo = $request->motivo;
           
            $prestamo->observaciones = $request->observaciones;
            //	YYYY-MM-DD hh:mm:ss[.nnn]
            $prestamo->fechaSolicitud =date('Y-m-d h:i:s');  
            if ($request->cantidad) {
                $prestamo->cantidad = $request->cantidad;
            }
            if($request->motivo_cancelacion){
                $prestamo->motivo_cancelacion = $request->motivo_cancelacion;
            }
            if($request->motivo_devolucion){
                $prestamo->motivo_devolucion = $request->motivo_devolucion;
            }
            if($request->fechaEntrega)
            {
                $prestamo->fechaEntrega = $request->fechaEntrega;
            }
            $prestamo->estatus='Activo';
            
            $prestamo->id_user = $request->id_user;
            
            $prestamo->id_insumo = $request->id_insumo;
            //return $prestamo;
            $prestamo->save();
            return response()->json(["prestamo"=>$prestamo->id,"msj"=>'Prestamo solicitado, esperando aprobacion ']);
        } catch (Exception $ex) {
            return response()->json(["exception"=>$ex->getMessage()]);
        }
    }
    
    public function aprobarAdmin(Request $request)
    {
        try {
            $detallePrestamos=new Validacion_prestamo();
            if($request->estatus==1)
            {
                $detallePrestamos->estatus='Autorizada';
            }else if($request->estatus==2)
            {
                $detallePrestamos->estatus='Rechazada';
            }
            if($request->cancelacion)
            {
                $detallePrestamos->cancelacion=$request->cancelacion;
            }else{
                $detallePrestamos->cancelacion='';
            }
            $detallePrestamos->rol=$request->rol;
            if($request->observaciones)
            {
                $detallePrestamos->observaciones=$request->observaciones;
            }else{
                $detallePrestamos->observaciones='';
            }
            $detallePrestamos->id_user=$request->id_user;
            $detallePrestamos->id_prestamos=$request->id_prestamo;
            return $detallePrestamos;
        } catch (Exception $ex) {
            return response()->$ex;
        }
    }
}
