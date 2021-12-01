<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('item_pedido_id');
            $table->unsignedBigInteger('material_id');
            $table->string('material');
            $table->float('consumo');
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item_pedido_id')->references('id')->on('item_pedido')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materiais')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_pedido');
    }
}
