<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table)
      {
         $table->id();
         $table->string('codigo')->nullable();
         $table->string('Descripcion')->nullable();
         $table->string('Numero_de_parte')->nullable();
         $table->string('Cantidad_Actual')->nullable();
         $table->string('Min')->nullable();
         $table->string('Max')->nullable();
         $table->string('Unidad')->nullable();
         $table->string('Proveedor_cliente')->nullable();
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
        Schema::dropIfExists('productos');
    }
}
