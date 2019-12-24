<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Procedimento;
use Faker\Generator as Faker;

$factory->define(Procedimento::class, function (Faker $faker) {
    return [
        'codigo' => $faker->ean8(),
        'procedimento' => $faker->randomElement([
            'CONSULTA EM CONSULTÓRIO',
            'CONSULTA 70',
            'VISITA HOSPITALAR (PACIENTE INTERNADO)',
            'ATENDIMENTO AO RECÉM-NASCIDO EM BERÇÁRIO',
            'ATENDIMENTO AO RECÉM-NASCIDO EM SALA DE PARTO (PARTO NORMAL OU OPERATÓRIO DE BAIXO RISCO)',
            'ATENDIMENTO AO RECEM NASCIDO EM SALA DE PARTO - PARTO COM RISCO',
            'ATENDIMENTO DO INTENSIVISTA DIARISTA (POR DIA E POR PACIENTE)',
            'ATENDIMENTO MÉDICO DO INTENSIVISTA EM UTI GERAL OU PEDIÁTRICA (PLANTÃO DE 12 HORAS - POR PACIENTE)',
            'ACONSELHAMENTO GENÉTICO',
            'ACOMPANHAMENTO CLÍNICO AMBULATORIAL PÓS-TRANSPLANTE RENAL - POR AVALIAÇÃO' 
            ]),
        'status' => $faker->boolean(),
        'grupo_procedimento_id' => '23',
    ];
});
