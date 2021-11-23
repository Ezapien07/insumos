<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEloquent;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function home(){
        return view('login.pagina_principal');
    }

    public function login(){
        return view('login.login');
    }

    public function loginPost(Request $request){

        // Ejecutar validaciones de la petición
        $validateData = $request->validate([
        'password' => 'required',
        'email' => 'required|email'
        ]);

        #$credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request -> email, 'password'=> $request -> password, 'estatus' => 'Activo'])) {
            return 4; //Entra al sistema porque las credenciales son correctas
        } else {
            return 1; //Credenciales incorrectas
        }
    }
}
