<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('pedido_cliente');
            $table->string('cliente_id');
            $table->string('representante_id');
            $table->string('marca')->default('Guilder');
            $table->string('data_entrega');
            $table->string('condicao_pagamento');
            $table->string('transportador_id');
            $table->string('frete', 3); // CIF ou FOB
            $table->integer('volumes')->nullable();
            $table->float('peso_liquido'); // vem da referencia
            $table->float('peso_bruto'); // somar com peso do volume
            $table->string('situacao', 1); // nao-planejado, planejado, concluido
            $table->string('observacoes');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('cadastros')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('representante_id')->references('id')->on('cadastros')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('transportador_id')->references('id')->on('cadastros')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
