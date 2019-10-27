<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Registre aqui todas as Permissões do sistema
         *
         *
         */
        $permissions = [
            'editar-permissoes',
            'visualizar-permissoes',
            'visualizar-agenda',
            'editar-agenda',
            'visualizar-prontuario',
        ];
        foreach ($permissions as $permission) Permission::create(['name' => $permission]);
    }
}
