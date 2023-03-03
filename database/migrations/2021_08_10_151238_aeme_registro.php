<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AemeRegistro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('aeme_registros', function (Blueprint $table) {
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
      Schema::dropIfExists('aeme_registros');
    }
}
