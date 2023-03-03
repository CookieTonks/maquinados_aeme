<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CotizacionesPartidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cotizaciones_partidas', function (Blueprint $table)
      {
       $table->id();
       $table->string('numero_cotizacion')->nullable();
       $table->string('numero_cotizacion_partida')->nullable();
       $table->string('descripcion')->nullable();
       $table->string('cantidad')->nullable();
       $table->string('precio_unitario')->default('N/A');
       $table->string('partida_total')->nullable();
       $table->string('numero_parte')->nullable();
       $table->string('revision')->nullable();
       $table->string('tipo_acero')->nullable();
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
      Schema::dropIfExists('cotizaciones_partidas');

    }
}
