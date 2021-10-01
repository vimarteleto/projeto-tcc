<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->string('descricao');
            $table->decimal('quantidade');

            $table->foreign('material_id')->references('id')->on('materiais')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('estoques');
    }
}
