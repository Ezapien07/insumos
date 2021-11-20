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
            $table->date('fechaSolicitud');
            $table->string('observaciones');
            $table->date('fechaEntrega')->nullable(); //permite ser null 
            $table->foreignId('id_empleado')->references('id')->on('empleado');
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
