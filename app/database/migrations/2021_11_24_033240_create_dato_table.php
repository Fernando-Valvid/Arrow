<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->double('hombro_derecho1',12,2)->nullable();
            $table->double('hombro_derecho2',12,2)->nullable();
            $table->double('hombro_izquierdo1',12,2)->nullable();
            $table->double('hombro_izquierdo2',12,2)->nullable();
            $table->double('ancho1',12,2)->nullable();
            $table->double('ancho2',12,2)->nullable();
            $table->double('anchot',12,2)->nullable();
            $table->double('altura',12,2)->nullable();
            $table->integer('pieza')->nullable();
            $table->double('espesor',12,2)->nullable();
            $table->unsignedBigInteger('id_concepto')->nullable();
            $table->foreign('id_concepto')->references('id')->on('conceptos');
            $table->unsignedBigInteger('id_avance')->nullable();
            $table->foreign('id_avance')->references('id')->on('avances');
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
        Schema::dropIfExists('datos');
    }
}
