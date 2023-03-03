<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequisicionPartida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicion_partidas', function (Blueprint $table) {
            $table->id();
            $table->string('requisicion')->nullable();
            $table->string('usuario')->nullable();
            $table->string('cantidad')->nullable();
            $table->string('unidad')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->string('ot')->nullable();
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
        Schema::dropIfExists('requisicion_partidas');
    }
}
