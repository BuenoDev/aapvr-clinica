<?php

use App\Especialidade;
use Illuminate\Database\Seeder;

class EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /**
         * Array contendo todas as especialidades
         * importadas
         */
        $especialidades = [
            [
                'codigo' => '201115',
                'nome' => 'Geneticista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '203015',
                'nome' => 'Pesquisador em biologia de microorganismos e parasitas',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '213150',
                'nome' => 'Físico médico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '221105',
                'nome' => 'Biólogo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223505',
                'nome' => 'Enfermeiro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223605',
                'nome' => 'Fisioterapeuta geral',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223710',
                'nome' => 'Nutricionista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223810',
                'nome' => 'Fonoaudiólogo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223905',
                'nome' => 'Terapeuta ocupacional',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '223910',
                'nome' => 'Ortoptista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225103',
                'nome' => 'Médico infectologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225105',
                'nome' => 'Médico acupunturista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225106',
                'nome' => 'Médico legista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225109',
                'nome' => 'Médico Nefrologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225110',
                'nome' => 'Médico alergista e imunologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225112',
                'nome' => 'Médico neurologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225115',
                'nome' => 'Médico angiologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225118',
                'nome' => 'Médico nutrologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225120',
                'nome' => 'Médico cardiologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225121',
                'nome' => 'Médico oncologista clínico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225122',
                'nome' => 'Médico cancerologista pediátrico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225124',
                'nome' => 'Médico pediatra',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225125',
                'nome' => 'Médico clínico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225127',
                'nome' => 'Médico pneumologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225130',
                'nome' => 'Médico de família e comunidade',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225133',
                'nome' => 'Médico psiquiatra',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225135',
                'nome' => 'Médico dermatologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225136',
                'nome' => 'Médico reumatologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225139',
                'nome' => 'Médico sanitarista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225140',
                'nome' => 'Médico do trabalho',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225142',
                'nome' => 'Médico da estratégia de saúde da família',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225145',
                'nome' => 'Médico em medicina de tráfego',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225148',
                'nome' => 'Médico anatomopatologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225150',
                'nome' => 'Médico em medicina intensiva',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225151',
                'nome' => 'Médico anestesiologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225155',
                'nome' => 'Médico endocrinologista e metabologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225160',
                'nome' => 'Médico fisiatra',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225165',
                'nome' => 'Médico gastroenterologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225170',
                'nome' => 'Médico generalista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225175',
                'nome' => 'Médico geneticista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225180',
                'nome' => 'Médico geriatra',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225185',
                'nome' => 'Médico Hematologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225195',
                'nome' => 'Médico Homeopata',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225203',
                'nome' => 'Médico em cirurgia vascular',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225210',
                'nome' => 'Médico cirurgião cardiovascular',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225215',
                'nome' => 'Médico cirurgião de cabeça e pescoço',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225220',
                'nome' => 'Médico cirurgião do aparelho digestivo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225225',
                'nome' => 'Médico cirurgião geral',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225230',
                'nome' => 'Médico cirurgião pediátrico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225235',
                'nome' => 'Médico cirurgião plástico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225240',
                'nome' => 'Médico cirurgião torácico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225250',
                'nome' => 'Médico ginecologista e obstetra',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225255',
                'nome' => 'Médico Mastologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225260',
                'nome' => 'Médico neurocirurgião',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225265',
                'nome' => 'Médico oftalmologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225270',
                'nome' => 'Médico ortopedista e traumatologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225275',
                'nome' => 'Médico otorrinolaringologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225280',
                'nome' => 'Médico proctologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225285',
                'nome' => 'Médico urologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225290',
                'nome' => 'Médico cancerologista cirúrgico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225295',
                'nome' => 'Médico cirurgião da mão',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225305',
                'nome' => 'Médico citopatologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225310',
                'nome' => 'Médico em endoscopia',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225315',
                'nome' => 'Médico em medicina nuclear',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225320',
                'nome' => 'Médico em radiologia e diagnóstico por imagem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225325',
                'nome' => 'Médico patologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225330',
                'nome' => 'Médico radioterapeuta',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225335',
                'nome' => 'Médico patologista clínico / medicina laboratorial',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225340',
                'nome' => 'Médico hemoterapeuta',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225345',
                'nome' => 'Médico hiperbarista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '225350',
                'nome' => 'Médico neurofisiologista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '239425',
                'nome' => 'Psicopedagogo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '251510',
                'nome' => 'Psicólogo clínico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '251545',
                'nome' => 'Neuropsicólogo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '251550',
                'nome' => 'Psicanalista',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '251605',
                'nome' => 'Assistente social',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '322205',
                'nome' => 'Técnico de enfermagem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '322220',
                'nome' => 'Técnico de enfermagem psiquiátrica',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '322225',
                'nome' => 'Instrumentador cirúrgico',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '322230',
                'nome' => 'Auxiliar de enfermagem',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '516210',
                'nome' => 'Cuidador de idosos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo' => '999999',
                'nome' => 'CBO igodesconhecido ou não informado pelo solicitante',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        Especialidade::insert($especialidades);
    }
}