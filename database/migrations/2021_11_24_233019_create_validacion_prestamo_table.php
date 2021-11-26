<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidacionPrestamoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacion_prestamo', function (Blueprint $table) {
            $table->id();
            $table->enum('estatus',['Autorizada','Rechazada']);
            $table->string('cancelación')->default('');
            //id_user
            //id_prestamo
            $table->enum('rol',['Administrador','Almacen']);
            $table->string('devolucion')->default('');
            $table->string('observaciones');
            $table->timestamps();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_prestamos')->references('id')->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validacion_prestamo');
    }
}
