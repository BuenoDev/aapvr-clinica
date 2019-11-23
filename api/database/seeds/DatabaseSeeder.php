<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(AssignPermissionsSeeder::class);
        /**
         * Abaixo apenas seeds em modo de desenvolvimento
         */
        $this->call(UsersTableSeeder::class);
        $this->call(GrupoProcedimentoTableSeeder::class);
    }
}
