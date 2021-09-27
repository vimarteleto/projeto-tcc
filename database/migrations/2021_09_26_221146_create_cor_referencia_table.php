<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorReferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cor_referencia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cor_id');
            $table->unsignedBigInteger('referencia_id');

            $table->unique(['cor_id', 'referencia_id']);

            $table->foreign('cor_id')->references('id')->on('cors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('referencia_id')->references('id')->on('referencias')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('cor_referencias');
    }
}
