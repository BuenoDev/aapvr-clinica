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
        $this->call(ConselhoTableSeeder::class);
        /**
         * Abaixo apenas seeds em modo de desenvolvimento
         */
        $this->call(UsersTableSeeder::class);
        $this->call(TipoPrestadorTableSeeder::class);

        $this->call(ConvenioTableSeeder::class);
        $this->call(PrestadoresTableSeeder::class);
        /**
         * Endereço e telefone seeder não precisam ser chamados de forma automatica,
         * considerando que esses registros pertencem as entidades Prestaodor, Unidade e Paciente
         * devendo ser ligadas as mesmas
         */
        $this->call(UnidadeTableSeeder::class);
        $this->call(TelefoneTableSeeder::class);
        $this->call(PacienteTableSeeder::class);
        $this->call(EnderecoTableSeeder::class);
        /**
         * o mesmo vale para as tabelas abaixo, onde o grupo necessita
         * ter 1 ou mais procedimentos
         */
        $this->call(GrupoProcedimentoTableSeeder::class);
        $this->call(ProcedimentoTableSeeder::class);
    }
}