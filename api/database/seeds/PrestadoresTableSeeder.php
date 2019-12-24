<?php

use Illuminate\Database\Seeder;
use App\Prestador;

class PrestadoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Prestador::class, 10)->create();
    }
}
