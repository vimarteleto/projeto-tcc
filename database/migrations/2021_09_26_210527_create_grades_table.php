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
            $table->string('nome');
            $table->string('20')->nullable();
            $table->string('21')->nullable();
            $table->string('22')->nullable();
            $table->string('23')->nullable();
            $table->string('24')->nullable();
            $table->string('25')->nullable();
            $table->string('26')->nullable();
            $table->string('27')->nullable();
            $table->string('28')->nullable();
            $table->string('29')->nullable();
            $table->string('30')->nullable();
            $table->string('31')->nullable();
            $table->string('32')->nullable();
            $table->string('33')->nullable();
            $table->string('34')->nullable();
            $table->string('35')->nullable();
            $table->string('36')->nullable();
            $table->string('37')->nullable();
            $table->string('38')->nullable();
            $table->string('39')->nullable();
            $table->string('40')->nullable();
            $table->string('41')->nullable();
            $table->string('42')->nullable();
            $table->string('43')->nullable();
            $table->string('44')->nullable();
            $table->string('45')->nullable();
            $table->string('46')->nullable();
            $table->string('47')->nullable();
            $table->string('48')->nullable();
            $table->string('49')->nullable();
            $table->string('50')->nullable();

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
