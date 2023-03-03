<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calidadsalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('calidadsalidas', function (Blueprint $table)
       {
         $table->id();
         $table->string('folio')->nullable();
         $table->string('ot')->nullable();
         $table->string('tipo_salida')->nullable();
         $table->string('dureza')->nullable();
         $table->string('solicito')->nullable();
         $table->string('cant_pieza')->nullable();
         $table->string('proveedor')->nullable();
         $table->string('chofer')->nullable();
         $table->string('certificado')->nullable();
         $table->string('estatus')->nullable();
         $table->string('criterio')->nullable();
         $table->string('comentarios')->nullable();
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
      Schema::dropIfExists('calidadsalidas');

    }
}
