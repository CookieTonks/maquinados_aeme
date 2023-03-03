<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class facturaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('facturaciones', function (Blueprint $table) {
          $table->id();
          $table->string('cliente')->nullable();
          $table->string('folio')->nullable();
          $table->string('oc')->nullable();
          $table->String('descripcion')->nullable();
          $table->string('subtotal')->nullable();
          $table->String('iva')->nullable();
          $table->String('total')->nullable();
          $table->String('moneda')->nullable();
          $table->string('fecha_registro')->nullable();
          $table->String('fecha_entrada')->nullable();
          $table->String('fecha_vencimiento')->nullable();
          $table->String('fecha_pago')->nullable();
          $table->String('fecha_mes')->nullable();
          $table->String('fecha_year')->nullable();
          $table->String('estatus')->nullable();
          $table->String('usuario')->nullable();
          $table->String('vendedor')->nullable();
          $table->String('observaciones')->nullable();
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
      Schema::dropIfExists('facturaciones');
    }
}
