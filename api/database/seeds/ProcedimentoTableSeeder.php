<?php
use App\Procedimento;
use Illuminate\Database\Seeder;

class ProcedimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Procedimento::class, 25)->create();
    }
}
