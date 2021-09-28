<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('preco', 6, 2);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('grade_id')->nullable();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('materials');
    }
}
