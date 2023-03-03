<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Charts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('charts', function (Blueprint $table) {
         $table->id();
         $table->string('inicio')->default('10');
         $table->string('C_TOR')->default('0');
         $table->string('C_END')->default('0');
         $table->string('C_INS')->default('0');
         $table->string('C_HERR')->default('0');
         $table->string('C_CONS')->default('0');
         $table->string('C_LIM')->default('0');
         $table->string('C_SEG')->default('0');
         $table->string('C_FACTURA')->default('0');
         $table->string('C_COTIZACION')->default('0');
         $table->string('fecha_oc')->default('0');
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
      Schema::dropIfExists('charts');

    }
}
