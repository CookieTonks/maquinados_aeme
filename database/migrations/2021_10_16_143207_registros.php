<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Registros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('registros', function (Blueprint $table) {
         $table->id();
         $table->string('tipo_salida')->nullable();
         $table->string('ot')->nullable();
         $table->string('cliente')->nullable();
         $table->string('partida_codigo')->nullable();
         $table->string('descripcion')->nullable();
         $table->string('cantidad')->nullable();
         $table->string('usuario')->nullable();
         $table->string('almacen')->nullable();
         $table->string('produccion')->nullable();
         $table->string('inspeccion')->nullable();
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
        Schema::dropIfExists('registros');
    }
}
