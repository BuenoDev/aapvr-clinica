<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Paciente;
use Faker\Generator as Faker;

$factory->define(Paciente::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstName(),
        'rg' => $faker->isbn10(),
        'cpf' => $faker->ean8(),
        'mae' => $faker->name($gender = 'female'),
        'dtnascimento' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'sexo' => $faker->randomElement(['M','F']), // M / F
        'estadoCivil' => $faker->randomElement(['Solteiro','Casado','Divorciado','Viuvo']), //'Solteiro', 'Casado', 'Divorciado', 'Viuvo'
        'observacao' => $faker->text($maxNbChars = 200),
    ];
});
