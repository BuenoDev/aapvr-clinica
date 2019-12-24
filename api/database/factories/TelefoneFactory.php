<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Telefone;
use Faker\Generator as Faker;

$factory->define(Telefone::class, function (Faker $faker) {
    return [
        'numero' => $faker->e164PhoneNumber(),
        'tipo' => $faker->randomElement(['Residencial','Celular','Comercial']),
        'dono_type' => 'Dono Type FIELD',
        'dono_id' => '0',
    ];
});
