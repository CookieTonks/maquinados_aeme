<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Requisiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('requisiciones', function (Blueprint $table) {
         $table->id();
         $table->string('requisicion')->nullable();
         $table->string('orden_compra')->nullable();
         $table->string('proveedor')->nullable();
         $table->date('fecha_pedido')->nullable();
         $table->string('solicito')->nullable();
         $table->string('autorizo')->nullable();
         $table->string('familia')->nullable();
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
        Schema::dropIfExists('requisiciones');
    }
}
