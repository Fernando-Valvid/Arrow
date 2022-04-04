<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
           
            $table->id();
            $table->string('contrato');
            $table->string('nombre_obra');
            $table->string('descripcion');
            $table->date('fecha_alta');
            $table->string('ubicacion');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->integer('plazo_dias');
            $table->double('importe', 20,2);
            $table->double('amortizacion', 20,2);
            $table->integer('estatus')->default(0);
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->unsignedBigInteger('id_empresa')->nullable();
            $table->foreign('id_empresa')->references('id')->on('empresas');
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->foreign('id_responsable')->references('id')->on('users');
            $table->unsignedBigInteger('id_asistente')->nullable();
            $table->foreign('id_asistente')->references('id')->on('users');

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
        Schema::dropIfExists('contratos');
    }
}
