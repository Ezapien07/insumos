<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Administrador',
            'email' => 'admin@gps.com.mx',
            'password' => Hash::make('admin.1234'),
            'rol'=>'Administrador',
            'estatus'=>'Activo'
        ]);
        User::create([
            'name'=>'Admin Gerente',
            'email' => 'gerente@gps.com.mx',
            'password' => Hash::make('gerente.1234'),
            'rol'=>'Gerente',
            'estatus'=>'Activo'
        ]);
        User::create([
            'name'=>'Admin contador',
            'email' => 'contador@gps.com.mx',
            'password' => Hash::make('contador.1234'),
            'rol'=>'Contador',
            'estatus'=>'Activo'
        ]);
        User::create([
            'name'=>'Admin empleado',
            'email' => 'empleado01@gps.com.mx',
            'password' => Hash::make('empleado.1234'),
            'rol'=>'Empleado',
            'estatus'=>'Activo'
        ]);
        Estado::create([
            'nombre'=>'Aguascalientes',
            'clave'=>01,
            'abrev'=>'Ags'
        ]);

        Estado::create([
            'nombre'=>'Baja California',
            'clave'=>02,
            'abrev'=>'BC'
        ]);
        Estado::create([
            'nombre'=>'Baja California Sur',
            'clave'=>03,
            'abrev'=>'BCS'
        ]);
        Estado::create([
            'nombre'=>'Campeche',
            'clave'=>04,
            'abrev'=>'Camp'
        ]);
        Estado::create([
            'nombre'=>'Coahuila',
            'clave'=>05,
            'abrev'=>'Coah'
        ]);
        Estado::create([
            'nombre'=>'Colima',
            'clave'=>06,
            'abrev'=>'Col'
        ]);
        Estado::create([
            'nombre'=>'Chiapas',
            'clave'=>07,
            'abrev'=>'Chis'
        ]);
        Estado::create([
            'nombre'=>'Chihuahua',
            'clave'=>8,
            'abrev'=>'Chih'
        ]);
        Estado::create([
            'nombre'=>'Ciudad de México',
            'clave'=>9,
            'abrev'=>'CDMX'
        ]);
        Estado::create([
            'nombre'=>'Durango',
            'clave'=>10,
            'abrev'=>'Dgo'
        ]);
        Estado::create([
            'nombre'=>'Guanajuato',
            'clave'=>11,
            'abrev'=>'Gto'
        ]);
        Estado::create([
            'nombre'=>'Guerrero',
            'clave'=>12,
            'abrev'=>'Gro'
        ]);
        Estado::create([
            'nombre'=>'Hidalgo',
            'clave'=>13,
            'abrev'=>'Hgo'
        ]);
        Estado::create([
            'nombre'=>'Jalisco',
            'clave'=>14,
            'abrev'=>'Jal'
        ]);
        Estado::create([
            'nombre'=>'México',
            'clave'=>15,
            'abrev'=>'Mex'
        ]);
        Estado::create([
            'nombre'=>'Michoacan de Ocampo',
            'clave'=>16,
            'abrev'=>'Mich'
        ]);
        Estado::create([
            'nombre'=>'Morelos',
            'clave'=>17,
            'abrev'=>'Mor'
        ]);
        Estado::create([
            'nombre'=>'Nayarit',
            'clave'=>18,
            'abrev'=>'Nay'
        ]);
        Estado::create([
            'nombre'=>'Nuevo León',
            'clave'=>19,
            'abrev'=>'NL'
        ]);
        Estado::create([
            'nombre'=>'Oaxaca',
            'clave'=>20,
            'abrev'=>'Oax'
        ]);Estado::create([
            'nombre'=>'Puebla',
            'clave'=>21,
            'abrev'=>'Pue'
        ]);
        Estado::create([
            'nombre'=>'Querérato',
            'clave'=>22,
            'abrev'=>'Qro'
        ]);
        Estado::create([
            'nombre'=>'Quintana Roo',
            'clave'=>23,
            'abrev'=>'Q.Roo'
        ]);
        Estado::create([
            'nombre'=>'San Luis Potosi',
            'clave'=>24,
            'abrev'=>'SLP'
        ]);
        Estado::create([
            'nombre'=>'Sinaloa',
            'clave'=>25,
            'abrev'=>'Sin'
        ]);
        Estado::create([
            'nombre'=>'Sonora',
            'clave'=>26,
            'abrev'=>'Son'
        ]);
        Estado::create([
            'nombre'=>'Tabasco',
            'clave'=>27,
            'abrev'=>'Tab'
        ]);
        Estado::create([
            'nombre'=>'Tamaulipas',
            'clave'=>28,
            'abrev'=>'Tamps'
        ]);
        Estado::create([
            'nombre'=>'Tlaxcala',
            'clave'=>29,
            'abrev'=>'Tlax'
        ]);
        Estado::create([
            'nombre'=>'Veracuz',
            'clave'=>30,
            'abrev'=>'Ver'
        ]);
        Estado::create([
            'nombre'=>'Yucatán',
            'clave'=>31,
            'abrev'=>'Sin'
        ]);
        Estado::create([
            'nombre'=>'Zacatecas',
            'clave'=>32,
            'abrev'=>'Zac'
        ]);
        Estado::create([
            'nombre'=>'Edo. México',
            'clave'=>35,
            'abrev'=>'Edo. Mex'
        ]);
        Estado::create([
            'nombre'=>'Arizona',
            'clave'=>001,
            'abrev'=>'AZ'
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
