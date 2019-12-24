<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Unidade;
use Faker\Generator as Faker;

$factory->define(Unidade::class, function (Faker $faker) {
    return [
        'nome' => $faker->randomElement(['SCBM','SCVR','UNIMEDBM','UNIMED','CLINICA SOL']),
        'regans' => $faker->randomElement(['regans 1','regans 2','regans 3','regans 4']),
    ];
});
