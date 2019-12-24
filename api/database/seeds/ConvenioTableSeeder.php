<?php

use Illuminate\Database\Seeder;
use App\Convenio;

class ConvenioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Adicionando Grupos de procedimentos padrão
        Convenio::create([
            'id' => '1',
            'nome' => 'Particular',
            'regans' => 'regansPart',
            'tipo' => '0',
        ]);
        //
        Convenio::create([
            'id' => '2',
            'nome' => 'SUS',
            'regans' => 'regansSUS',
            'tipo' => '1',
        ]);

         //
         Convenio::create([
            'id' => '3',
            'nome' => 'SCBM',
            'regans' => 'regansSCBM',
            'tipo' => '0',
        ]);
    }
}
