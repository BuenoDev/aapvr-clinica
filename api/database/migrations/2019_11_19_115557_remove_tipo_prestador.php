<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTipoPrestador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipo_prestador', function (Blueprint $table) {
            Schema::dropIfExists('tipo_prestador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipo_prestador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->timestamps();
        });
    }
}