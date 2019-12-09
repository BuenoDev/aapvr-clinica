<?php

use App\User;
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
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123123')
        ])->assignRole('admin');

        User::create([
            'name'     => 'Medico',
            'email'    => 'medico@gmail.com',
            'password' => Hash::make('123123')
        ])->assignRole('medico');

        User::create([
            'name'     => 'Recepcionista',
            'email'    => 'recepcionista@gmail.com',
            'password' => Hash::make('123123')
        ])->assignRole('recepcionista');

        $users = factory(App\User::class, 30)->create();
        foreach($users as $user) $user->assignRole('medico');
    }
}