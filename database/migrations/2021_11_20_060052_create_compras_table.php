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
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_insumo')->references('id')->on('insumos');
            $table->string('insumo');
            $table->string('clave');
            $table->string('link_op1');
            $table->integer('precio_op1');
            $table->integer('cantidad_solicitada');
            $table->string('link_op2');
            $table->integer('precio_op2');
            $table->date('fecha_compra')->nullable()->default(date('Y-m-d'));
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
