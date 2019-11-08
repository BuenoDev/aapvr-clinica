<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Prestador;
use Faker\Generator as Faker;

$factory->define(Prestador::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'nrConselho' => $faker->number,
        'cpf' => $faker->number,
        'rg' => $faker->number,
    ];
});
