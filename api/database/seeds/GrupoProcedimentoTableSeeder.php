<?php

use Illuminate\Database\Seeder;
use App\GrupoProcedimento;

class GrupoProcedimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Adicionando Grupos de procedimentos padrão
        GrupoProcedimento::create([
            'id' => '18',
            'descricao' => 'Taxas hospitalares, diárias e gases medicinais',
        ]);

        GrupoProcedimento::create([
            'id' => '19',
            'descricao' => 'Materiais',
        ]);

        GrupoProcedimento::create([
            'id' => '20',
            'descricao' => 'Medicamentos',
        ]);

        GrupoProcedimento::create([
            'id' => '22',
            'descricao' => 'Procedimentos e eventos em saúde (medicina, odonto e demais áreas de saúde)',
        ]);

        GrupoProcedimento::create([
            'id' => '23',
            'descricao' => 'Tabela Própria das Operadoras',
        ]);

    }
}
