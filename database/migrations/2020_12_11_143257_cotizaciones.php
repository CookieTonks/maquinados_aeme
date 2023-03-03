<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cotizaciones', function (Blueprint $table) {
         $table->id()->start_from(0);
         $table->string('empresa')->nullable();
         $table->string('numero_cotizacion')->nullable();
         $table->string('cliente')->nullable();
         $table->string('usuario')->nullable();
         $table->string('vigencia')->nullable();
         $table->string('condiciones')->nullable();
         $table->string('entrega')->nullable();
         $table->string('moneda')->nullable();
         $table->string('importe')->nullable();
         $table->string('iva')->nullable();
         $table->string('total')->nullable();
         $table->string('usuario_alta')->nullable();
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
        Schema::dropIfExists('cotizaciones');
    }
}
