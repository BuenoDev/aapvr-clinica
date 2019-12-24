<?php

use Illuminate\Database\Seeder;
use App\Medico;

class MedicoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Medico::class, 10)->create();
    }
}
