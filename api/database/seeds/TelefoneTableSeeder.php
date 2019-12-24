<?php

use Illuminate\Database\Seeder;
use App\Telefone;

class TelefoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Telefone::class, 25)->create();
    }
}
