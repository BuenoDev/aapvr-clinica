<?php

use App\Especialidade;
use App\User;
use App\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Dev only
         */
        App\Perfil::create([
            'nome'     => 'Admin',
            'cpf' => '123123123',
            'rg' => '123123123'
        ])->user()->create([
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123123')
        ])->assignRole('admin');


        App\Perfil::create([
            'nome'     => 'Recepcionista',
            'cpf' => '123123123',
            'rg' => '123123123'
        ])->user()->create([
            'email'    => 'recepcionista@gmail.com',
            'password' => Hash::make('123123')
        ])->assignRole('recepcionista');

        $medico = App\Perfil::create([
            'nome' => 'Medico',
            'cpf' => '123123123',
            'rg' => '123123123'
        ])->user()->create([
            'email'    => 'medico@gmail.com',
            'password' => Hash::make('123123')
        ]);

        $medico->assignRole('prestador');
        $medico->perfil->prestador()->create([
            'nrConselho' => '123',
        ])->especialidades()->sync(Especialidade::find(10));

        // $users = factory(App\User::class, 30)->create();
        // foreach($users as $user) $user->assignRole('medico');
    }
}
