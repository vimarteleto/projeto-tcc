<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('cor_referencia_id');
            $table->integer('item');
            $table->integer('numero_34');
            $table->integer('numero_35');
            $table->integer('numero_36');
            $table->integer('numero_37');
            $table->integer('numero_38');
            $table->integer('numero_39');
            $table->integer('numero_40');
            $table->integer('numero_41');
            $table->integer('numero_42');
            $table->integer('numero_43');
            $table->integer('numero_44');
            $table->integer('numero_45');
            $table->integer('quantidade');
            $table->float('preco');
            $table->float('desconto')->default(0);
            $table->float('total');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cor_referencia_id')->references('id')->on('cor_referencia')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pedido');
    }
}
