<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('concepto')->nullable();
            $table->unsignedBigInteger('id_unidad')->nullable();
            $table->foreign('id_unidad')->references('id')->on('unidad');
            $table->double('cantidad',12,3)->nullable();
            $table->double('punitario',12,3)->nullable();
            $table->string('precio_letra')->nullable();
            $table->double('importe',10,2)->nullable();
            $table->double('porcentaje',6,2)->nullable();
            $table->integer('estatus')->default(0);
            $table->integer('avance')->nullable();
        
            $table->unsignedBigInteger('id_codigo')->nullable();
            $table->foreign('id_codigo')->references('id')->on('conceptos');

            $table->unsignedBigInteger('id_contrato')->nullable();
            $table->foreign('id_contrato')->references('id')->on('contratos');

        
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
        Schema::dropIfExists('conceptos');
    }
}
