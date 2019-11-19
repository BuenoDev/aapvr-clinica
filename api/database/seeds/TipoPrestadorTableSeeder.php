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
        TipoPrestador::create([
            'nome' => 'Medico'
        ]);
    }
}