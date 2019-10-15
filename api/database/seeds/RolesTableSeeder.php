<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Registre aqui todas as roles/grupos do sistema
         */
        $roles = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'medico'
            ],
            [
                'name' => 'recepcionista'
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }        
    }
}
