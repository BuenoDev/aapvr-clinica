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
         *      *Apenas exemplos:
         */
        $permissions = [
            [
                'name' => 'visualizar-agenda'
            ],
            [
                'name' => 'editar-agenda'
            ],
            [
                'name' => 'visualizar-prontuario'
            ],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }      
    }
}
