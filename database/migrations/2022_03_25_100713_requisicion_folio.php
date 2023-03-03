<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequisicionFolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisicion_folios', function (Blueprint $table) {
            $table->id();
            $table->string('requisicion')->nullable();
            $table->string('estatus')->nullable();
            $table->string('usuario')->nullable();
            $table->string('tipo_requisicion')->nullable();
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
        Schema::dropIfExists('requisicion_folios');
    }
}
