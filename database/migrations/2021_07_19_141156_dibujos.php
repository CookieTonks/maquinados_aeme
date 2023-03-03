<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class dibujos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('dibujos', function (Blueprint $table) {
          $table->id();
          $table->string('ot')->nullable();
          $table->string('numero_parte')->nullable();
          $table->string('descripcion')->nullable();
          $table->string('cliente')->nullable();
          $table->string('vendedor')->nullable();
          $table->string('material')->nullable();
          $table->string('cantidad')->nullable();
          $table->string('fecha_entrega')->nullable();
          $table->string('estatus')->nullable();
          $table->string('comentario')->nullable();
          $table->string('responsable')->nullable();
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
      Schema::dropIfExists('dibujos');
    }
}
