<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apePaterno');
            $table->string('apeMaterno');
            $table->string('calle');
            $table->integer('num');
            $table->enum('rol',['Administrador', 'Directivo','Almacen','Empleado','Contador']);
            $table->string('colonia');
            $table->string('estado');
            $table->string('municipio');
            $table->string('curp');
            $table->string('rfc');
            $table->string('correo');
            $table->integer('cp');
            $table->string('password');
            $table->enum('estatus',['Activo','Inactivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
