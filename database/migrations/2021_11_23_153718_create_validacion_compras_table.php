<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidacionComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacion_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_directivo')->nullable();//null al inicio
            $table->unsignedBigInteger('id_contador')->nullable();//null al inicio
            $table->enum('estatus',['PendienteDirectivo','PendienteContador','Autorizado','Rechazado','Solicitado','Recibido']);
            $table->string('datos_autoriza')->nullable();
            $table->string("fechas_autoriza")->nullable();
            $table->string("motivo_rechazo")->nullable();
            $table->date('fecha_registro')->nullable()->default(date('Y-m-d'));
            $table->foreignId('id_compra')->references('id')->on('compras');
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
        Schema::dropIfExists('validacion_compras');
    }
}