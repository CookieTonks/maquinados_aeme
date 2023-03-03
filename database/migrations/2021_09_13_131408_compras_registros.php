<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ComprasRegistros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('compras_registros', function (Blueprint $table) {
         $table->id();
         $table->string('ot')->nullable();
         $table->string('area')->nullable();
         $table->string('personal')->nullable();
         $table->string('hora')->nullable();
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
      Schema::dropIfExists('compras_registros');
    }
}
