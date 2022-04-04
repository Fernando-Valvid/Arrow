<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgavanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_avances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_avance')->nullable();
            $table->foreign('id_avance')->references('id')->on('avances');
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('countrycode')->nullable();
            $table->string('regioncode')->nullable();
            $table->string('regionname')->nullable();
            $table->string('cityname')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable(); 
            $table->string('imagen')->nullable();
            $table->string('descripcion')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('img_avances');
    }
}
