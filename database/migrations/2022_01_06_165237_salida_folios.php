<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SalidaFolios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_folios', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->nullable();
            $table->string('solicita')->nullable();
            $table->string('entrega')->nullable();
            $table->string('area')->nullable();
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
        Schema::dropIfExists('salida_folios');

    }
}
