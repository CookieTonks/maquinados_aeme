<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Partidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('partidas', function (Blueprint $table) {
         $table->id();
         $table->string('requisicion')->nullable();
         $table->string('partida')->nullable();
         $table->string('descripcion')->nullable();
         $table->integer('cantidad')->nullable();
         $table->string('material')->nullable();
         $table->string('unidad')->nullable();
         $table->integer('precio_unitario')->nullable();
         $table->string('proveedor')->nullable();
         $table->string('ot')->nullable();
         $table->string('factura')->nullable();
         $table->string('orden_compra')->nullable();
         $table->string('tipo_requisicion')->nullable();
         $table->string('partida_recibida')->default(0);
         $table->string('salida_partida')->default(0);
         $table->string('certificado_cargado')->default(0);
         $table->string('cliente')->nullable();
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
      Schema::dropIfExists('partidas');

    }
}
