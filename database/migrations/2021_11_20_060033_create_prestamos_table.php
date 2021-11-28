<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->date('fechaSolicitud');//
            $table->string('motivo'); //motivo solicitud
            $table->string('observaciones');
            $table->date('fechaEntrega')->nullable(); //permite ser null 
            $table->enum('estatus',['Activo','Cancelado','Devolución','Almacen']);
            $table->integer('cantidad')->default(0);
            $table->string('motivo_cancelacion')->nullable();
            $table->string('motivo_devolucion')->nullable();
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_insumo')->references('id')->on('insumos');
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
        Schema::dropIfExists('prestamos');
    }
}
