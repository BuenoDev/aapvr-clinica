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
            'visualizar-unidade',
            'editar-unidade',
            'visualizar-prestador',
            'editar-prestador',
            'editar-usuarios',
            'editar-permissoes',
            'visualizar-permissoes',
            'visualizar-agenda',
            'editar-agenda',
            'visualizar-prontuario',
        ];
        foreach ($permissions as $permission) Permission::create(['name' => $permission]);
    }
}
