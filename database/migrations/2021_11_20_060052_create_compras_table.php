<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado')->references('id')->on('empleados');
            $table->string('insumo');
            $table->string('link_op1');
            $table->integer('precio_op1');
            $table->string('link_op2');
            $table->integer('precio_op2');
            $table->date('fecha_compra')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();//null al inicio
            $table->unsignedBigInteger('id_directivo')->nullable();//null al inicio
            $table->unsignedBigInteger('id_contador')->nullable();//null al inicio
            $table->enum('estatus',['PendienteDirectivo','PendienteAdmin','Confirmado','Solicitado']);
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
        Schema::dropIfExists('compras');
    }
}
