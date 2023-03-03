<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ocompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('ocompras', function (Blueprint $table)
       {
          $table->id();
          $table->string('Codigo')->nullable();
          $table->string('Entrega')->nullable();
          $table->string('Condiciones_de_pago')->nullable();
          $table->string('Cliente')->nullable();
          $table->string('Moneda')->nullable();
          $table->string('OC_cliente')->nullable();
          $table->string('Observaciones')->nullable();
          $table->string('Tipo')->nullable();
          $table->string('alta_almacen')->default('PENDIENTE');
          $table->date('fecha_almacen')->nullable();
          $table->string('alta_pago')->default('PENDIENTE');
          $table->string('dias')->nullable();
          $table->string('Disponibilidad')->default('ACTIVO');
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
      Schema::dropIfExists('ocompras');
    }
}
