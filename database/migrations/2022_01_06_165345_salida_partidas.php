<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalidaPartidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_partidas', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->nullable();
            $table->string('entrega')->nullable();
            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('cantidad')->nullable();
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
        Schema::dropIfExists('salida_partidas');

    }
}
