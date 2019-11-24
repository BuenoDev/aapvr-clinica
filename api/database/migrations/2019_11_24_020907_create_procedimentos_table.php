<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 11);
            $table->string('procedimento', 100);
            $table->string('status', 1);
            $table->unsignedBigInteger('grupo_procedimento_id');
            $table->foreign('grupo_procedimento_id')->references('id')->on('grupo_procedimentos');
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
        Schema::dropIfExists('procedimentos');
    }
}
