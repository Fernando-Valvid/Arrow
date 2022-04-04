<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFianzaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fianzas', function (Blueprint $table) {
            $table->id();
            $table->double('monto', 20,2);
            $table->date('fecha');
            $table->integer('num_fianza');
            $table->unsignedBigInteger('id_contrato')->nullable();
            $table->foreign('id_contrato')->references('id')->on('contratos');
            
            $table->unsignedBigInteger('id_afianzadora')->nullable();
            $table->foreign('id_afianzadora')->references('id')->on('afianzadoras');
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
        Schema::dropIfExists('fianza');
    }
}
