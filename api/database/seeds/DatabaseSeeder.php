<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(AssignPermissionsSeeder::class);
        $this->call(EspecialidadeSeeder::class);
        /**
         * Abaixo apenas seeds em modo de desenvolvimento
         */
        $this->call(UsersTableSeeder::class);
        $this->call(GrupoProcedimentoTableSeeder::class);
        $this->call(TipoPrestadorTableSeeder::class);

        $this->call(ConselhoTableSeeder::class);
        $this->call(ConvenioTableSeeder::class);
        $this->call(PrestadoresTableSeeder::class);
        $this->call(EnderecoTableSeeder::class);
        // $this->call(MedicoTableSeeder::class);
        $this->call(PacienteTableSeeder::class);
        $this->call(TelefoneTableSeeder::class);
        $this->call(ProcedimentoTableSeeder::class);
        $this->call(UnidadeTableSeeder::class);
        

        
    }
}
