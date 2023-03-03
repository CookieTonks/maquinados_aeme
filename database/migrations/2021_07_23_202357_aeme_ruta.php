<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AemeRuta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('aeme_rutas', function (Blueprint $table) {
         $table->id();
         $table->string('ot')->nullable();
         $table->string('sistema_ot')->nullable();
         $table->string('sistema_compras')->nullable();
         $table->string('sistema_ingenieria')->nullable();
         $table->String('sistema_produccion')->nullable();
         $table->string('sistema_calidad')->nullable();
         $table->String('sistema_embarques')->nullable();
         $table->String('sistema_facturacion')->nullable();
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
      Schema::dropIfExists('aeme_rutas');
    }
}
