<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha — {{ $ficha->nome_personagem }}</title>
    <style>
        @page { margin: 9mm 9mm 9mm 9mm; }
        * { box-sizing: border-box; }
        body {
            font-family: 'DejaVu Serif', serif;
            font-size: 8.5pt;
            color: #2a2118;
            margin: 0;
            background: #fbf7ec;
        }
        h1, h2, h3, h4 { margin: 0; padding: 0; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 2px 4px; vertical-align: top; }

        .banner {
            background: #1e2a3d;
            color: #f5e6b8;
            padding: 7px 12px;
            margin-bottom: 5px;
            border: 1px solid #8a6b1a;
            border-left: 4px solid #8a6b1a;
            border-right: 4px solid #8a6b1a;
        }
        .banner h1 {
            font-size: 19pt;
            letter-spacing: 4px;
            font-variant: small-caps;
            font-family: 'DejaVu Serif', serif;
        }
        .banner .subtitle {
            font-size: 8.5pt;
            margin-top: 2px;
            letter-spacing: 2px;
            color: #d9c78a;
            font-variant: small-caps;
        }

        .section {
            border: 0.6px solid #8a6b1a;
            background: #fbf7ec;
            margin-bottom: 4px;
        }
        .section-title {
            background: #1e2a3d;
            color: #f5e6b8;
            font-size: 7.5pt;
            font-weight: bold;
            padding: 2px 7px;
            letter-spacing: 2px;
            font-variant: small-caps;
            border-bottom: 1px solid #8a6b1a;
        }
        .section-body { padding: 5px 6px; }

        .kv td.k {
            width: 22%;
            color: #1e2a3d;
            font-weight: bold;
            font-size: 6.8pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kv td.v {
            border-bottom: 0.4px dotted #b8a672;
            font-size: 8pt;
        }

        .attr-grid td {
            border: 0.6px solid #8a6b1a;
            text-align: center;
            padding: 3px 2px;
            width: 16.6%;
        }
        .attr-grid .attr-name {
            background: #1e2a3d;
            color: #f5e6b8;
            font-weight: bold;
            font-size: 7.5pt;
            letter-spacing: 1.5px;
        }
        .attr-grid .attr-score {
            font-size: 14pt;
            font-weight: bold;
            padding: 2px 0;
            background: #fbf7ec;
        }
        .attr-grid .attr-mod {
            font-size: 10pt;
            color: #8a6b1a;
            font-weight: bold;
            background: #f2ead2;
        }

        .vitals td {
            width: 25%;
            text-align: center;
            border: 0.6px solid #8a6b1a;
            padding: 4px 2px;
        }
        .vitals .vital-label {
            background: #1e2a3d;
            color: #f5e6b8;
            font-size: 7pt;
            letter-spacing: 1.5px;
            font-variant: small-caps;
        }
        .vitals .vital-value {
            font-size: 14pt;
            font-weight: bold;
            color: #2a2118;
        }

        .breakdown {
            width: 100%;
            font-size: 6.5pt;
            margin-top: 3px;
        }
        .breakdown td { border: 0.4px solid #b8a672; text-align: center; padding: 1px; }
        .breakdown .lbl { background: #f2ead2; color: #1e2a3d; font-weight: bold; font-variant: small-caps; letter-spacing: 0.5px; }

        .ca-derived td {
            border: 0.5px solid #8a6b1a;
            padding: 3px 4px;
            text-align: center;
        }
        .ca-derived .lbl {
            background: #f2ead2;
            font-size: 6.8pt;
            font-variant: small-caps;
            letter-spacing: 1px;
            color: #1e2a3d;
            font-weight: bold;
        }
        .ca-derived .val { font-size: 11pt; font-weight: bold; }

        .saves th, .saves td { border: 0.5px solid #8a6b1a; padding: 2px 3px; text-align: center; font-size: 7.5pt; }
        .saves th { background: #1e2a3d; color: #f5e6b8; font-variant: small-caps; letter-spacing: 1px; }
        .saves .save-total { font-size: 10pt; font-weight: bold; background: #f2ead2; color: #8a6b1a; }

        .combat-line { display: table; width: 100%; border-collapse: collapse; margin-bottom: 2px; }
        .combat-line > .cell { display: table-cell; border: 0.5px solid #8a6b1a; padding: 2px 4px; text-align: center; font-size: 7.5pt; }
        .combat-line .cell.lbl { background: #1e2a3d; color: #f5e6b8; font-variant: small-caps; letter-spacing: 1px; font-weight: bold; width: 22%; text-align: left; padding-left: 8px; }
        .combat-line .cell.tot { font-size: 10pt; font-weight: bold; width: 11.3%; background: #f2ead2; color: #8a6b1a; }

        .items th, .items td { border: 0.5px solid #8a6b1a; padding: 2px 4px; font-size: 7.5pt; }
        .items th { background: #1e2a3d; color: #f5e6b8; font-variant: small-caps; letter-spacing: 1px; }
        .items tr:nth-child(even) td { background: #f9f2df; }

        .skills th, .skills td { border: 0.4px solid #8a6b1a; padding: 1.6px 3px; font-size: 7pt; }
        .skills th { background: #1e2a3d; color: #f5e6b8; font-variant: small-caps; letter-spacing: 1px; }
        .skills td.num { text-align: center; }
        .skills td.total { font-weight: bold; color: #8a6b1a; background: #f2ead2; }
        .skills tr:nth-child(even) td { background: #f9f2df; }
        .skills tr:nth-child(even) td.total { background: #eee1b8; }

        .spell-level {
            border: 0.4px solid #8a6b1a;
            padding: 3px 5px;
            margin-bottom: 2px;
            background: #fbf7ec;
        }
        .spell-level .lv {
            background: #4a2966;
            color: #f5e6b8;
            padding: 1px 6px;
            font-variant: small-caps;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 7.5pt;
            display: inline-block;
            margin-right: 4px;
        }
        .spell-level .count {
            font-size: 6.5pt;
            color: #6b5a3d;
            font-style: italic;
        }
        .spell-level .list {
            font-size: 7pt;
            margin-top: 2px;
            line-height: 1.3;
        }

        .money-row td { border: 0.6px solid #8a6b1a; text-align: center; width: 33.3%; padding: 4px; }
        .money-row .coin-label { background: #f2ead2; font-size: 7pt; font-variant: small-caps; letter-spacing: 1px; color: #1e2a3d; font-weight: bold; }
        .money-row .coin-value { font-size: 12pt; font-weight: bold; color: #8a6b1a; }

        .load-row td { border: 0.5px solid #8a6b1a; text-align: center; padding: 3px; font-size: 7.5pt; }
        .load-row .load-label { background: #1e2a3d; color: #f5e6b8; font-variant: small-caps; letter-spacing: 1px; }
        .load-row .load-val { font-weight: bold; color: #8a6b1a; }

        .prose {
            font-size: 7.5pt;
            line-height: 1.35;
            white-space: pre-wrap;
        }

        .card-talent {
            border-left: 3px solid #8a6b1a;
            padding: 2px 6px;
            margin-bottom: 3px;
            background: #f9f2df;
        }
        .card-talent .name {
            color: #1e2a3d;
            font-weight: bold;
            font-size: 8pt;
        }
        .card-talent .tipo {
            font-size: 6.5pt;
            color: #8a6b1a;
            font-style: italic;
            font-variant: small-caps;
            letter-spacing: 0.5px;
        }
        .card-talent .benef {
            font-size: 7pt;
            margin-top: 1px;
            line-height: 1.25;
        }

        .card-deity {
            background: #f2ead2;
            border: 0.5px solid #8a6b1a;
            padding: 5px 7px;
        }
        .card-deity .deity-name {
            color: #1e2a3d;
            font-weight: bold;
            font-size: 10pt;
            font-variant: small-caps;
            letter-spacing: 1px;
        }
        .card-deity .deity-note {
            font-size: 7pt;
            font-style: italic;
            color: #6b5a3d;
        }

        .page-break { page-break-before: always; }
        .small { font-size: 7pt; }
        .muted { color: #6b5a3d; font-style: italic; }
        .center { text-align: center; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        .gold { color: #8a6b1a; }
        .ink { color: #1e2a3d; }
        .h-fill { height: 100%; }
    </style>
</head>
<body>

<div class="banner">
    <h1>{{ $ficha->nome_personagem ?: '—' }}</h1>
    <div class="subtitle">
        {{ optional($ficha->classe)->nome ?: '—' }}
        &nbsp;Nível {{ $ficha->nivel }}
        &nbsp;·&nbsp;
        {{ optional($ficha->raca)->nome ?: '—' }}
        &nbsp;·&nbsp;
        {{ optional($ficha->tendencia)->nome ?: '—' }}
        @if($ficha->divindade)
            &nbsp;·&nbsp; Devoto(a) de {{ $ficha->divindade }}
        @endif
    </div>
</div>

<table cellspacing="0" cellpadding="0"><tr>
<td style="width: 61%; padding-right: 4px;">

    <div class="section">
        <div class="section-title">Identidade</div>
        <div class="section-body">
            <table class="kv">
                <tr>
                    <td class="k">Jogador</td><td class="v">{{ $ficha->nome_jogador ?: '—' }}</td>
                    <td class="k">Tamanho</td><td class="v">{{ $ficha->tamanho ?: '—' }}</td>
                </tr>
                <tr>
                    <td class="k">Idade</td><td class="v">{{ $ficha->idade ?: '—' }}</td>
                    <td class="k">Sexo</td><td class="v">{{ $ficha->sexo ?: '—' }}</td>
                </tr>
                <tr>
                    <td class="k">Altura</td><td class="v">{{ $ficha->altura ? $ficha->altura . ' m' : '—' }}</td>
                    <td class="k">Peso</td><td class="v">{{ $ficha->peso ? $ficha->peso . ' kg' : '—' }}</td>
                </tr>
                <tr>
                    <td class="k">Olhos</td><td class="v">{{ $ficha->olhos ?: '—' }}</td>
                    <td class="k">Cabelos</td><td class="v">{{ $ficha->cabelos ?: '—' }}</td>
                </tr>
                <tr>
                    <td class="k">Pele</td><td class="v">{{ $ficha->pele ?: '—' }}</td>
                    <td class="k">Deslocamento</td><td class="v">{{ $ficha->deslocamento ?: '—' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Atributos</div>
        <div class="section-body">
            <table class="attr-grid" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="attr-name">FOR</td>
                    <td class="attr-name">DES</td>
                    <td class="attr-name">CON</td>
                    <td class="attr-name">INT</td>
                    <td class="attr-name">SAB</td>
                    <td class="attr-name">CAR</td>
                </tr>
                <tr>
                    <td class="attr-score">{{ $ficha->forca_base }}</td>
                    <td class="attr-score">{{ $ficha->destreza_base }}</td>
                    <td class="attr-score">{{ $ficha->constituicao_base }}</td>
                    <td class="attr-score">{{ $ficha->inteligencia_base }}</td>
                    <td class="attr-score">{{ $ficha->sabedoria_base }}</td>
                    <td class="attr-score">{{ $ficha->carisma_base }}</td>
                </tr>
                <tr>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['forca']) }}</td>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['destreza']) }}</td>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['constituicao']) }}</td>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['inteligencia']) }}</td>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['sabedoria']) }}</td>
                    <td class="attr-mod">{{ sprintf('%+d', $mods['carisma']) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Testes de Resistência</div>
        <div class="section-body">
            <table class="saves" cellspacing="0" cellpadding="0">
                <tr>
                    <th style="width: 22%;">Teste</th>
                    <th>Total</th>
                    <th>Base</th>
                    <th>Hab.</th>
                    <th>Mág.</th>
                    <th>Diverso</th>
                </tr>
                @foreach(['fortitude' => 'Fortitude', 'reflexos' => 'Reflexos', 'vontade' => 'Vontade'] as $k => $label)
                    <tr>
                        <td style="text-align: left; font-weight: bold; color: #1e2a3d;">{{ $label }}</td>
                        <td class="save-total">{{ sprintf('%+d', $saves[$k]['total']) }}</td>
                        <td>{{ sprintf('%+d', $saves[$k]['base']) }}</td>
                        <td>{{ sprintf('%+d', $saves[$k]['hab']) }}</td>
                        <td>{{ sprintf('%+d', $saves[$k]['magia']) }}</td>
                        <td>{{ sprintf('%+d', $saves[$k]['misc']) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Combate</div>
        <div class="section-body">
            <div class="combat-line">
                <div class="cell lbl">BAB</div>
                <div class="cell tot">{{ sprintf('%+d', $ficha->bab) }}</div>
                <div class="cell lbl">Iniciativa</div>
                <div class="cell tot">{{ sprintf('%+d', $iniciativa) }}</div>
                <div class="cell lbl">Agarrar</div>
                <div class="cell tot">{{ sprintf('%+d', $agarrar) }}</div>
            </div>
            <div class="combat-line">
                <div class="cell lbl">Corpo a Corpo</div>
                <div class="cell tot">{{ sprintf('%+d', $atkCorpo) }}</div>
                <div class="cell lbl">Distância</div>
                <div class="cell tot">{{ sprintf('%+d', $atkDist) }}</div>
                <div class="cell lbl">Desloc.</div>
                <div class="cell tot" style="font-size: 8pt;">{{ $ficha->deslocamento ?: '—' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Armas &amp; Ataques</div>
        <div class="section-body">
            @if($ficha->armas->isEmpty())
                <div class="muted small">Nenhuma arma registrada.</div>
            @else
                <table class="items" cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="text-align:left;">Nome</th>
                        <th>Dano (M)</th>
                        <th>Crítico</th>
                        <th>Alcance</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Peso</th>
                    </tr>
                    @foreach($ficha->armas as $a)
                        <tr>
                            <td style="text-align:left;">
                                <span class="bold ink">{{ $a->nome }}</span>@if(($a->pivot->quantidade ?? 1) > 1)
                                    <span class="muted small"> ×{{ $a->pivot->quantidade }}</span>
                                @endif
                            </td>
                            <td class="center">{{ $a->dano_m ?: $a->dano_p ?: '—' }}</td>
                            <td class="center">{{ $a->critico ?: '—' }}</td>
                            <td class="center">{{ $a->alcance ?: '—' }}</td>
                            <td class="center">{{ $a->tipo ?: '—' }}</td>
                            <td class="center">{{ $a->categoria ?: '—' }}</td>
                            <td class="center">{{ $a->peso ? $a->peso . 'kg' : '—' }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    @if($ficha->notas_combate)
    <div class="section">
        <div class="section-title">Notas de Combate</div>
        <div class="section-body prose">{{ mb_substr($ficha->notas_combate, 0, 800) }}{{ mb_strlen($ficha->notas_combate) > 800 ? '…' : '' }}</div>
    </div>
    @endif

</td>
<td style="width: 39%;">

    <div class="section">
        <div class="section-title">Sinais Vitais</div>
        <div class="section-body">
            <table class="vitals" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="vital-label">PV Máx.</td>
                    <td class="vital-label">PV Atual</td>
                    <td class="vital-label">CA Total</td>
                    <td class="vital-label">XP</td>
                </tr>
                <tr>
                    <td class="vital-value">{{ $ficha->pv_max }}</td>
                    <td class="vital-value">{{ $ficha->pv_atual }}</td>
                    <td class="vital-value">{{ $caTotal }}</td>
                    <td class="vital-value" style="font-size: 9pt;">{{ number_format((int) $ficha->xp_atual, 0, ',', '.') }}</td>
                </tr>
            </table>

            <table class="ca-derived" cellspacing="0" cellpadding="0" style="margin-top: 4px;">
                <tr>
                    <td class="lbl">CA Toque</td>
                    <td class="val">{{ $caToque }}</td>
                    <td class="lbl">CA Surpreso</td>
                    <td class="val">{{ $caSurpreso }}</td>
                </tr>
            </table>

            <table class="breakdown" cellspacing="0" cellpadding="0" style="margin-top: 3px;">
                <tr>
                    <td class="lbl">Armad.</td>
                    <td class="lbl">Escudo</td>
                    <td class="lbl">Des</td>
                    <td class="lbl">Tam</td>
                    <td class="lbl">Nat.</td>
                    <td class="lbl">Defl.</td>
                    <td class="lbl">Div.</td>
                </tr>
                <tr>
                    <td>{{ sprintf('%+d', $ficha->ca_armadura) }}</td>
                    <td>{{ sprintf('%+d', $ficha->ca_escudo) }}</td>
                    <td>{{ sprintf('%+d', $mods['destreza']) }}</td>
                    <td>{{ sprintf('%+d', $ficha->ca_tamanho) }}</td>
                    <td>{{ sprintf('%+d', $ficha->ca_natural) }}</td>
                    <td>{{ sprintf('%+d', $ficha->ca_deflexao) }}</td>
                    <td>{{ sprintf('%+d', $ficha->ca_misc) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Armaduras &amp; Escudo</div>
        <div class="section-body">
            @if($ficha->armaduras->isEmpty())
                <div class="muted small">Sem proteções vestidas.</div>
            @else
                <table class="items" cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="text-align:left;">Nome</th>
                        <th>Bônus</th>
                        <th>Máx Des</th>
                        <th>Penal.</th>
                        <th>Falha</th>
                        <th>Peso</th>
                    </tr>
                    @foreach($ficha->armaduras as $a)
                        <tr>
                            <td style="text-align:left;"><span class="bold ink">{{ $a->nome }}</span></td>
                            <td class="center">{{ sprintf('%+d', (int) $a->bonus_ca) }}</td>
                            <td class="center">{{ is_null($a->destreza_max) ? '—' : $a->destreza_max }}</td>
                            <td class="center">{{ (int) $a->penalidade_armadura }}</td>
                            <td class="center">{{ is_null($a->falha_arcana) ? '—' : $a->falha_arcana . '%' }}</td>
                            <td class="center">{{ $a->peso ? $a->peso . 'kg' : '—' }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    @if($ficha->divindade)
    <div class="section">
        <div class="section-title">Devoção</div>
        <div class="section-body">
            <div class="card-deity">
                <div class="deity-name">{{ $ficha->divindade }}</div>
                <div class="deity-note">Sob a tutela desta divindade, {{ $ficha->nome_personagem ?: 'este herói' }} caminha por Faerûn.</div>
            </div>
        </div>
    </div>
    @endif

    <div class="section">
        <div class="section-title">Idiomas Conhecidos</div>
        <div class="section-body prose">{{ $ficha->idiomas ?: 'Comum' }}</div>
    </div>

    <div class="section">
        <div class="section-title">Aparência</div>
        <div class="section-body prose">@php
            $aparencia = collect([
                $ficha->tamanho ? 'Estatura ' . strtolower($ficha->tamanho) : null,
                $ficha->altura ? $ficha->altura . 'm de altura' : null,
                $ficha->peso ? $ficha->peso . 'kg' : null,
                $ficha->olhos ? 'olhos ' . strtolower($ficha->olhos) : null,
                $ficha->cabelos ? 'cabelos ' . strtolower($ficha->cabelos) : null,
                $ficha->pele ? 'pele ' . strtolower($ficha->pele) : null,
            ])->filter()->implode(', ');
        @endphp{{ $aparencia ? ucfirst($aparencia) . '.' : 'Sem descrição registrada.' }}</div>
    </div>

</td></tr></table>

<div class="page-break"></div>

<div class="banner">
    <h1 style="font-size: 13pt;">Perícias · Talentos · Grimório · Tesouros</h1>
</div>

<table cellspacing="0" cellpadding="0"><tr>
<td style="width: 54%; padding-right: 4px;">

    <div class="section">
        <div class="section-title">Perícias ({{ $pericias->count() }})</div>
        <div class="section-body">
            @if($pericias->isEmpty())
                <div class="muted small">Nenhuma perícia com graduações.</div>
            @else
                <table class="skills" cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="text-align:left;">Perícia</th>
                        <th>Hab.</th>
                        <th>Total</th>
                        <th>Grad.</th>
                        <th>Mod.</th>
                    </tr>
                    @foreach($pericias as $p)
                        <tr>
                            <td>{{ $p['nome'] }}</td>
                            <td class="num">{{ $p['chave'] ?: '—' }}</td>
                            <td class="num total">{{ sprintf('%+d', $p['total']) }}</td>
                            <td class="num">{{ rtrim(rtrim(number_format($p['grad'], 1, ',', ''), '0'), ',') ?: '0' }}</td>
                            <td class="num">{{ sprintf('%+d', $p['mod']) }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Talentos ({{ $ficha->talentos->count() }})</div>
        <div class="section-body">
            @if($ficha->talentos->isEmpty())
                <div class="muted small">Sem talentos adquiridos.</div>
            @else
                @foreach($ficha->talentos as $t)
                    <div class="card-talent">
                        <span class="name">{{ $t->nome }}</span>
                        @if($t->tipo)
                            <span class="tipo"> · {{ $t->tipo }}</span>
                        @endif
                        @if($t->beneficio)
                            <div class="benef">{{ mb_substr($t->beneficio, 0, 400) }}{{ mb_strlen($t->beneficio) > 400 ? '…' : '' }}</div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    @if($ficha->habilidades_especiais)
    <div class="section">
        <div class="section-title">Habilidades Especiais</div>
        <div class="section-body prose">{{ mb_substr($ficha->habilidades_especiais, 0, 1500) }}{{ mb_strlen($ficha->habilidades_especiais) > 1500 ? '…' : '' }}</div>
    </div>
    @endif

</td>
<td style="width: 46%;">

    <div class="section">
        <div class="section-title">Grimório de Magias</div>
        <div class="section-body">
            @php $totalMagias = collect($magiasPorNivel)->sum(fn($c) => $c->count()); @endphp
            @if($totalMagias === 0)
                <div class="muted small">Sem magias conhecidas.</div>
            @else
                @foreach($magiasPorNivel as $nivel => $magias)
                    @if($magias->isNotEmpty())
                        <div class="spell-level">
                            <span class="lv">Nível {{ $nivel }}</span>
                            <span class="count">({{ $magias->count() }} {{ $magias->count() === 1 ? 'magia' : 'magias' }})</span>
                            <div class="list">
                                @foreach($magias as $m)
                                    <span>{{ $m->nome }}@if($m->escola) <span class="muted">({{ substr($m->escola, 0, 3) }})</span>@endif@if(!$loop->last) &middot; @endif</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="small muted center" style="margin-top: 4px;">
                    Total de {{ $totalMagias }} {{ $totalMagias === 1 ? 'magia registrada' : 'magias registradas' }}.
                </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Equipamentos ({{ $ficha->equipamentos->count() }})</div>
        <div class="section-body">
            @if($ficha->equipamentos->isEmpty())
                <div class="muted small">Sem equipamentos registrados.</div>
            @else
                <table class="skills" cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="text-align:left;">Item</th>
                        <th>Categoria</th>
                        <th>Qtd</th>
                        <th>Peso</th>
                    </tr>
                    @foreach($ficha->equipamentos as $e)
                        <tr>
                            <td>{{ $e->nome }}</td>
                            <td class="num">{{ $e->categoria ?: '—' }}</td>
                            <td class="num">{{ $e->pivot->quantidade ?? 1 }}</td>
                            <td class="num">{{ $e->peso ? $e->peso . 'kg' : '—' }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Bolsa &amp; Riqueza</div>
        <div class="section-body">
            <table class="money-row" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="coin-label">Peças de Cobre</td>
                    <td class="coin-label">Peças de Prata</td>
                    <td class="coin-label">Peças de Ouro</td>
                </tr>
                <tr>
                    <td class="coin-value">{{ (int) $ficha->dinheiro_pc }}</td>
                    <td class="coin-value">{{ (int) $ficha->dinheiro_pp }}</td>
                    <td class="coin-value">{{ (int) $ficha->dinheiro_pl }}</td>
                </tr>
            </table>
            @if($ficha->ouro)
                <div class="small center" style="margin-top: 3px;">
                    <span class="muted">Ouro em bolsa:</span> <span class="bold gold">{{ number_format((float) $ficha->ouro, 2, ',', '.') }} PO</span>
                </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Capacidade de Carga (kg)</div>
        <div class="section-body">
            <table class="load-row" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="load-label">Leve</td>
                    <td class="load-label">Média</td>
                    <td class="load-label">Pesada</td>
                </tr>
                <tr>
                    <td class="load-val">{{ $cargas['leve'] }}</td>
                    <td class="load-val">{{ $cargas['media'] }}</td>
                    <td class="load-val">{{ $cargas['pesada'] }}</td>
                </tr>
                <tr>
                    <td class="load-label">Levantar</td>
                    <td class="load-label">Do Chão</td>
                    <td class="load-label">Arrastar</td>
                </tr>
                <tr>
                    <td class="load-val">{{ $cargas['levantarCabeca'] }}</td>
                    <td class="load-val">{{ $cargas['levantarSolo'] }}</td>
                    <td class="load-val">{{ $cargas['arrastar'] }}</td>
                </tr>
            </table>
            <div class="small center" style="margin-top: 3px;">
                <span class="muted">Peso equipado:</span> <span class="bold gold">{{ number_format($pesoTotal, 1, ',', '.') }} kg</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Jornada de Experiência</div>
        <div class="section-body">
            <table class="skills" cellspacing="0" cellpadding="0">
                <tr>
                    <th>XP Atual</th>
                    <th>Próximo Nível</th>
                    <th>Faltam</th>
                </tr>
                <tr>
                    <td class="num total">{{ number_format((int) $ficha->xp_atual, 0, ',', '.') }}</td>
                    <td class="num">{{ number_format((int) $ficha->xp_proximo, 0, ',', '.') }}</td>
                    <td class="num">{{ number_format(max(0, (int) $ficha->xp_proximo - (int) $ficha->xp_atual), 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

</td></tr></table>

<div style="text-align: center; font-size: 6.5pt; color: #6b5a3d; margin-top: 6px; letter-spacing: 2px; font-variant: small-caps;">
    Forjada no Salão dos Heróis &nbsp;·&nbsp; Forja de Almas
</div>

</body>
</html>
