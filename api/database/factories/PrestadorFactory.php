<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Prestador;
use Faker\Generator as Faker;

$factory->define(Prestador::class, function (Faker $faker) {
    return [
        // 'nome' => $faker->firstName(),
        'nrConselho' => $faker->ean8(),
        // 'cpf' => $faker->ean8(),
        // 'rg' => $faker->ean8(),
    ];
});
