<?php

use App\TipoPrestador;
use Illuminate\Database\Seeder;

class TipoPrestadorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomes = [
            'Medico',
            'Fisioterapeuta',
            'Professor',
            'Acupuntura',
        ];
        foreach($nomes as $nome){
            TipoPrestador::create(['nome' => $nome]);
        }
    }
}
