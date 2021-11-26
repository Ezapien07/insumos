<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Empleados;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function showAll()
    {
        if (Auth::user()->rol === 'Administrador') {
            $empleados = Empleados::join('users', 'id_user', '=', 'users.id')
                ->get();
            return response()->json(['Empleados' => $empleados], 200);
        } else {
            return response()->json(['Error' => 'Solo el administrador puede tener acceso a los empleados'], 404);
        }
    }
    public function create(Request $request)
    {
        if (Auth::user()->rol == 'Administrador') {
            /* nombre
            apePaterno
            apeMaterno
            telefono
            curp
            rfc
            correo
            password
            calle
            num_casa
            colonia
            municipio
            estado
            codigo_postal */
            try {
                $user = new User();
                $user->name = $request->nombre;
                $user->email = $request->correo;
                $user->password =Hash::make( $request->password);
                $user->rol='Empleado';
                $user->estatus=1;
                $user->save();
                $empleado = new  Empleados();
                $empleado->nombre = $request->nombre;
                $empleado->apePaterno = $request->apePaterno;
                $empleado->apeMaterno = $request->apeMaterno;
                $empleado->telefono = $request->telefono;
                $empleado->curp = $request->curp;
                $empleado->rfc = $request->rfc;
                $empleado->correo = $request->correo;
                $empleado->calle = $request->calle;
                $empleado->num_casa = $request->num_casa;
                $empleado->colonia = $request->colonia;
                $empleado->municipio = $request->municipio;
                $empleado->estado=$request->estado;
                $empleado->codigo_postal = $request->codigo_postal;
                $empleado->id_user = $user->id;
                $empleado->save();
                return response()->json(['usuario' => $user,"empleado"=>$empleado], 200);
            } catch (Exception $error) {
                return response()->$error;
            }
        } else {
            return response()->json(['Error' => 'Solo el administrador puede tener acceso a los empleados'], 404);
        }
    }
}
