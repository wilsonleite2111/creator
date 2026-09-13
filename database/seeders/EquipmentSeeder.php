<?php

namespace Database\Seeders;

use App\Models\Arma;
use App\Models\Armadura;
use App\Models\Equipamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Arma::truncate();
        Armadura::truncate();
        Equipamento::truncate();
        Schema::enableForeignKeyConstraints();

        // =========================================================================
        // ARMAS (PHB 3.5) — Simples, Marciais, Exóticas
        // =========================================================================
        $armas = [
            // ---- SIMPLES: Corpo-a-corpo Leves ----
            ['nome' => 'Adaga',                 'preco' => '2 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => '19-20/x2', 'alcance' => '3 m', 'peso' => 0.5, 'tipo' => 'Perfurante ou Cortante', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Lâmina curta e afiada, versátil como arma de melee ou de arremesso. Pode ser escondida com facilidade — teste de Prestidigitação com bônus de +2. Aceita ataque furtivo com dano crítico ampliado (19-20)."],
            ['nome' => 'Adaga de Soco',         'preco' => '2 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x3', 'alcance' => '—', 'peso' => 0.5, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Lâmina curta com empunhadura horizontal presa ao punho, projetada para golpes de perfuração poderosos. Dano crítico triplicado a torna útil contra alvos vulneráveis a golpes precisos."],
            ['nome' => 'Manopla',               'preco' => '2 PO',   'dano_p' => '1d2', 'dano_m' => '1d3', 'critico' => 'x2', 'alcance' => '—', 'peso' => 0.5, 'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Luva reforçada em metal. Transforma um ataque desarmado em ataque letal (não sofre penalidade por atacar sem arma) e permite empunhar uma arma leve na outra mão sem perder proteção. Grátis para quem usa armadura de placas."],
            ['nome' => 'Manopla Cravada',       'preco' => '5 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '—', 'peso' => 0.5, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Manopla com espinhos de metal no dorso e nos nós dos dedos. Amplifica agarramentos: causa dano equivalente enquanto o oponente estiver agarrado."],
            ['nome' => 'Maça Leve',             'preco' => '5 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 2,   'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Bastão curto com cabeça pesada, geralmente de metal. Arma preferida de clérigos por permitir combate em melee sem penalidades religiosas de armas cortantes."],
            ['nome' => 'Foice',                 'preco' => '6 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 1,   'tipo' => 'Cortante', 'categoria' => 'Simples', 'uso' => 'Leve',
                'descricao' => "Lâmina curva em cabo curto, adaptada de ferramenta agrícola. Concede +2 em testes de Combate para derrubar; se falhar por 10+, o oponente pode reverter e derrubar você em vez disso."],

            // ---- SIMPLES: Corpo-a-corpo Uma Mão ----
            ['nome' => 'Clava',                 'preco' => '—',      'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 1.5, 'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Uma Mão',
                'descricao' => "Bastão pesado de madeira, a arma mais primitiva. Pode ser arremessada a 3 m de distância incremental. Gratuita — improvisada em qualquer floresta."],
            ['nome' => 'Maça Pesada',           'preco' => '12 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '—', 'peso' => 4,   'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Uma Mão',
                'descricao' => "Maça de guerra completa, com cabeça achatada ou flangeada. Dano contundente confiável contra armaduras e mortos-vivos com estrutura óssea."],
            ['nome' => 'Estrela da Manhã',      'preco' => '8 PO',   'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '—', 'peso' => 3,   'tipo' => 'Impacto e Perfurante', 'categoria' => 'Simples', 'uso' => 'Uma Mão',
                'descricao' => "Maça com espinhos longos. Combina dano de impacto com perfuração, tornando-a eficaz contra a maioria dos tipos de proteção — o rolamento de dano usa o melhor tipo contra a defesa em questão."],
            ['nome' => 'Lança Curta',           'preco' => '1 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '6 m', 'peso' => 1.5, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Uma Mão',
                'descricao' => "Lança leve e balanceada para uso em uma mão ou arremesso. Alcance de 6 m para lançamento; empunhada em melee, pode ser combinada com escudo."],

            // ---- SIMPLES: Corpo-a-corpo Duas Mãos ----
            ['nome' => 'Lança Longa',           'preco' => '5 PO',   'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '—', 'peso' => 4.5, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Duas Mãos',
                'descricao' => "Lança grande de 3 m — arma de alcance, atinge inimigos a até 3 m sem estarem adjacentes. Não pode atacar quem está adjacente ao usuário. Causa dano dobrado quando armada contra investida (charge)."],
            ['nome' => 'Bordão',                'preco' => '—',      'dano_p' => '1d4/1d4', 'dano_m' => '1d6/1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 2, 'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Duas Mãos',
                'descricao' => "Bastão longo de madeira, comum entre monges, magos e druidas. Arma dupla — pode atacar com ambas as pontas como se estivesse com duas armas. Grátis: cortada em qualquer floresta."],
            ['nome' => 'Lança',                 'preco' => '2 PO',   'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '6 m', 'peso' => 3, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Duas Mãos',
                'descricao' => "Lança padrão de guerra. Pode ser arremessada a 6 m incremental. Empunhada em melee com as duas mãos, dobra o dano quando usada contra investida."],

            // ---- SIMPLES: Ataque à distância ----
            ['nome' => 'Besta Leve',            'preco' => '35 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => '19-20/x2', 'alcance' => '24 m', 'peso' => 2, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Distância',
                'descricao' => "Besta de dedo, recarrega com ação de movimento. Não sofre penalidade por Força baixa nem exige treinamento como o arco. Um dos melhores investimentos para conjuradores em melee arriscado."],
            ['nome' => 'Besta Pesada',          'preco' => '50 PO',  'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => '19-20/x2', 'alcance' => '36 m', 'peso' => 4, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Distância',
                'descricao' => "Besta de corda dupla — recarga em ação de rodada completa. Dano superior e alcance maior; ideal para tiros lentos de emboscada ou combate contra alvos únicos poderosos."],
            ['nome' => 'Dardo',                 'preco' => '5 PP',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '6 m', 'peso' => 0.25, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Distância',
                'descricao' => "Pequena adaga alada balanceada para arremesso. Baratos e fáceis de carregar em quantidade (bandoleiras de dardos são comuns em ladinos). Sem penalidade por Força alta ou baixa."],
            ['nome' => 'Azagaia',               'preco' => '1 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '9 m', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Simples', 'uso' => 'Distância',
                'descricao' => "Lança leve dedicada a arremesso, com haste flexível e ponta afiada. Alcance mais generoso que dardos e maior dano; usar em melee impõe penalidade de -4 (não foi projetada para isso)."],
            ['nome' => 'Funda',                 'preco' => '—',      'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '15 m', 'peso' => 0, 'tipo' => 'Impacto', 'categoria' => 'Simples', 'uso' => 'Distância',
                'descricao' => "Tira de couro simples para arremesso de pedras (balas de funda vendidas separadamente). Grátis; ideal para halflings (bônus racial em armas de arremesso) e patrulheiros de baixo nível."],

            // ---- MARCIAIS: Corpo-a-corpo Leves ----
            ['nome' => 'Machadinha',            'preco' => '6 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x3', 'alcance' => '—', 'peso' => 1.5, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Machado de mão pequeno, útil em combate ou como ferramenta. Dano crítico triplicado a torna eficaz contra alvos com muitos PVs."],
            ['nome' => 'Machadinha de Arremesso', 'preco' => '8 PO', 'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 1, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Machadinha balanceada para lançamento — cabeça menor e mais leve. Alcance de 3 m; ideal para bárbaros e patrulheiros que combinam distância e melee."],
            ['nome' => 'Martelo Leve',          'preco' => '1 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '6 m', 'peso' => 1, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Martelo compacto e leve, também usado como ferramenta. Pode ser arremessado com alcance decente para uma arma leve."],
            ['nome' => 'Kukri',                 'preco' => '8 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => '18-20/x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Faca curva com afiação interna característica das terras montanhosas. Ameaça crítica ampla (18-20) — a preferida de ladinos que combinam ataque furtivo com altas chances de crítico."],
            ['nome' => 'Picareta Leve',         'preco' => '4 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x4', 'alcance' => '—', 'peso' => 1.5, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Ferramenta de mineração adaptada à guerra, com ponta metálica curva. Multiplicador de crítico ×4 é o mais alto entre armas marciais leves — devastadora em golpes precisos."],
            ['nome' => 'Cassetete',             'preco' => '1 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Bastão curto de couro preenchido com metal ou areia. Causa dano não-letal por padrão — arma ideal para capturas em vez de mortes. Ladinos podem aplicar ataque furtivo sem matar."],
            ['nome' => 'Espada Curta',          'preco' => '10 PO',  'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Leve',
                'descricao' => "Espada de lâmina curta e reta, ideal para combate em espaços apertados ou como arma secundária. Ameaça crítica em 19-20."],

            // ---- MARCIAIS: Corpo-a-corpo Uma Mão ----
            ['nome' => 'Machado de Batalha',    'preco' => '10 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '—', 'peso' => 3, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Machado de guerra pesado com uma lâmina larga. Dano crítico ×3 amplifica devastadoramente Ataques Poderosos e talentos de Rachar."],
            ['nome' => 'Mangual',               'preco' => '8 PO',   'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '—', 'peso' => 2.5, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Cabo com uma esfera espigada ligada por corrente. Concede +2 em testes de Combate para desarmar e ignora bônus de escudo do oponente em jogadas de ataque."],
            ['nome' => 'Espada Longa',          'preco' => '15 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 2, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "A arma clássica do cavaleiro medieval: lâmina reta afiada, dupla-corte, guarnição cruciforme. Balanceada para uma mão. Ameaça crítica em 19-20."],
            ['nome' => 'Picareta Pesada',       'preco' => '8 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x4', 'alcance' => '—', 'peso' => 3, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Versão pesada da picareta militar. Multiplicador ×4 no crítico é imbatível entre armas de uma mão. Anões e mineiros a favorecem."],
            ['nome' => 'Rapieira',              'preco' => '20 PO',  'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '18-20/x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Espada longa e fina, focada em perfurações rápidas e precisas. Aceita o talento **Acuidade com Arma** — permite usar modificador de DES em vez de FOR nos ataques. Ameaça crítica ampla (18-20). Arma favorita de duelistas."],
            ['nome' => 'Cimitarra',             'preco' => '15 PO',  'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => '18-20/x2', 'alcance' => '—', 'peso' => 2, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Sabre curvo de origem oriental, ideal para golpes de sabre rápidos. Ameaça crítica em 18-20. É a arma sagrada de Corellon Larethian e de vários deuses do deserto."],
            ['nome' => 'Tridente',              'preco' => '15 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 2, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Lança de três pontas, ideal para pescadores, gladiadores e sacerdotes de deuses marítimos. Pode ser arremessada a 3 m; empunhada em melee com duas mãos, dobra dano contra investida."],
            ['nome' => 'Martelo de Guerra',     'preco' => '12 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '—', 'peso' => 2.5, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Uma Mão',
                'descricao' => "Martelo pesado projetado para guerra — cabeça achatada de um lado e picareta do outro. Arma favorita dos anões e patrona de Moradin. Crítico ×3."],

            // ---- MARCIAIS: Corpo-a-corpo Duas Mãos ----
            ['nome' => 'Machado Grande',        'preco' => '20 PO',  'dano_p' => '1d10', 'dano_m' => '1d12', 'critico' => 'x3', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Machado massivo de duas mãos com lâmina larga. Dano máximo d12 combinado com crítico ×3 dá o maior potencial de dano por golpe em armas marciais. Bárbaros e guerreiros o preferem sobre a Espada Grande quando querem hits explosivos."],
            ['nome' => 'Mangual Pesado',        'preco' => '15 PO',  'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Mangual gigante de duas mãos. Ameaça crítica em 19-20 (raro para 2H). Bônus de +2 para desarmar e ignora escudo do oponente."],
            ['nome' => 'Falcione',              'preco' => '75 PO',  'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => '18-20/x2', 'alcance' => '—', 'peso' => 4, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Espada larga curva de duas mãos, com lâmina única enorme. Combina dano decente (2d4 = médio 5) com a maior ameaça crítica entre armas 2H (18-20). Preferida por guerreiros que investem em Foco Crítico Aprimorado."],
            ['nome' => 'Glaive',                'preco' => '8 PO',   'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x3', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Lâmina curva no topo de uma haste longa. Arma de **alcance** — atinge inimigos a até 3 m mas não pode atacar quem está adjacente ao usuário."],
            ['nome' => 'Foicerra (Guisarme)',   'preco' => '9 PO',   'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => 'x3', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Alabarda com lâmina curva projetada para desmontar cavaleiros. Arma de alcance. Concede +2 em testes de Combate para derrubar e permite iniciar derrubada sem provocar oportunidade."],
            ['nome' => 'Alabarda',              'preco' => '10 PO',  'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x3', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Cortante ou Perfurante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Haste longa com machado + gancho + ponta perfurante. Pode desferir dano cortante ou perfurante (escolha por ataque). Concede +2 para derrubar."],
            ['nome' => 'Lança de Cavalaria',    'preco' => '10 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Lança pesada exclusiva para uso montado. Arma de **alcance** (3 m) e causa dano dobrado em investida. Pode ser empunhada em uma única mão se estiver a cavalo — deixando a outra livre para escudo."],
            ['nome' => 'Ranseur',               'preco' => '10 PO',  'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => 'x3', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Haste longa com três pontas paralelas. Arma de alcance. Concede +2 em testes para desarmar."],
            ['nome' => 'Foice de Guerra',       'preco' => '18 PO',  'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => 'x4', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Cortante ou Perfurante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Foice gigantesca — a foice do Ceifador (Nerull). Multiplicador ×4 no crítico dá o maior dano de crítico entre armas 2H. Concede +2 em testes para derrubar."],
            ['nome' => 'Espada Grande',         'preco' => '50 PO',  'dano_p' => '1d10', 'dano_m' => '2d6', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 4, 'tipo' => 'Cortante', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Espada bastarda pesada de duas mãos. Dano 2d6 (média 7) com ameaça crítica 19-20 dá o melhor dano médio consistente entre armas 2H. Padrão de guerreiros de linha de frente."],
            ['nome' => 'Clava Grande',          'preco' => '5 PO',   'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x2', 'alcance' => '—', 'peso' => 4, 'tipo' => 'Impacto', 'categoria' => 'Marcial', 'uso' => 'Duas Mãos',
                'descricao' => "Bastão massivo com talha ou lastro. Comum entre ogros e semi-ogros — apesar de simples, é considerado marcial pelo tamanho e peso."],

            // ---- MARCIAIS: Ataque à distância ----
            ['nome' => 'Arco Curto',            'preco' => '30 PO',  'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x3', 'alcance' => '18 m', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Distância',
                'descricao' => "Arco compacto e leve — mais barato e útil em corridas ou combate montado. Alcance menor que o longo mas fácil de manejar em movimento."],
            ['nome' => 'Arco Curto Composto',   'preco' => '75 PO',  'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x3', 'alcance' => '21 m', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Distância',
                'descricao' => "Arco curto reforçado com camadas de chifre e ossos. Adiciona modificador de Força (positivo) ao dano dependendo da resistência do arco (custa 75 PO + 100 PO/bonus adicional). Padrão de cavaleiros e batedores montados."],
            ['nome' => 'Arco Longo',            'preco' => '75 PO',  'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '30 m', 'peso' => 1.5, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Distância',
                'descricao' => "O arco de guerra clássico dos elfos. Alcance longo, dano decente, crítico ×3. Arma emblemática de patrulheiros, arqueiros dedicados e elfos militantes."],
            ['nome' => 'Arco Longo Composto',   'preco' => '100 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => 'x3', 'alcance' => '33 m', 'peso' => 1.5, 'tipo' => 'Perfurante', 'categoria' => 'Marcial', 'uso' => 'Distância',
                'descricao' => "Arco longo reforçado. Adiciona modificador de Força ao dano (100 PO + 100 PO por ponto de bônus). Uma das armas mais eficientes para arqueiros dedicados combinando Força alta."],

            // ---- EXÓTICAS: Corpo-a-corpo Leves ----
            ['nome' => 'Kama',                  'preco' => '2 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Leve',
                'descricao' => "Foice curta oriental montada em cabo curto. Uma das armas monásticas — monges usam com proficiência automática. Concede +2 em testes de Combate para derrubar."],
            ['nome' => 'Nunchaku',              'preco' => '2 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Impacto', 'categoria' => 'Exótica', 'uso' => 'Leve',
                'descricao' => "Dois bastões curtos ligados por corrente ou corda. Arma monástica. Concede +2 em testes para desarmar oponente."],
            ['nome' => 'Sai',                   'preco' => '1 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 0.5, 'tipo' => 'Impacto', 'categoria' => 'Exótica', 'uso' => 'Leve',
                'descricao' => "Adaga tripla oriental — lâmina central ladeada por dois ganchos. Arma monástica. Concede +4 em testes para desarmar. Pode ser arremessada."],
            ['nome' => 'Siangham',              'preco' => '3 PO',   'dano_p' => '1d4', 'dano_m' => '1d6', 'critico' => 'x2', 'alcance' => '—', 'peso' => 0.5, 'tipo' => 'Perfurante', 'categoria' => 'Exótica', 'uso' => 'Leve',
                'descricao' => "Bastão curto de metal com ponta afiada, empunhado com movimento circular. Arma monástica com dano perfurante."],

            // ---- EXÓTICAS: Corpo-a-corpo Uma Mão ----
            ['nome' => 'Espada Bastarda',       'preco' => '35 PO',  'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 3, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Uma Mão',
                'descricao' => "Espada 'e meia' — pode ser usada com uma ou duas mãos. Com **proficiência exótica**, uma só mão consegue empunhá-la (com dano de arma de uma mão). Sem proficiência, é tratada como arma marcial de duas mãos. Favorita de guerreiros habilidosos que combinam com escudo."],
            ['nome' => 'Machado de Guerra Anão','preco' => '30 PO',  'dano_p' => '1d8', 'dano_m' => '1d10', 'critico' => 'x3', 'alcance' => '—', 'peso' => 4, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Uma Mão',
                'descricao' => "Machado de guerra pesado tradicional dos anões. Anões tratam esta arma como **marcial** por familiaridade racial. Grande dano em uma mão com crítico ×3, permitindo combinar com escudo."],
            ['nome' => 'Chicote',               'preco' => '1 PO',   'dano_p' => '1d2', 'dano_m' => '1d3', 'critico' => 'x2', 'alcance' => '—', 'peso' => 1, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Uma Mão',
                'descricao' => "Chicote de couro trançado. Arma de **alcance** (4,5 m — atinge inimigos a até 4,5 m mas não adjacentes). Dano não-letal por padrão. Aceita **Acuidade com Arma**. Não afeta criaturas com bônus de armadura ≥ +1 ou natural ≥ +3."],

            // ---- EXÓTICAS: Corpo-a-corpo Duas Mãos ----
            ['nome' => 'Machado Duplo Orc',     'preco' => '60 PO',  'dano_p' => '1d6/1d6', 'dano_m' => '1d8/1d8', 'critico' => 'x3', 'alcance' => '—', 'peso' => 7.5, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Machado com lâminas nas duas pontas, arma tradicional das tribos orc. Arma **dupla** — pode atacar com ambas as pontas como se estivesse com duas armas. Orcs e meio-orcs tratam como marcial."],
            ['nome' => 'Corrente Espigada',     'preco' => '25 PO',  'dano_p' => '1d6', 'dano_m' => '2d4', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Perfurante', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Corrente longa de metal cheia de espinhos. Arma de **alcance** — atinge tanto adjacentes quanto a 3 m. Aceita **Acuidade com Arma**. +2 em testes para derrubar e desarmar. Favorita de duelistas ágeis."],
            ['nome' => 'Mangual Duplo',         'preco' => '90 PO',  'dano_p' => '1d6/1d6', 'dano_m' => '1d8/1d8', 'critico' => 'x2', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Impacto', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Mangual com esferas espigadas nas duas pontas. Arma **dupla** — permite ataques com ambas as extremidades. Concede +2 para desarmar e ignora escudos em ataques."],
            ['nome' => 'Martelo Gancho Gnômico','preco' => '20 PO',  'dano_p' => '1d6/1d4', 'dano_m' => '1d8/1d6', 'critico' => 'x3/x4', 'alcance' => '—', 'peso' => 3, 'tipo' => 'Impacto e Perfurante', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Martelo com gancho de picareta na outra ponta. Arma **dupla** — cabeça de martelo (impacto, ×3) e gancho (perfurante, ×4). Gnomos tratam como marcial."],
            ['nome' => 'Espada Duas Lâminas',   'preco' => '100 PO', 'dano_p' => '1d6/1d6', 'dano_m' => '1d8/1d8', 'critico' => '19-20/x2', 'alcance' => '—', 'peso' => 5, 'tipo' => 'Cortante', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Espada com lâminas em ambas as pontas do cabo central. Arma **dupla** — atacar com as duas lâminas como duas armas. Cara e difícil de dominar, mas devastadora com **Combate com Duas Armas Maior**."],
            ['nome' => 'Urgrosh Anão',          'preco' => '50 PO',  'dano_p' => '1d6/1d4', 'dano_m' => '1d8/1d6', 'critico' => 'x3', 'alcance' => '—', 'peso' => 6, 'tipo' => 'Cortante e Perfurante', 'categoria' => 'Exótica', 'uso' => 'Duas Mãos',
                'descricao' => "Machado + lança combinados em um cabo longo. Arma **dupla** — lâmina de machado (cortante) e ponta de lança (perfurante). Anões tratam como marcial. Dobra dano em investida (ponta de lança)."],

            // ---- EXÓTICAS: Ataque à distância ----
            ['nome' => 'Boleadeira',            'preco' => '5 PO',   'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 1, 'tipo' => 'Impacto', 'categoria' => 'Exótica', 'uso' => 'Distância',
                'descricao' => "Três esferas de metal ou pedra amarradas por cordas. Dano não-letal. Concede +2 em testes para derrubar (não provoca AO ao tentar derrubar com boleadeira)."],
            ['nome' => 'Besta de Mão',          'preco' => '100 PO', 'dano_p' => '1d3', 'dano_m' => '1d4', 'critico' => '19-20/x2', 'alcance' => '9 m', 'peso' => 1, 'tipo' => 'Perfurante', 'categoria' => 'Exótica', 'uso' => 'Distância',
                'descricao' => "Besta miniatura para uma mão só. Pode ser recarregada com ação livre com talento apropriado. Custosa mas permite atacar com escudo ou espada na outra mão. Ladinos assassinos a usam com virotes envenenados."],
            ['nome' => 'Besta de Repetição',    'preco' => '250 PO', 'dano_p' => '1d6', 'dano_m' => '1d8', 'critico' => '19-20/x2', 'alcance' => '24 m', 'peso' => 3, 'tipo' => 'Perfurante', 'categoria' => 'Exótica', 'uso' => 'Distância',
                'descricao' => "Besta com magazine de 5 virotes. Recarrega automaticamente com alavanca (ação livre) até esgotar; então precisa 1 rodada completa para nova carga. Permite tiros sem interrupção."],
            ['nome' => 'Rede',                  'preco' => '20 PO',  'dano_p' => '—', 'dano_m' => '—', 'critico' => '—', 'alcance' => '3 m', 'peso' => 3, 'tipo' => '—', 'categoria' => 'Exótica', 'uso' => 'Distância',
                'descricao' => "Rede tecida de corda ou seda, arremessada para prender oponentes. Alvo passa em Reflexos ou fica enredado. Não causa dano; usada para captura. Recolher exige 1 rodada de dobra."],
            ['nome' => 'Shuriken',              'preco' => '1 PO',   'dano_p' => '1', 'dano_m' => '1d2', 'critico' => 'x2', 'alcance' => '3 m', 'peso' => 0.05, 'tipo' => 'Perfurante', 'categoria' => 'Exótica', 'uso' => 'Distância',
                'descricao' => "Estrela de arremesso oriental. Vendidas em pacotes de 5. Pode ser usada como munição — pode arremessar múltiplas por rodada com **Disparo Rápido**. Preço listado é por unidade."],
        ];

        foreach ($armas as $arma) {
            Arma::create($arma);
        }

        // =========================================================================
        // ARMADURAS (PHB 3.5) — Leves, Médias, Pesadas, Escudos
        // =========================================================================
        $armaduras = [
            // ---- LEVES ----
            ['nome' => 'Acolchoada',             'preco' => '5 PO',   'bonus_ca' => 1, 'destreza_max' => 8, 'penalidade_armadura' => 0, 'falha_arcana' => 5, 'deslocamento_9m' => '9 m', 'deslocamento_6m' => '6 m', 'peso' => 5, 'tipo' => 'Leve',
                'descricao' => "Camadas de tecido acolchoado e forrado. A armadura mais barata; oferece proteção mínima mas praticamente sem penalidade. Feiticeiros e bardos que aceitam falha arcana de 5% costumam usá-la."],
            ['nome' => 'Couro',                  'preco' => '10 PO',  'bonus_ca' => 2, 'destreza_max' => 6, 'penalidade_armadura' => 0, 'falha_arcana' => 10, 'deslocamento_9m' => '9 m', 'deslocamento_6m' => '6 m', 'peso' => 7.5, 'tipo' => 'Leve',
                'descricao' => "Placas de couro tratado e endurecido. Ampla adoção entre patrulheiros, bardos e ladinos por não impor penalidade de armadura em perícias baseadas em DES."],
            ['nome' => 'Couro Batido',           'preco' => '25 PO',  'bonus_ca' => 3, 'destreza_max' => 5, 'penalidade_armadura' => -1, 'falha_arcana' => 15, 'deslocamento_9m' => '9 m', 'deslocamento_6m' => '6 m', 'peso' => 10, 'tipo' => 'Leve',
                'descricao' => "Couro reforçado com botões e placas de metal em pontos críticos. Bônus intermediário; ideal para ladinos que priorizam esquiva."],
            ['nome' => 'Camisão de Cota de Malha','preco' => '100 PO','bonus_ca' => 4, 'destreza_max' => 4, 'penalidade_armadura' => -2, 'falha_arcana' => 20, 'deslocamento_9m' => '9 m', 'deslocamento_6m' => '6 m', 'peso' => 12.5, 'tipo' => 'Leve',
                'descricao' => "Malha metálica curta que cobre torso e ombros. A melhor armadura leve — bônus 4 de CA. Não impede deslocamento normal, embora tenha peso considerável."],

            // ---- MÉDIAS ----
            ['nome' => 'Couro Batido Reforçado', 'preco' => '15 PO',  'bonus_ca' => 3, 'destreza_max' => 4, 'penalidade_armadura' => -3, 'falha_arcana' => 20, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 10, 'tipo' => 'Média',
                'descricao' => "Peles grossas de animais de couro grosso (urso, jacaré) tratadas. Comum entre bárbaros tribais que rejeitam metal por conflitar com sua fúria natural."],
            ['nome' => 'Cota Escamada',          'preco' => '50 PO',  'bonus_ca' => 4, 'destreza_max' => 3, 'penalidade_armadura' => -4, 'falha_arcana' => 25, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 15, 'tipo' => 'Média',
                'descricao' => "Pequenas escamas de metal costuradas em couro reforçado. Balanço razoável entre proteção e mobilidade; comum entre patrulheiros e mercenários de nível médio."],
            ['nome' => 'Cota de Malha',          'preco' => '150 PO', 'bonus_ca' => 5, 'destreza_max' => 2, 'penalidade_armadura' => -5, 'falha_arcana' => 30, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 20, 'tipo' => 'Média',
                'descricao' => "Milhares de anéis de metal entrelaçados formando uma túnica de guerra. Padrão dos cavaleiros de segunda linha e clérigos guerreiros. Excelente relação bônus/custo."],
            ['nome' => 'Peitoral',               'preco' => '200 PO', 'bonus_ca' => 5, 'destreza_max' => 3, 'penalidade_armadura' => -4, 'falha_arcana' => 25, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 15, 'tipo' => 'Média',
                'descricao' => "Placa de metal moldada cobrindo torso e costas. Combina bônus alto com mobilidade excepcional (DES máx +3, apenas -4 de penalidade). Padrão dos paladinos móveis."],

            // ---- PESADAS ----
            ['nome' => 'Cota de Talas',          'preco' => '200 PO', 'bonus_ca' => 6, 'destreza_max' => 0, 'penalidade_armadura' => -7, 'falha_arcana' => 40, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 22.5, 'tipo' => 'Pesada',
                'descricao' => "Tiras de metal longas alinhadas verticalmente sobre reforço de couro. Alta proteção, alta penalidade. Comum em guardas de portão e soldados de infantaria pesada."],
            ['nome' => 'Cota de Anéis',          'preco' => '250 PO', 'bonus_ca' => 6, 'destreza_max' => 1, 'penalidade_armadura' => -6, 'falha_arcana' => 35, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 17.5, 'tipo' => 'Pesada',
                'descricao' => "Cota de malha reforçada por grandes anéis metálicos horizontais aplicados sobre pontos vitais. Bônus alto e menor penalidade que outras pesadas — favorita de comandantes."],
            ['nome' => 'Meia-Placa',             'preco' => '600 PO', 'bonus_ca' => 7, 'destreza_max' => 0, 'penalidade_armadura' => -7, 'falha_arcana' => 40, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 25, 'tipo' => 'Pesada',
                'descricao' => "Placas metálicas em pontos-chave sobre cota de malha, sem articulação completa. Bônus excelente pelo preço; padrão de cavaleiros da guarda real."],
            ['nome' => 'Armadura Completa',      'preco' => '1500 PO','bonus_ca' => 8, 'destreza_max' => 1, 'penalidade_armadura' => -6, 'falha_arcana' => 35, 'deslocamento_9m' => '6 m', 'deslocamento_6m' => '4.5 m', 'peso' => 25, 'tipo' => 'Pesada',
                'descricao' => "Armadura de placas completa e articulada, feita sob medida — cada peça encaixa perfeitamente na próxima. A melhor proteção não-mágica do PHB. Requer 1d4+1 minutos e ajudante para vestir; sem ajudante, dobra o tempo. Preço proibitivo (1500 PO) — símbolo de status de cavaleiros nobres e paladinos veteranos."],

            // ---- ESCUDOS ----
            ['nome' => 'Broquel',                'preco' => '15 PO',  'bonus_ca' => 1, 'destreza_max' => null, 'penalidade_armadura' => -1, 'falha_arcana' => 5, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 2.5, 'tipo' => 'Escudo',
                'descricao' => "Pequeno escudo circular preso ao antebraço. Concede +1 de CA mas permite empunhar arma de duas mãos ou lançar magias sem interferência (ainda com falha arcana de 5%)."],
            ['nome' => 'Escudo Leve de Madeira', 'preco' => '3 PO',   'bonus_ca' => 1, 'destreza_max' => null, 'penalidade_armadura' => -1, 'falha_arcana' => 5, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 2.5, 'tipo' => 'Escudo',
                'descricao' => "Escudo pequeno de madeira. Barato, leve, sem custo especial. Padrão de guerreiros iniciantes e patrulheiros."],
            ['nome' => 'Escudo Leve de Aço',     'preco' => '9 PO',   'bonus_ca' => 1, 'destreza_max' => null, 'penalidade_armadura' => -1, 'falha_arcana' => 5, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 3, 'tipo' => 'Escudo',
                'descricao' => "Escudo pequeno de aço, mais durável que madeira. Serve como base para muitos escudos mágicos."],
            ['nome' => 'Escudo Pesado de Madeira','preco' => '7 PO',  'bonus_ca' => 2, 'destreza_max' => null, 'penalidade_armadura' => -2, 'falha_arcana' => 15, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 5, 'tipo' => 'Escudo',
                'descricao' => "Escudo grande de madeira reforçada. Bônus dobrado ao broquel; a segunda mão fica ocupada, então não permite arma de duas mãos."],
            ['nome' => 'Escudo Pesado de Aço',   'preco' => '20 PO',  'bonus_ca' => 2, 'destreza_max' => null, 'penalidade_armadura' => -2, 'falha_arcana' => 15, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 7.5, 'tipo' => 'Escudo',
                'descricao' => "Escudo grande de aço, o padrão de cavaleiros. Duradouro e base preferida para escudos mágicos."],
            ['nome' => 'Escudo Torre',           'preco' => '30 PO',  'bonus_ca' => 4, 'destreza_max' => 2, 'penalidade_armadura' => -10, 'falha_arcana' => 50, 'deslocamento_9m' => '—', 'deslocamento_6m' => '—', 'peso' => 22.5, 'tipo' => 'Escudo',
                'descricao' => "Escudo enorme, praticamente uma parede portátil. Concede +4 de CA e pode ser usado como **cobertura total** (ação padrão): você ganha cobertura de +4 na CA e Reflexos, mas não pode atacar. Penalidade -10 nos testes de ataque enquanto usa como escudo normal (não recomendado). Ideal para arqueiros e ladinos que precisam abrigar-se em campos abertos."],
        ];

        foreach ($armaduras as $armadura) {
            Armadura::create($armadura);
        }

        // =========================================================================
        // EQUIPAMENTOS (PHB 3.5) — 8 categorias
        // =========================================================================
        $equipamentos = [
            // ============ EQUIPAMENTOS DE AVENTURA ============
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Mochila (vazia)',           'preco' => '2 PO',   'peso' => 1,    'descricao' => "Bolsa de couro com alças para as costas. Capacidade de 30 kg. Fundamental para transportar equipamento sem ocupar as mãos."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Saco de Dormir',            'preco' => '1 PP',   'peso' => 2.5,  'descricao' => "Saco grosso de tecido para acampar. Protege do frio moderado. Enrolado para o transporte."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Cobertor de Inverno',       'preco' => '5 PP',   'peso' => 1.5,  'descricao' => "Cobertor pesado de lã. Concede +2 em testes de Fortitude contra frio extremo quando enrolado ao corpo."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Gancho de Escalada',        'preco' => '1 PO',   'peso' => 2,    'descricao' => "Gancho triplo de metal amarrado a uma corda. Concede +2 em testes de Escalar quando usado para ancorar a corda em parapeitos, saliências ou aberturas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Corda de Cânhamo (15 m)',   'preco' => '1 PO',   'peso' => 5,    'descricao' => "Corda robusta de fibras vegetais. Suporta até 120 kg. Padrão para escalada, atalho e amarras. Um dos itens mais úteis em qualquer aventura."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Corda de Seda (15 m)',      'preco' => '10 PO',  'peso' => 2.5,  'descricao' => "Corda de seda resistente e leve — metade do peso da corda de cânhamo. Aguenta 100 kg. +2 em Escalar e Usar Cordas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Escada Corda (3 m)',        'preco' => '2 PO',   'peso' => 3.5,  'descricao' => "Escada dobrável de corda com degraus de madeira. Cai 3 m para baixo quando ancorada acima. Concede +2 em Escalar quando armada."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Corrente (3 m)',            'preco' => '30 PO',  'peso' => 1,    'descricao' => "Corrente de metal. Aguenta 300 kg de peso. Útil para amarras robustas, ancoragens em pedras ou como arma improvisada."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Lanterna Coberta',          'preco' => '7 PO',   'peso' => 1,    'descricao' => "Lanterna com aba deslizante para controlar a saída de luz. Ilumina 9 m em raio, penumbra por mais 9 m. Consome 500 mL de óleo em 6 horas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Lanterna Furta-Fogo',       'preco' => '12 PO',  'peso' => 1.5,  'descricao' => "Lanterna com foco direcional (cone de luz de 18 m). Ideal para batedores e caçadores — permite iluminar uma área específica sem cegar aliados atrás. Consome óleo em 6 horas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Tocha',                     'preco' => '1 PC',   'peso' => 0.5,  'descricao' => "Bastão de madeira embebido em piche. Queima por 1 hora, iluminando 6 m em raio e penumbra por 6 m adicionais. Pode ser usada como arma improvisada causando 1d3 de fogo."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Óleo (frasco 500 mL)',      'preco' => '1 PP',   'peso' => 0.5,  'descricao' => "Óleo para lanternas. Também pode ser jogado como arma improvisada: teste de atirar objeto, causa 1d3 de dano de fogo se aceso e derramado sobre alvo em fogo."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Pederneira e Isqueiro',     'preco' => '1 PO',   'peso' => 0,    'descricao' => "Pedra e aço para acender fogo. Faz uma fogueira em 1 rodada com combustível seco. Sem custo se o personagem já tem — assume-se que aventureiros carregam por padrão."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Anzol',                     'preco' => '1 PP',   'peso' => 0,    'descricao' => "Gancho pequeno de metal para pesca. Combinado com linha e paciência, garante refeições em rios e lagos."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Apito de Sinal',            'preco' => '8 PP',   'peso' => 0,    'descricao' => "Apito pequeno emitindo som agudo audível a 300 m em ambiente aberto. Padrão para coordenar batalhas ou marchas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Piton',                     'preco' => '1 PP',   'peso' => 0.25, 'descricao' => "Prego grosso de metal com anel. Usado para escalada — martelado em fendas de pedra para criar pontos de ancoragem. Concede +2 em Escalar."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Giz (1 pedaço)',            'preco' => '1 PC',   'peso' => 0,    'descricao' => "Bastão branco de calcário. Marca superfícies temporariamente para rastros, mapas de dungeon ou glifos improvisados."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Martelo',                   'preco' => '5 PP',   'peso' => 1,    'descricao' => "Martelo de carpinteiro comum. Usado para pitons, cravar tábuas, quebrar portas. Também improvisa golpes de impacto (1d4)."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Pé de Cabra',               'preco' => '2 PO',   'peso' => 2.5,  'descricao' => "Barra de ferro curva usada como alavanca. Concede +2 em testes de Força para arrombar portas, tampas ou fechaduras trancadas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Marreta',                   'preco' => '1 PO',   'peso' => 5,    'descricao' => "Martelo pesado de duas mãos para trabalhos brutos. Concede +2 em testes de Força para quebrar objetos. Improvisa golpes de 1d6 impacto."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Espelho de Aço',            'preco' => '10 PO',  'peso' => 0.25, 'descricao' => "Espelho pequeno polido, do tamanho da palma da mão. Útil para verificar cantos, refletir luz, identificar medusas ou dopplegangers pela reflexão."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Pedra de Amolar',           'preco' => '2 PC',   'peso' => 0.5,  'descricao' => "Pedra abrasiva para afiar lâminas. Padrão para guerreiros que preservam seu equipamento em campanhas longas."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Algemas',                   'preco' => '15 PO',  'peso' => 1,    'descricao' => "Algemas de metal para pulsos. Fecham com CD 30 para Arte da Fuga; abrem com CD 30 em Abrir Fechaduras. Usadas para prender inimigos capturados ou levar prisioneiros."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Algemas de Obra-Prima',     'preco' => '50 PO',  'peso' => 1,    'descricao' => "Algemas fabricadas com precisão. CD 35 para escapar (Arte da Fuga) ou abrir (Abrir Fechaduras). Padrão para prisioneiros perigosos."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Cantil',                    'preco' => '1 PO',   'peso' => 2,    'descricao' => "Frasco de couro ou madeira coberto por lona. Comporta 2 litros. Peso listado com água."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Saco Pequeno',              'preco' => '1 PP',   'peso' => 0.25, 'descricao' => "Saco pequeno de tecido. Capacidade 5 kg. Ideal para itens miúdos (moedas, pedras preciosas, componentes)."],
            ['categoria' => 'Equipamentos de aventura', 'nome' => 'Saco Grande',               'preco' => '2 PP',   'peso' => 0.5,  'descricao' => "Saco médio. Capacidade 15 kg. Usado para transportar espólios de aventura."],

            // ============ ITENS E SUBSTÂNCIAS ESPECIAIS ============
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Ácido (frasco)',              'preco' => '10 PO',  'peso' => 0.5, 'descricao' => "Frasco de ácido concentrado. Arremessado como granada (alcance 3 m): causa 1d6 de dano de ácido no impacto direto + 1 de respingo em criaturas adjacentes. Pode ser usado em armadilhas ou para corroer materiais."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Fogo Alquímico (frasco)',      'preco' => '20 PO',  'peso' => 0.5, 'descricao' => "Frasco de composto altamente inflamável. Como granada (3 m): 1d6 de fogo no impacto + 1d6 por 1 rodada adicional (o alvo pode passar em Reflexos para apagar). Uma das melhores armas químicas contra criaturas vulneráveis a fogo."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Antitoxina (frasco)',          'preco' => '50 PO',  'peso' => 0,   'descricao' => "Poção alquímica que neutraliza venenos. Ingerida, concede +5 em TR contra venenos pelas próximas 1 hora. Padrão em campanhas com muitos monstros peçonhentos."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Água Benta (frasco)',          'preco' => '25 PO',  'peso' => 0.5, 'descricao' => "Água purificada em templo consagrado. Como granada (3 m): 2d4 de dano contra mortos-vivos ou criaturas malignas extraplanares. Pode ser aspergida em armaduras/armas para benção temporária."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Bastão Solar',                 'preco' => '2 PO',   'peso' => 0.5, 'descricao' => "Bastão alquímico que brilha como luz solar durante 6 horas. Ilumina em raio de 9 m. Não pode ser extinto por água nem vento. Cegante para vampiros e outros mortos-vivos vulneráveis à luz solar."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Bastão Fumígeno',              'preco' => '20 PO',  'peso' => 0.5, 'descricao' => "Cilindro alquímico que emite nuvem de fumaça densa em 3 m de raio ao ser acionado. Bloqueia visão por 1 minuto. Cria cobertura total para escape ou tática furtiva. Vento moderado dispersa em 1d4 rodadas."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Bolsa de Cola',                'preco' => '50 PO',  'peso' => 2,   'descricao' => "Bolsa com resina alquímica. Arremessada como granada: alvo faz Reflexos ou fica preso ao chão (Escapar CD 17 ou 15 min. até endurecer completamente). Depois de endurecida, pode ser quebrada com Força CD 17."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Pedra do Trovão',              'preco' => '30 PO',  'peso' => 0.5, 'descricao' => "Pedra alquímica arremessada como granada: explode com estrondo, deixando surdos (Fortitude ou surdez temporária) todos em raio de 3 m. Ataque à distância de toque para atingir alvo específico."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Palito Ígneo',                 'preco' => '1 PO',   'peso' => 0,   'descricao' => "Palito de fósforo alquímico. Acende com faísca de fricção em ação livre — muito mais rápido que pederneira e isqueiro. Cada palito serve para acender uma vez."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Tocha Perpétua',               'preco' => '110 PO', 'peso' => 0.5, 'descricao' => "Tocha encantada com magia menor (Luz Contínua). Emite luz permanentemente até ser dissipada. Custo alto (110 PO) mas nunca precisa combustível — ideal para exploradores dedicados de subterrâneos."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Veneno (Manáculo — Fort 16)',  'preco' => '250 PO', 'peso' => 0,   'descricao' => "Veneno de contato aplicado em armas. Alvo faz Fortitude CD 16 ou sofre 1d6 de dano de Destreza inicial e 2d6 de Destreza secundário. Adquirir/usar venenos frequentemente afeta alinhamento — veneno é considerado ato maligno em D&D 3.5."],
            ['categoria' => 'Itens e substâncias especiais', 'nome' => 'Veneno (Cobra Grande — Fort 11)','preco' => '120 PO','peso' => 0,   'descricao' => "Veneno de injeção. Fortitude CD 11 ou sofre 1d6 de Constituição inicial e 1d6 de Constituição secundário. Aplicado em lâminas de ladinos assassinos."],

            // ============ INSTRUMENTOS DE CLASSE E KITS DE PERÍCIA ============
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Estojo de Primeiros Socorros', 'preco' => '50 PO',  'peso' => 0.5, 'descricao' => "Kit de bandagens, ervas medicinais e agulhas de sutura. Concede +2 em testes de Cura. Contém 10 usos; recarrega em cidades."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Instrumento Musical (comum)',  'preco' => '5 PO',   'peso' => 1.5, 'descricao' => "Instrumento musical de qualidade média (flauta, alaúde, tambor, etc.). Ferramenta obrigatória para o **Bardo** ativar Música de Bardo em performances. Escolha o tipo na compra."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Instrumento Musical (obra-prima)', 'preco' => '100 PO', 'peso' => 1.5, 'descricao' => "Instrumento de obra-prima. Concede +2 em testes de Atuação. Bardos com este item conseguem efeitos musicais mais potentes."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Símbolo Sagrado (madeira)',    'preco' => '1 PO',   'peso' => 0,   'descricao' => "Símbolo religioso comum de madeira entalhada. **Foco Divino** obrigatório para clérigos, druidas e paladinos lançarem magias com componente FD. Deve ser visível ao alvo em rituais de expulsão."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Símbolo Sagrado (prata)',      'preco' => '25 PO',  'peso' => 0.5, 'descricao' => "Símbolo religioso de prata forjada. Foco divino de prestígio. Alguns rituais poderosos e itens mágicos exigem especificamente o símbolo de prata em vez de madeira."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Bolsa de Componentes',         'preco' => '5 PO',   'peso' => 1,   'descricao' => "Bolsa com todos os componentes materiais baratos para magias arcanas — não é preciso pagar cada componente listado se ele custa <1 PO. **Obrigatório** para magos e feiticeiros lançarem magias com componente M sem material específico."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Grimório (vazio)',             'preco' => '15 PO',  'peso' => 1.5, 'descricao' => "Livro encadernado em couro com 100 páginas de pergaminho tratado. Cada magia ocupa páginas iguais ao seu círculo. **Obrigatório** para magos — o grimório é o mago em livro; perdê-lo tira as magias preparadas até recuperá-lo ou reescrevê-las (custa 100 PO por página)."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Ferramentas de Ladrão',        'preco' => '30 PO',  'peso' => 0.5, 'descricao' => "Kit com gazuas, tensores, pinças e limas. **Obrigatório** para tentar abrir fechaduras sem penalidade (-2 sem ferramentas). Também usado com Operar Mecanismo para desarmar armadilhas mecânicas."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Ferramentas de Ladrão (obra-prima)', 'preco' => '100 PO', 'peso' => 1, 'descricao' => "Ferramentas de ladrão fabricadas com precisão exemplar. Concede +2 em Abrir Fechaduras e Operar Mecanismo."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Ferramentas de Artesão',       'preco' => '5 PO',   'peso' => 2.5, 'descricao' => "Ferramentas para uma profissão de Ofícios específica (ferraria, carpintaria, alquimia etc.). Sem elas, testes de Ofícios sofrem -2. Escolher a profissão na compra."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Ferramentas de Artesão (obra-prima)', 'preco' => '55 PO', 'peso' => 2.5, 'descricao' => "Ferramentas de qualidade suprema para uma profissão específica. Concede +2 em testes daquela Ofícios."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Kit de Escalador',             'preco' => '80 PO',  'peso' => 2.5, 'descricao' => "Cordas, ganchos, pitons e pó de magnésio em bolsa dedicada. Concede +2 em testes de Escalar. Padrão de ladinos exploradores urbanos."],
            ['categoria' => 'Instrumentos de classe e kits de perícia', 'nome' => 'Kit de Disfarce',              'preco' => '50 PO',  'peso' => 4,   'descricao' => "Maquiagem, perucas, roupas variadas e adereços. Concede +2 em testes de Disfarce. Contém 10 usos; recarrega em cidade."],

            // ============ INDUMENTÁRIA ============
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Artesão',       'preco' => '1 PO',   'peso' => 2, 'descricao' => "Roupas simples mas práticas de trabalho: túnica, avental e calças resistentes. Adequado para artesãos urbanos comuns."],
            ['categoria' => 'Indumentária', 'nome' => 'Vestimentas Clericais',  'preco' => '5 PO',   'peso' => 3, 'descricao' => "Vestes cerimoniais bordadas com símbolos sagrados. Adequadas para atendimento religioso e cerimônias formais. Não conferem bônus em magia mas identificam o portador como clérigo."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Frio Extremo',  'preco' => '8 PO',   'peso' => 3.5, 'descricao' => "Peles pesadas, luvas grossas, capuz, botas revestidas. Concede +5 em testes de Fortitude contra frio (não frio extremo, no entanto). Reduz o custo de Perícia Sobrevivência em ambiente ártico."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Cortesão',      'preco' => '30 PO',  'peso' => 3, 'descricao' => "Vestes elegantes de veludo, seda e brocados. Necessário para eventos aristocráticos. Concede +2 em Diplomacia com nobres se combinado com etiqueta apropriada."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Artista',       'preco' => '3 PO',   'peso' => 2, 'descricao' => "Roupas coloridas e chamativas de saltimbanco ou trovador. Necessário para bardos em performances públicas — sinal profissional."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Explorador',    'preco' => '10 PO',  'peso' => 4, 'descricao' => "Roupas resistentes de couro batido e lona: calças, jaqueta, botas de couro, capa. Adequado para aventura em qualquer clima moderado. Padrão do aventureiro."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje Monástico',        'preco' => '5 PO',   'peso' => 1, 'descricao' => "Vestes soltas de monastério: calças largas, túnica sem mangas, faixas. Não impede Rajada de Golpes nem outras habilidades de monge. Alguns monastérios exigem cor específica."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje Nobre',            'preco' => '75 PO',  'peso' => 5, 'descricao' => "Vestes finas de aristocracia — sedas, joias pequenas, chapéu formal. Padrão para audiências reais e eventos de alto status. Concede +1 em Diplomacia em contextos nobres."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Camponês',      'preco' => '1 PP',   'peso' => 1, 'descricao' => "Roupas simples de trabalho rural: camisola de lã, calças de linho, cinturão de couro. Não desperta atenção — ideal para disfarce em áreas rurais."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje Real',             'preco' => '200 PO', 'peso' => 7.5, 'descricao' => "Vestimenta de rei ou rainha, com bordados de ouro e pedras preciosas. Peso considerável pela quantidade de adornos. Não pode ser usado em combate. Concede +4 em Diplomacia com quem reconhece a autoridade real."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Erudito',       'preco' => '5 PO',   'peso' => 3, 'descricao' => "Toga simples de acadêmico com muitos bolsos para pergaminhos e livros. Preferido por magos, sábios e sacerdotes teólogos."],
            ['categoria' => 'Indumentária', 'nome' => 'Traje de Viajante',      'preco' => '1 PO',   'peso' => 2.5, 'descricao' => "Roupas confortáveis para longas viagens: túnica de linho, calças de lã, capa dobrável. Suporta clima variado."],

            // ============ COMIDA, BEBIDA E HOSPEDAGEM ============
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Cerveja (caneca)',              'preco' => '4 PC',   'peso' => 0.5, 'descricao' => "Caneca de cerveja comum de taverna. 500 mL de bebida fermentada. Um dos custos mais baixos das tavernas populares."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Cerveja (barril)',              'preco' => '2 PO',   'peso' => 30,  'descricao' => "Barril de cerveja completo. 40 canecas equivalentes. Adequado para festas de guilda ou taverna comercializar por semanas."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Banquete (por pessoa)',          'preco' => '10 PO',  'peso' => 0,   'descricao' => "Refeição elaborada de vários pratos, comum em audiências nobres ou celebrações. Inclui iguarias, vinho fino e sobremesa."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Pão (broa)',                     'preco' => '2 PC',   'peso' => 0.25, 'descricao' => "Broa fresca do dia. Alimenta uma pessoa em um dia. Padrão em qualquer padaria de vila."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Queijo (pedaço)',                'preco' => '1 PP',   'peso' => 0.25, 'descricao' => "Pedaço de queijo curado. Alimento durável, comum em provisões de viagem."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Estalagem (por dia, pobre)',      'preco' => '2 PP',   'peso' => 0,   'descricao' => "Cama comum em quarto compartilhado. Sem privacidade. Café rude na manhã seguinte."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Estalagem (por dia, boa)',        'preco' => '5 PP',   'peso' => 0,   'descricao' => "Quarto individual com cama, lavabo e refeição comum. Padrão para mercadores e aventureiros estabelecidos."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Estalagem (por dia, luxuosa)',    'preco' => '2 PO',   'peso' => 0,   'descricao' => "Suíte com cama de dossel, banho quente, criado privativo e refeições nobres. Padrão para audiências aristocráticas ou aventureiros ricos."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Refeições (por dia, pobre)',     'preco' => '1 PP',   'peso' => 0,   'descricao' => "3 refeições simples ao dia: pão preto, mingau, ensopado sem gorduras. Suficiente para sobreviver."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Refeições (por dia, comum)',     'preco' => '3 PP',   'peso' => 0,   'descricao' => "3 refeições balanceadas: pão fresco, carne de galinha ou peixe, legumes, cerveja."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Refeições (por dia, boa)',       'preco' => '5 PP',   'peso' => 0,   'descricao' => "3 refeições fartas com carnes finas, vinho e sobremesas simples."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Carne (chunk)',                  'preco' => '3 PP',   'peso' => 0.25, 'descricao' => "Pedaço de carne curada ou defumada. Boa fonte proteica para viagens curtas."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Ração de Viagem (dia)',          'preco' => '5 PP',   'peso' => 0.5, 'descricao' => "Ração seca compacta: pão duro, carne seca, frutas cristalizadas. Sustenta 1 pessoa por 1 dia. Dura semanas sem estragar."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Vinho (comum, jarra)',           'preco' => '2 PP',   'peso' => 3,   'descricao' => "Jarra de vinho tinto ou branco de qualidade taverneira. Aproximadamente 1 litro."],
            ['categoria' => 'Comida, bebida e hospedagem', 'nome' => 'Vinho (fino, garrafa)',          'preco' => '10 PO',  'peso' => 0.75, 'descricao' => "Garrafa de vinho maduro de vinhedo prestigiado. Adequado para audiências ou presentes diplomáticos."],

            // ============ MONTARIAS E EQUIPAMENTOS RELACIONADOS ============
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Cavalo Pesado',              'preco' => '200 PO', 'peso' => 0, 'descricao' => "Cavalo grande de carga ou combate. Suporta armadura pesada e cavaleiro em plena guerra. Deslocamento 15 m."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Cavalo Leve',                'preco' => '75 PO',  'peso' => 0, 'descricao' => "Cavalo ágil para viagens e reconhecimento. Deslocamento 18 m — mais rápido que o pesado mas suporta menos carga."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Cavalo de Guerra Pesado',    'preco' => '400 PO', 'peso' => 0, 'descricao' => "Cavalo treinado para batalha, sabe lutar simultaneamente com o cavaleiro (Cavalgar CD 10 para combate montado). O padrão de paladinos."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Cavalo de Guerra Leve',      'preco' => '150 PO', 'peso' => 0, 'descricao' => "Cavalo mais ágil treinado para combate. Uso comum entre patrulheiros montados."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Pônei',                      'preco' => '30 PO',  'peso' => 0, 'descricao' => "Cavalo pequeno adequado para halflings e gnomos. Deslocamento 12 m. Custo baixo."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Pônei de Guerra',            'preco' => '100 PO', 'peso' => 0, 'descricao' => "Pônei treinado para batalha. Adequado para batedores halfling e gnomos guerreiros."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Burro ou Mula',              'preco' => '8 PO',   'peso' => 0, 'descricao' => "Animal de carga simples. Suporta 200 kg. Ideal para caravanas de mercadores e aventureiros pobres. Não serve como montaria de combate."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Cachorro de Guarda',         'preco' => '25 PO',  'peso' => 0, 'descricao' => "Cachorro treinado para vigília. Late em intrusos até 30 m. Ataca sob comando. Útil para acampamentos."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Sela (comum)',               'preco' => '10 PO',  'peso' => 12.5, 'descricao' => "Sela padrão para uso diário. Necessária para cavalgar sem penalidade -5. Adequada para viagens comuns."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Sela (militar)',             'preco' => '20 PO',  'peso' => 15, 'descricao' => "Sela reforçada com apoios laterais. Concede +2 em Cavalgar para permanecer selado após dano. Padrão para paladinos e cavaleiros."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Sela (exótica)',             'preco' => '60 PO',  'peso' => 20, 'descricao' => "Sela especial para montarias incomuns (grifos, hipogrifos, dragões pequenos). Permite cavalgar montaria voadora com Cavalgar."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Sela de Carga',              'preco' => '5 PO',   'peso' => 7.5, 'descricao' => "Sela simples para animais de carga (burros, mulas). Distribui peso para não ferir o animal."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Alforje',                    'preco' => '4 PO',   'peso' => 4, 'descricao' => "Bolsas duplas presas à sela. Capacidade 20 kg por lado."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Freio e Rédeas',             'preco' => '2 PO',   'peso' => 0.5, 'descricao' => "Equipamento básico para dirigir a montaria. Necessário para todas as montarias treinadas."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Ração para Animal (dia)',    'preco' => '5 PC',   'peso' => 5, 'descricao' => "Feno, aveia e grãos para 1 dia de cavalo. Cavalos precisam alimentar-se diariamente ou perdem deslocamento por fadiga."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Estábulo (por dia)',         'preco' => '5 PP',   'peso' => 0, 'descricao' => "Aluguel de baia coberta, ração e cuidados para uma montaria em taverna ou cidade."],
            ['categoria' => 'Montarias e equipamentos relacionados', 'nome' => 'Barda Leve (montaria)',      'preco' => '2×armadura', 'peso' => 0, 'descricao' => "Armadura para cavalo. Custo é o dobro da armadura equivalente para humano; peso é o dobro. Suporta cavalos de guerra em batalhas contra magia ou lâminas."],

            // ============ TRANSPORTE ============
            ['categoria' => 'Transporte', 'nome' => 'Carroça (aberta)',          'preco' => '35 PO',  'peso' => 0, 'descricao' => "Veículo de duas ou quatro rodas puxado por animal. Suporta 500 kg. Comum para mercadores e caravanas."],
            ['categoria' => 'Transporte', 'nome' => 'Carruagem',                 'preco' => '100 PO', 'peso' => 0, 'descricao' => "Veículo fechado de quatro rodas com bancos internos. Necessita 2 cavalos. Adequado para viagens nobres."],
            ['categoria' => 'Transporte', 'nome' => 'Trenó',                     'preco' => '20 PO',  'peso' => 0, 'descricao' => "Veículo sem rodas para gelo e neve. Suporta 300 kg. Puxado por cachorros ou renas em terras árticas."],
            ['categoria' => 'Transporte', 'nome' => 'Vagão',                     'preco' => '35 PO',  'peso' => 0, 'descricao' => "Veículo de quatro rodas para carga pesada. Suporta 1000 kg. Requer 2 cavalos pesados ou mulas."],
            ['categoria' => 'Transporte', 'nome' => 'Barco a Remo',              'preco' => '50 PO',  'peso' => 0, 'descricao' => "Pequeno barco para 4 pessoas ou 2 pessoas + carga leve. Deslocamento 1,5 km/h à remo."],
            ['categoria' => 'Transporte', 'nome' => 'Barcaça Fluvial',           'preco' => '3000 PO','peso' => 0, 'descricao' => "Grande embarcação para rios e lagos. Transporta mercadorias e passageiros. Deslocamento 5 km/h."],
            ['categoria' => 'Transporte', 'nome' => 'Barco Vela',                'preco' => '10000 PO','peso' => 0, 'descricao' => "Navio médio de comércio marítimo. Tripulação de 20. Custo proibitivo — investimento de guilda ou aristocracia."],
            ['categoria' => 'Transporte', 'nome' => 'Navio de Guerra',           'preco' => '25000 PO','peso' => 0, 'descricao' => "Galé militar de grande porte. Tripulação de 60. Adequado apenas para reinos e guildas poderosas."],
            ['categoria' => 'Transporte', 'nome' => 'Passagem (por km, terra)',  'preco' => '1 PC',   'peso' => 0, 'descricao' => "Custo aproximado de passagem em caravana comercial por quilômetro em terra."],
            ['categoria' => 'Transporte', 'nome' => 'Passagem (por km, mar)',    'preco' => '1 PP',   'peso' => 0, 'descricao' => "Custo aproximado de passagem em navio mercante por quilômetro marítimo."],
            ['categoria' => 'Transporte', 'nome' => 'Pedágio (portão)',          'preco' => '1 PC',   'peso' => 0, 'descricao' => "Taxa de passagem em portão de cidade fortificada. Comum em cidades-Estado protegidas."],

            // ============ CONJURAÇÃO E SERVIÇOS ============
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (nível 0)',                       'preco' => '5 PP',   'peso' => 0, 'descricao' => "Truque conjurado por conjurador contratado (Luz, Detectar Magia, Prestidigitação). Preço: 5 PP × nível do conjurador. Comum em cidades com templos ou magos itinerantes."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (1° círculo)',                    'preco' => '10 PO',  'peso' => 0, 'descricao' => "Magia de 1° círculo (Curar Ferimentos Leves, Escudo, Sono). Preço: 10 PO × nível do conjurador × 1. Componentes materiais caros cobrados à parte."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (2° círculo)',                    'preco' => '30 PO',  'peso' => 0, 'descricao' => "Magia de 2° círculo (Curar Moderados, Invisibilidade, Silêncio). Preço: 30 PO × nível do conjurador × 2."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (3° círculo)',                    'preco' => '150 PO', 'peso' => 0, 'descricao' => "Magia de 3° círculo (Bola de Fogo, Voar, Rapidez, Curar Sérios). Preço: 150 PO × nível × 3."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (4° círculo)',                    'preco' => '700 PO', 'peso' => 0, 'descricao' => "Magia de 4° círculo (Cura Ferimentos Críticos, Neutralizar Veneno)."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Magia (5° círculo)',                    'preco' => '1500 PO','peso' => 0, 'descricao' => "Magia de 5° círculo (Ressuscitar, Dominar Pessoa)."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Serviço Especializado (semana)',         'preco' => '3 PO',   'peso' => 0, 'descricao' => "Serviço de artesão treinado por semana (ferreiro, alquimista, joalheiro). Padrão para consertos e trabalhos personalizados."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Servo Comum (dia)',                     'preco' => '1 PP',   'peso' => 0, 'descricao' => "Ajudante sem treinamento por dia. Adequado para tarefas simples (carregar, guardar acampamento)."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Mensageiro',                            'preco' => '2 PC/km','peso' => 0, 'descricao' => "Mensageiro humano correndo com carta entre cidades. Preço por quilômetro."],
            ['categoria' => 'Conjuração e serviços', 'nome' => 'Aluguel de Casa (mês)',                 'preco' => '10 PO',  'peso' => 0, 'descricao' => "Aluguel mensal de casa simples em cidade média. Padrão para aventureiros estabelecendo base."],
        ];

        foreach ($equipamentos as $equip) {
            Equipamento::create($equip);
        }
    }
}
