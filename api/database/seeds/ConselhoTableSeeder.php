<?php
use App\Conselho;
use Illuminate\Database\Seeder;

class ConselhoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Adicionando Grupos de procedimentos padrão
         Conselho::create([
            'id' => '1',
            'numero' => '1',
            'sigla' => 'CRAS',
            'nome' => 'Conselho Regional de Assistência Social',
        ]);
        Conselho::create([
            'id' => '2',
            'numero' => '2',
            'sigla' => 'COREN',
            'nome' => 'Conselho Regional de Enfermagem',
        ]);
        Conselho::create([
            'id' => '3',
            'numero' => '3',
            'sigla' => 'CRF',
            'nome' => 'Conselho Regional de Farmácia',
        ]);
        Conselho::create([
            'id' => '4',
            'numero' => '4',
            'sigla' => 'CRFA',
            'nome' => 'Conselho Regional de Fonoaudiologia',
        ]);
        Conselho::create([
            'id' => '5',
            'numero' => '5',
            'sigla' => 'CREFITO',
            'nome' => 'Conselho Regional de Fisioterapia e Terapia',
        ]);
        Conselho::create([
            'id' => '6',
            'numero' => '6',
            'sigla' => 'CRM',
            'nome' => 'Conselho Regional de Medicina',
        ]);
        Conselho::create([
            'id' => '7',
            'numero' => '7',
            'sigla' => 'CRN',
            'nome' => 'Conselho Regional de Nutrição',
        ]);
        Conselho::create([
            'id' => '8',
            'numero' => '8',
            'sigla' => 'CRO',
            'nome' => 'Conselho Regional de Odontologia',
        ]);
        Conselho::create([
            'id' => '9',
            'numero' => '9',
            'sigla' => 'CRP',
            'nome' => 'Conselho Regional de Psicologia',
        ]);
        Conselho::create([
            'id' => '10',
            'numero' => '10',
            'sigla' => 'OUT',
            'nome' => 'Outros Conselhos',
        ]);
    }
}
