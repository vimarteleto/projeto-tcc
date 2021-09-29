<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
                        
            $table->string('numero_33')->nullable();
            $table->string('numero_34')->nullable();
            $table->string('numero_35')->nullable();
            $table->string('numero_36')->nullable();
            $table->string('numero_37')->nullable();
            $table->string('numero_38')->nullable();
            $table->string('numero_39')->nullable();
            $table->string('numero_40')->nullable();
            $table->string('numero_41')->nullable();
            $table->string('numero_42')->nullable();
            $table->string('numero_43')->nullable();
            $table->string('numero_44')->nullable();
            $table->string('numero_45')->nullable();
            $table->string('numero_46')->nullable();
            $table->string('numero_47')->nullable();
            $table->string('numero_48')->nullable();

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
        Schema::dropIfExists('grades');
    }
}
