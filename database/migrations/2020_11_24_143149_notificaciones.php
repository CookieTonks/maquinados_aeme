<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class notificaciones extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('notificaciones', function (Blueprint $table) {
      $table->id();
      $table->string('tipo')->nullable();
      $table->string('asunto')->nullable();
      $table->string('cuerpo')->nullable();
      $table->string('usuario')->nullable();
      $table->string('seen')->nullable();
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
    Schema::dropIfExists('notificaciones');
  }
}
