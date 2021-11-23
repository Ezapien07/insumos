<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
    }
}
