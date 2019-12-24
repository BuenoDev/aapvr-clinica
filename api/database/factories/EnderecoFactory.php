
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Endereco;
use Faker\Generator as Faker;

$factory->define(Endereco::class, function (Faker $faker) {
    return [
        'bairro' => $faker->address(),
        'cep' => $faker->postcode(),
        'cidade' => $faker->city(),
        'complemento' => $faker->secondaryAddress(),
        'logradouro' => $faker->cityPrefix(),
        'tipo' => $faker->randomElement(['Tipo A','Tipo B','Tipo C','Tipo D','Tipo E']),
        'uf' => $faker->stateAbbr(),
        'dono_type' => 'Dono Type FIELD',
        'dono_id' => '0',
    ];
});
