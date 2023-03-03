<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ComprasRutas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('compras_rutas', function (Blueprint $table) {
     $table->id();
     $table->string('ot')->nullable();
     $table->string('compras_ot')->nullable();
     $table->string('compras_requisicion')->nullable();
     $table->string('compras_oc')->nullable();
     $table->string('compras_entrada')->nullable();
     $table->string('compras_salida')->nullable();
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
      Schema::dropIfExists('compras_rutas');
    }
}
