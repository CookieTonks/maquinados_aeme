<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Datamains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('Datamains', function (Blueprint $table) {
          $table->id();
          $table->string('orden_trabajo')->nullable();
          $table->string('cliente')->nullable();
          $table->string('fecha_inicio')->nullable();
          $table->string('fecha_entrega')->nullable();
          $table->string('fecha_entrega_real')->nullable();
          $table->string('factura_remision')->nullable();
          $table->string('cant_pieza')->nullable();
          $table->string('orden_compra')->nullable();
          $table->string('descripcion')->nullable();
          $table->string('fuente')->nullable();
          $table->string('dibujo')->nullable();
          $table->string('codigo_pieza')->nullable();
          $table->string('usuario')->nullable();
          $table->string('tipo_material')->nullable();
          $table->string('tt')->nullable();
          $table->string('proceso')->nullable();
          $table->string('estatus')->nullable();
          $table->string('disponibilidad')->nullable();
          $table->string('material')->nullable();
          $table->string('supervisor')->nullable();
          $table->string('fecha_diseno')->nullable();
          $table->string('comentario_diseno')->nullable();
          $table->string('salida_diseno')->nullable();
          $table->string('user')->nullable();
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
      Schema::dropIfExists('Datamains');

    }
}
