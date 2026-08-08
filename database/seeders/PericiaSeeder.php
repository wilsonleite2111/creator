<?php

namespace Database\Seeders;

use App\Models\Pericia;
use Illuminate\Database\Seeder;

class PericiaSeeder extends Seeder
{
    public function run(): void
    {
        $pericias = [
            ['nome' => 'Abrir Fechaduras',                    'habilidade_chave' => 'DES', 'descricao' => 'Abre fechaduras mecânicas e dispositivos de tranca usando ferramentas de ladrão. Requer treinamento.'],
            ['nome' => 'Acrobacia',                           'habilidade_chave' => 'DES', 'descricao' => 'Permite rolar, girar e realizar manobras acrobáticas para evitar ataques de oportunidade.'],
            ['nome' => 'Adestrar Animais',                    'habilidade_chave' => 'CAR', 'descricao' => 'Treina animais para executar truques e comandos, acalma ou maneja feras selvagens. Requer treinamento.'],
            ['nome' => 'Arte da Fuga',                        'habilidade_chave' => 'DES', 'descricao' => 'Escapa de agarramentos, amarras, algemas e outros confinamentos físicos. Requer treinamento.'],
            ['nome' => 'Atuação',                             'habilidade_chave' => 'CAR', 'descricao' => 'Entretém plateias com música, dança, canto, teatro ou oratória. Base das habilidades de bardo.'],
            ['nome' => 'Avaliação',                           'habilidade_chave' => 'INT', 'descricao' => 'Determina o valor de mercado de itens, gemas, obras de arte e equipamentos.'],
            ['nome' => 'Blefar',                              'habilidade_chave' => 'CAR', 'descricao' => 'Convence outros de algo falso através de mentiras, enganos ou atuação. Opõe-se a Sentir Motivação.'],
            ['nome' => 'Cavalgar',                            'habilidade_chave' => 'DES', 'descricao' => 'Monta e controla cavalos e outras montarias em terrenos difíceis e situações de combate.'],
            ['nome' => 'Concentração',                        'habilidade_chave' => 'CON', 'descricao' => 'Mantém o foco ao lançar magias enquanto sofre dano, é empurrado ou perturbado.'],
            ['nome' => 'Conhecimento (Arcano)',                'habilidade_chave' => 'INT', 'descricao' => 'Estudo de tradições mágicas, magias arcanas, criaturas mágicas e símbolos. Requer treinamento.'],
            ['nome' => 'Conhecimento (Arquitetura e Engenharia)', 'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de construções, estruturas, pontes, castelos e engenharia civil. Requer treinamento.'],
            ['nome' => 'Conhecimento (Dungeon)',               'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de masmorras, construções subterrâneas, armadilhas comuns e ecologia de monstros. Requer treinamento.'],
            ['nome' => 'Conhecimento (Geografia)',             'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de terras, regiões, climas, topografia e culturas do mundo. Requer treinamento.'],
            ['nome' => 'Conhecimento (História)',              'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de guerras, lendas, eventos históricos, civilizações e figuras do passado. Requer treinamento.'],
            ['nome' => 'Conhecimento (Local)',                 'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento sobre uma região ou cidade específica, seus habitantes, leis e costumes. Requer treinamento.'],
            ['nome' => 'Conhecimento (Natureza)',              'habilidade_chave' => 'INT', 'descricao' => 'Estudo de animais, plantas, terrenos, clima e ciclos naturais. Requer treinamento.'],
            ['nome' => 'Conhecimento (Nobreza e Realeza)',     'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de linhagens nobres, brasões, heráldica, protocolos e famílias reais. Requer treinamento.'],
            ['nome' => 'Conhecimento (Os Planos)',             'habilidade_chave' => 'INT', 'descricao' => 'Conhecimento de planos de existência, criaturas planares e cosmologia. Requer treinamento.'],
            ['nome' => 'Conhecimento (Religião)',              'habilidade_chave' => 'INT', 'descricao' => 'Estudo de deuses, rituais, dogmas, criaturas sagradas e mortos-vivos. Requer treinamento.'],
            ['nome' => 'Cura',                                'habilidade_chave' => 'SAB', 'descricao' => 'Estabiliza moribundos, trata doenças, envenamentos e ferimentos com curativos e primeiros socorros.'],
            ['nome' => 'Decifrar Escrita',                    'habilidade_chave' => 'INT', 'descricao' => 'Interpreta textos em línguas desconhecidas, mapas antigos, pergaminhos mágicos e códigos cifrados. Requer treinamento.'],
            ['nome' => 'Diplomacia',                          'habilidade_chave' => 'CAR', 'descricao' => 'Melhora a atitude de NPCs, medeia conflitos, negocia acordos e convence grupos por meios pacíficos.'],
            ['nome' => 'Disfarce',                            'habilidade_chave' => 'CAR', 'descricao' => 'Altera a aparência para se passar por outra pessoa, mudando voz, roupas e postura.'],
            ['nome' => 'Equilíbrio',                          'habilidade_chave' => 'DES', 'descricao' => 'Mantém o equilíbrio em superfícies instáveis, escorregadias ou estreitas sem cair.'],
            ['nome' => 'Escalar',                             'habilidade_chave' => 'FOR', 'descricao' => 'Sobe paredes, penhascos, árvores e outras superfícies verticais ou muito inclinadas.'],
            ['nome' => 'Esconder-se',                         'habilidade_chave' => 'DES', 'descricao' => 'Permanece fora de vista usando cobertura, sombras e camuflagem para evitar ser detectado.'],
            ['nome' => 'Falsificação',                        'habilidade_chave' => 'INT', 'descricao' => 'Cria documentos falsos convincentes e detecta falsificações em papéis, assinaturas e selos.'],
            ['nome' => 'Furtividade',                         'habilidade_chave' => 'DES', 'descricao' => 'Move-se em silêncio sem ser detectado pelo som, minimizando ruídos de passos e equipamentos.'],
            ['nome' => 'Identificar Magia',                   'habilidade_chave' => 'INT', 'descricao' => 'Reconhece magias sendo lançadas e identifica efeitos mágicos ativos. Requer treinamento.'],
            ['nome' => 'Intimidar',                           'habilidade_chave' => 'CAR', 'descricao' => 'Força outros a cooperar através de ameaças, demonstrações de poder ou intimidação física.'],
            ['nome' => 'Natação',                             'habilidade_chave' => 'FOR', 'descricao' => 'Nada, mergulha e se movimenta em água corrente ou parada sem se afogar.'],
            ['nome' => 'Observar',                            'habilidade_chave' => 'SAB', 'descricao' => 'Detecta criaturas furtivas, nota detalhes do ambiente e percebe coisas fora do comum visualmente.'],
            ['nome' => 'Obter Informação',                    'habilidade_chave' => 'CAR', 'descricao' => 'Coleta boatos, notícias e informações locais conversando em tavernas, mercados e locais públicos.'],
            ['nome' => 'Ofícios',                             'habilidade_chave' => 'INT', 'descricao' => 'Pratica e demonstra proficiência em uma profissão artesanal como ferraria, carpintaria ou tecelagem.'],
            ['nome' => 'Operar Mecanismo',                    'habilidade_chave' => 'INT', 'descricao' => 'Desarma armadilhas mecânicas, abre cofres e sabota dispositivos complexos. Requer treinamento.'],
            ['nome' => 'Ouvir',                               'habilidade_chave' => 'SAB', 'descricao' => 'Detecta sons baixos, movimentos ocultos e percebe criaturas tentando passar despercebidas.'],
            ['nome' => 'Prestidigitação',                     'habilidade_chave' => 'DES', 'descricao' => 'Realiza truques de mãos, bate carteiras e oculta objetos pequenos de forma ágil. Requer treinamento.'],
            ['nome' => 'Procurar',                            'habilidade_chave' => 'INT', 'descricao' => 'Encontra objetos ocultos, portas secretas, compartimentos falsos e pistas através de busca minuciosa.'],
            ['nome' => 'Profissão',                           'habilidade_chave' => 'SAB', 'descricao' => 'Exerce uma profissão não-artesanal como marinheiro, fazendeiro, soldado ou cozinheiro. Requer treinamento.'],
            ['nome' => 'Saltar',                              'habilidade_chave' => 'FOR', 'descricao' => 'Realiza saltos em distância, altura e atravessa obstáculos usando força e impulso.'],
            ['nome' => 'Sentir Motivação',                    'habilidade_chave' => 'SAB', 'descricao' => 'Percebe se alguém está mentindo, oculta emoções ou age de forma suspeita. Opõe-se a Blefar.'],
            ['nome' => 'Sobrevivência',                       'habilidade_chave' => 'SAB', 'descricao' => 'Rastreia, caça, encontra abrigo e água, e sobrevive em ambientes selvagens perigosos.'],
            ['nome' => 'Usar Cordas',                         'habilidade_chave' => 'DES', 'descricao' => 'Amarra, faz nós, prende prisioneiros e usa cordas com segurança em escaladas e armadilhas.'],
            ['nome' => 'Usar Instrumento Mágico',             'habilidade_chave' => 'CAR', 'descricao' => 'Ativa varinhas, pergaminhos e outros itens mágicos que normalmente exigem habilidade de conjurador. Requer treinamento.'],
        ];

        foreach ($pericias as $pericia) {
            Pericia::updateOrCreate(
                ['nome' => $pericia['nome'], 'versao' => '3.5'],
                array_merge($pericia, ['versao' => '3.5'])
            );
        }
    }
}
