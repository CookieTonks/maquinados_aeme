<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productions', function (Blueprint $table)
      {
         $table->id();
         $table->string('estatus')->nullable();
         $table->string('proceso')->nullable();
         $table->string('ot')->nullable();
         $table->string('area')->nullable();
         $table->string('comentario')->nullable();
         $table->string('cliente')->nullable();
         $table->string('fecha_entrega')->nullable();
         $table->string('maquina')->nullable();
         $table->string('disponibilidad')->nullable();
         $table->string('tt')->nullable();
         $table->string('material')->nullable();
         $table->string('fecha_oc')->nullable();
         $table->string('dias')->nullable();
         $table->string('entrada_material')->nullable();
         $table->string('vendedor')->nullable();
         $table->string('user_liberacion')->nullable();
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
        Schema::dropIfExists('productions');
    }
}
