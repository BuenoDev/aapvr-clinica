<?php

use Illuminate\Database\Seeder;
use App\Unidade;

class UnidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Unidade::class, 5)->create();
    }
}
