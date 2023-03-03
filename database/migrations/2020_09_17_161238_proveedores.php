<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class proveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('proveedores', function (Blueprint $table) {
          $table->id();
          $table->string('Numero_proveedor')->nullable();
          $table->string('RFC')->nullable();
          $table->string('Direccion')->nullable();
          $table->String('Telefono')->nullable();
          $table->string('Correo')->nullable();
          $table->String('Rsocial')->nullable();
          $table->String('Vendedor')->nullable();
          $table->String('tipo_proveedor')->nullable();
          $table->String('nacional_internacional')->nullable();
          $table->String('familia')->nullable();
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
      Schema::dropIfExists('proveedores');
    }
}
