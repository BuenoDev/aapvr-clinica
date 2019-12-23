<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesForPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->dropColumn('nome');
            $table->dropColumn('rg');
            $table->dropColumn('cpf');
            $table->bigInteger('perfil_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestadores', function (Blueprint $table) {
            $table->string('nome');
            $table->string('rg');
            $table->string('cpf');
            $table->dropColumn('perfil_id');
        });

    }
}