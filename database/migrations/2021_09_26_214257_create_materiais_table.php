<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco');
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('grade_id')->nullable();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onUpdate('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onUpdate('cascade');

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
        Schema::dropIfExists('materiais');
    }
}
