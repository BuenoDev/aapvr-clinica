<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nome');
            $table->string('rg');
            $table->string('cpf');
            $table->string('mae');
            $table->date('dtnascimento');
            $table->enum('sexo',['M','F']);
            $table->enum('estadoCivil',[
                'Solteiro', 'Casado', 'Divorciado', 'Viuvo'
            ]);
            $table->text('observacao')->nullable();
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
        Schema::dropIfExists('pacientes');
    }
}