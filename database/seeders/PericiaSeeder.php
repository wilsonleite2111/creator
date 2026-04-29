<?php

namespace Database\Seeders;

use App\Models\Pericia;
use Illuminate\Database\Seeder;

class PericiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pericias = [
            [
                'nome' => 'Abrir Fechaduras',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Permite abrir fechaduras e dispositivos de tranca.',
            ],
            [
                'nome' => 'Acrobacia',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Permite realizar proezas acrobáticas, como rolar para evitar ataques de oportunidade.',
            ],
            [
                'nome' => 'Adestrar Animais',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Permite treinar, acalmar ou comandar animais domésticos e selvagens.',
            ],
            [
                'nome' => 'Arte da Fuga',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Permite escapar de amarras, algemas ou manobras de agarrar.',
            ],
            [
                'nome' => 'Atuação',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Capacidade de entreter um público com música, dança, canto ou teatro.',
            ],
            [
                'nome' => 'Cavalgar',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Habilidade de montar e controlar animais de carga ou montaria em combate.',
            ],
            [
                'nome' => 'Concentração',
                'versao' => '3.5',
                'habilidade_chave' => 'CON',
                'descricao' => 'Capacidade de manter o foco em tarefas (como lançar magias) sob pressão ou dano.',
            ],
            [
                'nome' => 'Conhecimento (Arcano)',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Estudo sobre mistérios, tradições mágicas e criaturas arcanas.',
            ],
            [
                'nome' => 'Cura',
                'versao' => '3.5',
                'habilidade_chave' => 'SAB',
                'descricao' => 'Permite estabilizar aliados moribundos e tratar ferimentos ou doenças.',
            ],
            [
                'nome' => 'Decifrar Escrita',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Capacidade de entender textos em línguas desconhecidas ou códigos.',
            ],
            [
                'nome' => 'Diplomacia',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Habilidade de persuadir outros, mediar conflitos e melhorar a atitude de NPCs.',
            ],
            [
                'nome' => 'Disfarces',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Capacidade de mudar a aparência para se passar por outra pessoa.',
            ],
            [
                'nome' => 'Escalar',
                'versao' => '3.5',
                'habilidade_chave' => 'FOR',
                'descricao' => 'Permite subir paredes, penhascos e outras superfícies verticais.',
            ],
            [
                'nome' => 'Esconder-se',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Permite ocultar-se da vista de outros utilizando cobertura ou sombras.',
            ],
            [
                'nome' => 'Falsificação',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Habilidade de criar documentos falsos ou detectar falsificações.',
            ],
            [
                'nome' => 'Furtividade',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Habilidade de se mover silenciosamente sem ser detectado.',
            ],
            [
                'nome' => 'Identificar Magia',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Permite identificar magias sendo lançadas ou efeitos mágicos ativos.',
            ],
            [
                'nome' => 'Intimidação',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Capacidade de forçar outros a agir através de medo ou ameaças.',
            ],
            [
                'nome' => 'Natação',
                'versao' => '3.5',
                'habilidade_chave' => 'FOR',
                'descricao' => 'Habilidade de se deslocar através da água sem afundar.',
            ],
            [
                'nome' => 'Observar',
                'versao' => '3.5',
                'habilidade_chave' => 'SAB',
                'descricao' => 'Habilidade de notar detalhes visuais e detectar criaturas escondidas.',
            ],
            [
                'nome' => 'Obter Informação',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Capacidade de conseguir boatos e notícias conversando com pessoas em tavernas ou cidades.',
            ],
            [
                'nome' => 'Operar Mecanismo',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Permite desarmar armadilhas e sabotar dispositivos mecânicos.',
            ],
            [
                'nome' => 'Ouvir',
                'versao' => '3.5',
                'habilidade_chave' => 'SAB',
                'descricao' => 'Habilidade de escutar sons baixos ou detectar movimentos ocultos pelo som.',
            ],
            [
                'nome' => 'Prestidigitação',
                'versao' => '3.5',
                'habilidade_chave' => 'DES',
                'descricao' => 'Truques de mãos, bater carteiras e ocultar objetos pequenos no corpo.',
            ],
            [
                'nome' => 'Procurar',
                'versao' => '3.5',
                'habilidade_chave' => 'INT',
                'descricao' => 'Capacidade de encontrar objetos ocultos, portas secretas ou pistas através de exame detalhado.',
            ],
            [
                'nome' => 'Saltar',
                'versao' => '3.5',
                'habilidade_chave' => 'FOR',
                'descricao' => 'Permite pular distâncias horizontais ou alturas verticais.',
            ],
            [
                'nome' => 'Sentir Motivação',
                'versao' => '3.5',
                'habilidade_chave' => 'SAB',
                'descricao' => 'Permite perceber se alguém está mentindo ou agindo de forma estranha.',
            ],
            [
                'nome' => 'Sobrevivência',
                'versao' => '3.5',
                'habilidade_chave' => 'SAB',
                'descricao' => 'Capacidade de caçar, encontrar água, rastrear e sobreviver em ambientes selvagens.',
            ],
            [
                'nome' => 'Usar Instrumento Mágico',
                'versao' => '3.5',
                'habilidade_chave' => 'CAR',
                'descricao' => 'Permite ativar itens mágicos (varinhas, pergaminhos) que normalmente você não conseguiria usar.',
            ],
        ];

        foreach ($pericias as $pericia) {
            Pericia::updateOrCreate(
                ['nome' => $pericia['nome'], 'versao' => '3.5'],
                $pericia
            );
        }
    }
}
