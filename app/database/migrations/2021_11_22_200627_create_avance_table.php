<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avances', function (Blueprint $table) {
            $table->id();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
            $table->unsignedBigInteger('id_concepto')->nullable();
            $table->foreign('id_concepto')->references('id')->on('conceptos');
            $table->integer('localizacion')->default(0);
            $table->integer('altura')->default(0);
            $table->integer('anchoM')->default(0);
            $table->integer('anchoP')->default(0);
            $table->integer('volumenT')->default(0);
            $table->integer('pieza')->default(0);
            $table->integer('espesor')->default(0);
            $table->integer('area')->default(0);



            


            // $table->double('hombro_derecho1',15,2);
            // $table->double('hombro_derecho2',15,2);
            // $table->double('hombro_izquierdo1',15,2);
            // $table->double('hombro_izquierdo2',15,2);
            // $table->double('ancho1',15,2);
            // $table->double('ancho2',15,2);
       
       


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
        Schema::dropIfExists('avances');
    }
}
