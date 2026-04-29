<?php

namespace Database\Seeders;

use App\Models\Tendencia;
use Illuminate\Database\Seeder;

class TendenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tendencias = [
            [
                'nome' => 'Leal e Bom',
                'apelido' => 'O Cruzado',
                'iniciais' => 'LB',
                'descricao' => 'Personagens leais e bons acreditam que uma sociedade bem organizada e o cumprimento das leis são as melhores formas de promover o bem e a justiça.',
            ],
            [
                'nome' => 'Neutro e Bom',
                'apelido' => 'O Benfeitor',
                'iniciais' => 'NB',
                'descricao' => 'Personagens neutros e bons são guiados por sua consciência. Eles fazem o que é certo sem se preocupar tanto com leis ou ordem.',
            ],
            [
                'nome' => 'Caótico e Bom',
                'apelido' => 'O Rebelde',
                'iniciais' => 'CB',
                'descricao' => 'Personagens caóticos e bons agem conforme sua própria bússola moral, valorizando a liberdade individual acima de governos ou leis sociais.',
            ],
            [
                'nome' => 'Leal e Neutro',
                'apelido' => 'O Juiz',
                'iniciais' => 'LN',
                'descricao' => 'Personagens leais e neutros seguem um código de conduta, lei ou tradição de forma rígida, sem considerar o bem ou o mal nas suas decisões.',
            ],
            [
                'nome' => 'Neutro',
                'apelido' => 'O Indeciso',
                'iniciais' => 'N',
                'descricao' => 'Personagens neutros (verdadeiramente neutros) preferem o equilíbrio. Eles podem não ter uma inclinação forte para a ordem, o caos, o bem ou o mal.',
            ],
            [
                'nome' => 'Caótico e Neutro',
                'apelido' => 'O Espírito Livre',
                'iniciais' => 'CN',
                'descricao' => 'Personagens caóticos e neutros seguem seus impulsos e valorizam sua liberdade acima de tudo. Eles são imprevisíveis mas raramente maldosos.',
            ],
            [
                'nome' => 'Leal e Mau',
                'apelido' => 'O Tirano',
                'iniciais' => 'LM',
                'descricao' => 'Personagens leais e maus utilizam sistemas, leis e hierarquias para obter o que desejam, sem remorso pelos que sofrem no processo.',
            ],
            [
                'nome' => 'Neutro e Mau',
                'apelido' => 'O Malfeitor',
                'iniciais' => 'NM',
                'descricao' => 'Personagens neutros e maus fazem qualquer coisa para se beneficiar, sem qualquer consideração por leis ou outras pessoas.',
            ],
            [
                'nome' => 'Caótico e Mau',
                'apelido' => 'O Destruidor',
                'iniciais' => 'CM',
                'descricao' => 'Personagens caóticos e maus são motivados pela ganância, ódio ou luxúria pela destruição. Eles não têm respeito pela vida ou pela ordem.',
            ],
        ];

        foreach ($tendencias as $tendencia) {
            Tendencia::updateOrCreate(
                ['iniciais' => $tendencia['iniciais']],
                $tendencia
            );
        }
    }
}
