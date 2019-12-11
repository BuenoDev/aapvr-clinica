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

    }
}