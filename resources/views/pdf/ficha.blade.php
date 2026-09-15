<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Ficha — {{ $ficha->nome_personagem }}</title>
<style>
@page { margin: 6mm; size: A4 portrait; }
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'DejaVu Sans', sans-serif; font-size: 7pt; color: #000; background: #fff; }
table { border-collapse: collapse; width: 100%; }
td, th { vertical-align: top; padding: 0; }
.page-break { page-break-before: always; }

/* Header sections — black background white text */
.sec {
    background: #000;
    color: #fff;
    font-weight: bold;
    font-size: 6pt;
    text-transform: uppercase;
    padding: 1px 3px;
    letter-spacing: 0.3px;
}
/* Tiny labels above fields */
.lbl {
    font-size: 4.5pt;
    font-weight: bold;
    text-transform: uppercase;
    display: block;
    letter-spacing: 0.2px;
    line-height: 1.2;
}
/* Field with underline for manual fill */
.field {
    border-bottom: 0.5pt solid #000;
    min-height: 9pt;
    display: block;
}
/* Standard data cell border */
.brd { border: 0.7pt solid #000; }
/* Large values */
.val-lg { font-size: 12pt; font-weight: bold; text-align: center; }
/* Medium values */
.val-md { font-size: 9pt; font-weight: bold; text-align: center; }
/* Normal table values */
.val { font-size: 7pt; text-align: center; }
/* Section inner padding */
.inner { padding: 1px 2px; }

/* ---- PAGE 1 TITLE BLOCK ---- */
.title-table td { border: 0.7pt solid #000; padding: 2px 3px; }
.char-name { font-size: 10pt; font-weight: bold; }
.dnd-brand { font-size: 9pt; font-weight: bold; text-align: right; font-variant: small-caps; letter-spacing: 1px; }
.ficha-label { font-size: 7pt; font-weight: bold; text-align: right; text-transform: uppercase; letter-spacing: 1px; }

/* ---- IDENTITY BAR ---- */
.id-bar td { border: 0.7pt solid #000; padding: 1px 3px; text-align: center; min-width: 20pt; }
.id-bar .id-val { font-size: 7pt; font-weight: bold; border-bottom: 0.5pt solid #000; min-height: 8pt; display: block; }

/* ---- ATTRIBUTES ---- */
.attr-hdr { background: #000; color: #fff; font-size: 5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px 2px; border: 0.7pt solid #000; }
.attr-name-cell { background: #000; color: #fff; text-align: center; border: 0.7pt solid #000; padding: 1px 2px; line-height: 1.2; }
.attr-abbr { font-size: 9pt; font-weight: bold; display: block; }
.attr-full { font-size: 4pt; display: block; }
.attr-val { border: 0.7pt solid #000; text-align: center; font-size: 12pt; font-weight: bold; padding: 2px; }
.attr-mod { border: 0.7pt solid #000; text-align: center; font-size: 8pt; font-weight: bold; padding: 1px; }
.attr-temp { border: 0.7pt solid #000; min-width: 18pt; padding: 1px; }

/* ---- COMBAT BLOCK ---- */
.combat-label { background: #000; color: #fff; font-size: 5pt; font-weight: bold; text-transform: uppercase; padding: 1px 3px; }

/* ---- SAVES ---- */
.saves-hdr { background: #000; color: #fff; font-size: 5pt; font-weight: bold; text-transform: uppercase; text-align: center; border: 0.7pt solid #000; padding: 1px 2px; }
.saves-row td { border: 0.7pt solid #000; text-align: center; padding: 1px 2px; font-size: 6.5pt; }
.saves-name { text-align: left !important; font-size: 6pt; font-weight: bold; }

/* ---- ATTACK BONUS ROWS ---- */
.atk-row td { border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; text-align: center; }
.atk-lbl { background: #000; color: #fff; font-weight: bold; text-transform: uppercase; font-size: 5pt; text-align: left !important; padding: 1px 3px !important; }
.atk-total { font-size: 9pt; font-weight: bold; }

/* ---- WEAPONS ---- */
.wpn-hdr td { background: #000; color: #fff; font-size: 5.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 3px; border: 0.7pt solid #000; }
.wpn-row td { border: 0.7pt solid #000; padding: 1px 2px; font-size: 6.5pt; }
.wpn-lbl-row td { border: 0.7pt solid #000; padding: 0px 2px; }

/* ---- ARMOR ---- */
.arm-row td { border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; }
.arm-lbl { font-size: 4.5pt; font-weight: bold; text-transform: uppercase; display: block; }
.arm-val { font-size: 7pt; font-weight: bold; display: block; border-bottom: 0.5pt solid #000; min-height: 9pt; }

/* ---- SKILLS ---- */
.sk-hdr td { background: #000; color: #fff; font-size: 5pt; font-weight: bold; text-transform: uppercase; text-align: center; border: 0.7pt solid #000; padding: 1px 1px; }
.sk-row td { border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; padding: 0px 1px; font-size: 6pt; vertical-align: middle; }
.sk-row-filled { background: #f0f0f0; }
.sk-name { text-align: left; }
.sk-center { text-align: center; }
.sk-underline { border-bottom: 0.4pt solid #000; min-height: 7pt; display: block; }

/* ---- PV BOX ---- */
.pv-box { border: 1pt solid #000; text-align: center; padding: 2px; margin: 1px; }
.pv-big { font-size: 14pt; font-weight: bold; }

/* ---- CA BLOCK ---- */
.ca-main { font-size: 14pt; font-weight: bold; }
.ca-eq { font-size: 7pt; font-weight: bold; }
.ca-comp td { border: 0.7pt solid #000; text-align: center; padding: 1px; }
.ca-comp .clbl { font-size: 4pt; font-weight: bold; text-transform: uppercase; display: block; }
.ca-comp .cval { font-size: 7pt; font-weight: bold; display: block; }

/* ---- XP ---- */
.xp-row td { border: 0.7pt solid #000; text-align: center; padding: 2px 3px; }

/* ---- TALENTS P2 ---- */
.tal-name { font-size: 7pt; font-weight: bold; }
.tal-tipo { font-size: 5.5pt; font-style: italic; }
.tal-benef { font-size: 6pt; line-height: 1.2; }
.tal-blank { border-bottom: 0.4pt solid #000; height: 9pt; }

/* ---- SPELLS P2 ---- */
.spell-row td { border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; }
.spell-lv { font-size: 5.5pt; font-weight: bold; text-transform: uppercase; display: block; }

/* ---- MONEY ---- */
.money-cell { border: 0.7pt solid #000; text-align: center; padding: 2px; }
.money-lbl { font-size: 4.5pt; font-weight: bold; text-transform: uppercase; display: block; }
.money-val { font-size: 10pt; font-weight: bold; display: block; }

/* ---- EQUIPMENT P2 ---- */
.eq-row td { border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; }
.eq-blank { border-bottom: 0.4pt solid #000; height: 8pt; }

/* Outer border around entire columns */
.col-border { border: 0.7pt solid #000; }
</style>
</head>
<body>

{{-- ===== PÁGINA 1 ===== --}}

{{-- TÍTULO --}}
<table class="title-table" cellspacing="0" style="margin-bottom: 2px;">
<tr>
    <td style="width: 42%;">
        <span class="lbl">Nome do Personagem</span>
        <span class="char-name">{{ $ficha->nome_personagem ?: '—' }}</span>
    </td>
    <td style="width: 33%;">
        <span class="lbl">Jogador</span>
        <span style="font-size: 8pt; font-weight: bold;">{{ $ficha->nome_jogador ?: '—' }}</span>
    </td>
    <td style="width: 25%; text-align: right; vertical-align: middle;">
        <span class="dnd-brand">Dungeons &amp; Dragons<sup style="font-size:5pt;">®</sup></span>
    </td>
</tr>
<tr>
    <td>
        <span class="lbl">Classe</span>
        <span style="font-size: 7.5pt; font-weight: bold;">{{ optional($ficha->classe)->nome ?: '—' }}</span>
    </td>
    <td>
        <span class="lbl">Raça / Tendência / Divindade</span>
        <span style="font-size: 7pt;">{{ optional($ficha->raca)->nome ?: '—' }} &nbsp;·&nbsp; {{ optional($ficha->tendencia)->nome ?: '—' }} &nbsp;·&nbsp; {{ $ficha->divindade ?: '—' }}</span>
    </td>
    <td style="text-align: right; vertical-align: bottom;">
        <span class="ficha-label">Ficha de Personagem</span>
    </td>
</tr>
</table>

{{-- BARRA DE IDENTIDADE --}}
<table class="id-bar" cellspacing="0" style="margin-bottom: 2px;">
<tr>
    <td style="width: 8%;">
        <span class="lbl">Nível</span>
        <span class="id-val">{{ $ficha->nivel }}</span>
    </td>
    <td style="width: 10%;">
        <span class="lbl">Tamanho</span>
        <span class="id-val">{{ $ficha->tamanho ?: '—' }}</span>
    </td>
    <td style="width: 8%;">
        <span class="lbl">Idade</span>
        <span class="id-val">{{ $ficha->idade ?: '—' }}</span>
    </td>
    <td style="width: 8%;">
        <span class="lbl">Sexo</span>
        <span class="id-val">{{ $ficha->sexo ?: '—' }}</span>
    </td>
    <td style="width: 12%;">
        <span class="lbl">Altura</span>
        <span class="id-val">{{ $ficha->altura ? $ficha->altura . ' m' : '—' }}</span>
    </td>
    <td style="width: 10%;">
        <span class="lbl">Peso</span>
        <span class="id-val">{{ $ficha->peso ? $ficha->peso . ' kg' : '—' }}</span>
    </td>
    <td style="width: 15%;">
        <span class="lbl">Olhos</span>
        <span class="id-val">{{ $ficha->olhos ?: '—' }}</span>
    </td>
    <td style="width: 15%;">
        <span class="lbl">Cabelo</span>
        <span class="id-val">{{ $ficha->cabelos ?: '—' }}</span>
    </td>
    <td style="width: 14%;">
        <span class="lbl">Pele</span>
        <span class="id-val">{{ $ficha->pele ?: '—' }}</span>
    </td>
</tr>
</table>

{{-- CORPO PRINCIPAL: coluna esq 60% / col dir 40% --}}
<table cellspacing="0" cellpadding="0" style="margin-bottom: 0;">
<tr>

{{-- ===== COLUNA ESQUERDA ===== --}}
<td style="width: 60%; padding-right: 2px; vertical-align: top;">

    {{-- LINHA SUPERIOR: ATRIBUTOS + COMBATE --}}
    <table cellspacing="0" cellpadding="0" style="margin-bottom: 2px;">
    <tr>

    {{-- ATRIBUTOS 38% --}}
    <td style="width: 38%; vertical-align: top; padding-right: 2px;">
        <table cellspacing="0" cellpadding="0">
        {{-- Cabeçalho de colunas --}}
        <tr>
            <td class="attr-hdr" style="width: 22%;">&nbsp;</td>
            <td class="attr-hdr" style="width: 18%;">Valor<br>Hab.</td>
            <td class="attr-hdr" style="width: 16%;">Mod.</td>
            <td class="attr-hdr" style="width: 22%;">Val.<br>Temp.</td>
            <td class="attr-hdr" style="width: 22%;">Mod.<br>Temp.</td>
        </tr>
        @php
        $atributos = [
            ['abbr' => 'FOR', 'nome' => 'Força',        'key' => 'forca'],
            ['abbr' => 'DES', 'nome' => 'Destreza',     'key' => 'destreza'],
            ['abbr' => 'CON', 'nome' => 'Constituição',  'key' => 'constituicao'],
            ['abbr' => 'INT', 'nome' => 'Inteligência',  'key' => 'inteligencia'],
            ['abbr' => 'SAB', 'nome' => 'Sabedoria',    'key' => 'sabedoria'],
            ['abbr' => 'CAR', 'nome' => 'Carisma',      'key' => 'carisma'],
        ];
        $campoAtrib = [
            'forca' => 'forca_base', 'destreza' => 'destreza_base',
            'constituicao' => 'constituicao_base', 'inteligencia' => 'inteligencia_base',
            'sabedoria' => 'sabedoria_base', 'carisma' => 'carisma_base',
        ];
        @endphp
        @foreach($atributos as $at)
        <tr style="border-bottom: 0.5pt solid #000;">
            <td class="attr-name-cell">
                <span class="attr-abbr">{{ $at['abbr'] }}</span>
                <span class="attr-full">{{ $at['nome'] }}</span>
            </td>
            <td class="attr-val">{{ (int) $ficha->{$campoAtrib[$at['key']]} }}</td>
            <td class="attr-mod">{{ sprintf('%+d', $mods[$at['key']]) }}</td>
            <td class="attr-temp">&nbsp;</td>
            <td class="attr-temp">&nbsp;</td>
        </tr>
        @endforeach
        </table>
    </td>

    {{-- COMBATE 62% --}}
    <td style="width: 62%; vertical-align: top;">
        <table cellspacing="0" cellpadding="0" style="width: 100%;">

        {{-- PV + Deslocamento --}}
        <tr>
            <td colspan="6" style="border: 0.7pt solid #000; padding: 1px 2px;">
                <table cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                    <td style="width: 38%; border-right: 0.5pt solid #000; padding: 1px 3px;">
                        <span class="lbl">Total — Pontos de Vida</span>
                        <table cellspacing="0" cellpadding="0"><tr>
                            <td style="background:#000; color:#fff; font-weight:bold; font-size:7pt; padding: 1px 3px; border: 0.7pt solid #000;">PV</td>
                            <td style="font-size:14pt; font-weight:bold; padding: 0 4px;">{{ $ficha->pv_max }}</td>
                        </tr></table>
                    </td>
                    <td style="width: 28%; border-right: 0.5pt solid #000; padding: 1px 3px;">
                        <span class="lbl">Dano / PV Atuais</span>
                        <span class="field">{{ $ficha->pv_atual }}</span>
                    </td>
                    <td style="width: 17%; border-right: 0.5pt solid #000; padding: 1px 3px;">
                        <span class="lbl">Dado de Vida</span>
                        <span style="font-size: 8pt; font-weight: bold;">d{{ optional($ficha->classe)->dado_vida ?: '—' }}</span>
                    </td>
                    <td style="width: 17%; padding: 1px 3px; background: #000; color: #fff; text-align: center;">
                        <span class="lbl" style="color:#fff;">Desloc.</span>
                        <span style="font-size: 8pt; font-weight: bold;">{{ $ficha->deslocamento ?: '—' }}</span>
                    </td>
                </tr>
                </table>
            </td>
        </tr>

        {{-- CA --}}
        <tr>
            <td colspan="6" style="border: 0.7pt solid #000; padding: 1px 2px;">
                <table cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                    <td style="width: 22%; background: #000; color: #fff; text-align: center; padding: 2px; border-right: 0.5pt solid #fff; vertical-align: middle;">
                        <span style="font-size: 6pt; font-weight: bold; text-transform: uppercase; display:block;">CA</span>
                        <span style="font-size: 13pt; font-weight: bold;">{{ $caTotal }}</span>
                    </td>
                    <td style="width: 5%; text-align: center; vertical-align: middle; font-size: 8pt; font-weight: bold; padding: 0 2px;">= 10 +</td>
                    <td style="width: 73%; padding: 1px;">
                        <table class="ca-comp" cellspacing="0" cellpadding="0" style="width:100%;">
                        <tr>
                            <td style="width: 20%;"><span class="clbl">Bôn. Armadura</span><span class="cval">{{ sprintf('%+d', (int)$ficha->ca_armadura) }}</span></td>
                            <td style="width: 16%;"><span class="clbl">Bôn. Escudo</span><span class="cval">{{ sprintf('%+d', (int)$ficha->ca_escudo) }}</span></td>
                            <td style="width: 15%;"><span class="clbl">Mod. DES</span><span class="cval">{{ sprintf('%+d', $mods['destreza']) }}</span></td>
                            <td style="width: 15%;"><span class="clbl">Mod. Tam.</span><span class="cval">{{ sprintf('%+d', (int)$ficha->ca_tamanho) }}</span></td>
                            <td style="width: 17%;"><span class="clbl">Natural</span><span class="cval">{{ sprintf('%+d', (int)$ficha->ca_natural) }}</span></td>
                            <td style="width: 17%;"><span class="clbl">Deflexão</span><span class="cval">{{ sprintf('%+d', (int)$ficha->ca_deflexao) }}</span></td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>
            </td>
        </tr>

        {{-- CA derivada + Iniciativa --}}
        <tr>
            <td colspan="3" style="border: 0.7pt solid #000; padding: 1px 3px; width: 26%;">
                <span class="lbl">CA Total</span>
                <span style="font-size: 9pt; font-weight: bold; display: block;">{{ $caTotal }}</span>
            </td>
            <td style="border: 0.7pt solid #000; padding: 1px 3px; width: 22%;">
                <span class="lbl">CA Toque</span>
                <span style="font-size: 9pt; font-weight: bold; display: block;">{{ $caToque }}</span>
            </td>
            <td style="border: 0.7pt solid #000; padding: 1px 3px; width: 26%;">
                <span class="lbl">CA Surpreso</span>
                <span style="font-size: 9pt; font-weight: bold; display: block;">{{ $caSurpreso }}</span>
            </td>
            <td style="border: 0.7pt solid #000; padding: 1px 3px; width: 26%; background: #000; color: #fff; text-align: center;">
                <span class="lbl" style="color:#fff;">Iniciativa</span>
                <span style="font-size: 9pt; font-weight: bold; display: block;">{{ sprintf('%+d', $iniciativa) }}</span>
                <span style="font-size: 4pt; display: block; color: #ccc;">= Mod. DES {{ sprintf('%+d', $mods['destreza']) }}</span>
            </td>
        </tr>

        {{-- BAB + Agarrar --}}
        <tr>
            <td colspan="3" style="border: 0.7pt solid #000; padding: 1px 3px; width: 50%;">
                <span style="background:#000;color:#fff;font-size:5pt;font-weight:bold;text-transform:uppercase;padding:0 2px;">Base de Ataque</span>
                <span style="font-size: 10pt; font-weight: bold; display: block;">{{ sprintf('%+d', (int)$ficha->bab) }}</span>
            </td>
            <td colspan="3" style="border: 0.7pt solid #000; padding: 1px 3px;">
                <span class="lbl">Agarrar</span>
                <span style="font-size: 10pt; font-weight: bold; display: block;">{{ sprintf('%+d', $agarrar) }}</span>
            </td>
        </tr>

        </table>
    </td>

    </tr>
    </table>

    {{-- TESTES DE RESISTÊNCIA --}}
    <table cellspacing="0" cellpadding="0" style="margin-bottom: 2px; width: 100%;">
    <tr>
        <td class="saves-hdr" style="width: 22%;">Teste de Resistência</td>
        <td class="saves-hdr" style="width: 10%;">Total</td>
        <td class="saves-hdr" style="width: 13%;">Teste Base</td>
        <td class="saves-hdr" style="width: 14%;">Mod. Hab.</td>
        <td class="saves-hdr" style="width: 14%;">Mod. Mágico</td>
        <td class="saves-hdr" style="width: 14%;">Mod. Variado</td>
        <td class="saves-hdr" style="width: 13%;">Mod. Temp.</td>
    </tr>
    @php
    $saveRows = [
        'fortitude' => 'Fortitude (CON)',
        'reflexos'  => 'Reflexos (DES)',
        'vontade'   => 'Vontade (SAB)',
    ];
    @endphp
    @foreach($saveRows as $k => $label)
    <tr class="saves-row">
        <td class="saves-name" style="border: 0.7pt solid #000; padding: 1px 3px; font-size: 6pt; font-weight: bold;">{{ $label }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; font-size: 8pt; font-weight: bold;">{{ sprintf('%+d', $saves[$k]['total']) }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; font-size: 7pt;">{{ sprintf('%+d', $saves[$k]['base']) }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; font-size: 7pt;">{{ sprintf('%+d', $saves[$k]['hab']) }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; font-size: 7pt;">{{ sprintf('%+d', $saves[$k]['magia']) }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; font-size: 7pt;">{{ sprintf('%+d', $saves[$k]['misc']) }}</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
    </tr>
    @endforeach
    </table>

    {{-- BÔNUS DE ATAQUE CORPO A CORPO --}}
    <table class="atk-row" cellspacing="0" cellpadding="0" style="margin-bottom: 2px; width: 100%;">
    <tr>
        <td class="atk-lbl" style="width: 30%;">Bônus de Ataque Corpo a Corpo</td>
        <td class="atk-total" style="width: 10%;">{{ sprintf('%+d', $atkCorpo) }}</td>
        <td style="width: 5%; font-size: 6pt; text-align: center;">=</td>
        <td style="width: 13%;"><span class="lbl">BBA</span>{{ sprintf('%+d', (int)$ficha->bab) }}</td>
        <td style="width: 13%;"><span class="lbl">Mod. FOR</span>{{ sprintf('%+d', $mods['forca']) }}</td>
        <td style="width: 13%;"><span class="lbl">Tamanho</span>{{ sprintf('%+d', (int)$ficha->ca_tamanho) }}</td>
        <td style="width: 13%;"><span class="lbl">Variado</span><span class="field">&nbsp;</span></td>
        <td style="width: 13%;"><span class="lbl">Temp.</span><span class="field">&nbsp;</span></td>
    </tr>
    </table>

    {{-- BÔNUS DE ATAQUE DISTÂNCIA --}}
    <table class="atk-row" cellspacing="0" cellpadding="0" style="margin-bottom: 2px; width: 100%;">
    <tr>
        <td class="atk-lbl" style="width: 30%;">Bônus de Ataque à Distância</td>
        <td class="atk-total" style="width: 10%;">{{ sprintf('%+d', $atkDist) }}</td>
        <td style="width: 5%; font-size: 6pt; text-align: center;">=</td>
        <td style="width: 13%;"><span class="lbl">BBA</span>{{ sprintf('%+d', (int)$ficha->bab) }}</td>
        <td style="width: 13%;"><span class="lbl">Mod. DES</span>{{ sprintf('%+d', $mods['destreza']) }}</td>
        <td style="width: 13%;"><span class="lbl">Tamanho</span>{{ sprintf('%+d', (int)$ficha->ca_tamanho) }}</td>
        <td style="width: 13%;"><span class="lbl">Variado</span><span class="field">&nbsp;</span></td>
        <td style="width: 13%;"><span class="lbl">Temp.</span><span class="field">&nbsp;</span></td>
    </tr>
    </table>

    {{-- ARMAS (3 slots) --}}
    @php
    $armasList = $ficha->armas->values();
    $armaPad   = 3;
    @endphp
    @for($wi = 0; $wi < $armaPad; $wi++)
    @php $arma = $armasList->get($wi); @endphp
    {{-- header da arma --}}
    <table class="wpn-hdr" cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 2px;">
    <tr>
        <td colspan="5">
            @if($arma)
                ARMA — {{ $arma->nome }}@if(($arma->pivot->quantidade ?? 1) > 1) (×{{ $arma->pivot->quantidade }})@endif
            @else
                ARMA
            @endif
        </td>
    </tr>
    </table>
    {{-- linha 1: ataque, dano, crítico --}}
    <table class="wpn-row" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td style="width: 34%;">
            <span class="lbl">Bônus de Ataque Total</span>
            @if($arma)
                @php
                $isRanged = $arma->categoria && (stripos($arma->categoria, 'Distância') !== false || stripos($arma->categoria, 'Projétil') !== false || stripos($arma->categoria, 'Projetil') !== false);
                $atkArma = $isRanged ? $atkDist : $atkCorpo;
                @endphp
                <span style="font-size: 9pt; font-weight: bold;">{{ sprintf('%+d', $atkArma) }}</span>
            @else
                <span class="field">&nbsp;</span>
            @endif
        </td>
        <td style="width: 33%;">
            <span class="lbl">Dano</span>
            @if($arma)<span style="font-size: 8pt; font-weight: bold;">{{ $arma->dano_m ?: ($arma->dano_p ?: '—') }}</span>@else<span class="field">&nbsp;</span>@endif
        </td>
        <td style="width: 33%;">
            <span class="lbl">Decisivo (Crítico)</span>
            @if($arma)<span style="font-size: 8pt; font-weight: bold;">{{ $arma->critico ?: '—' }}</span>@else<span class="field">&nbsp;</span>@endif
        </td>
    </tr>
    </table>
    {{-- linha 2: alcance, peso, tamanho, tipo, especiais --}}
    <table class="wpn-row" cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr>
        <td style="width: 18%;"><span class="lbl">Alcance</span>@if($arma){{ $arma->alcance ?: '—' }}@else<span class="field">&nbsp;</span>@endif</td>
        <td style="width: 16%;"><span class="lbl">Peso</span>@if($arma){{ $arma->peso ? $arma->peso . ' kg' : '—' }}@else<span class="field">&nbsp;</span>@endif</td>
        <td style="width: 14%;"><span class="lbl">Tamanho</span>@if($arma){{ $arma->tamanho ?: '—' }}@else<span class="field">&nbsp;</span>@endif</td>
        <td style="width: 14%;"><span class="lbl">Tipo</span>@if($arma){{ $arma->tipo ?: '—' }}@else<span class="field">&nbsp;</span>@endif</td>
        <td style="width: 38%;"><span class="lbl">Propriedades Especiais</span>@if($arma){{ $arma->categoria ?: '—' }}@else<span class="field">&nbsp;</span>@endif</td>
    </tr>
    </table>
    @endfor

    {{-- ARMADURA (primeira não-escudo) --}}
    @php
    $armaduraPrincipal = $ficha->armaduras->first(fn($a) => !str_contains(strtolower($a->tipo ?? ''), 'escudo'));
    $escudo = $ficha->armaduras->first(fn($a) => str_contains(strtolower($a->tipo ?? ''), 'escudo'));
    @endphp
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 2px;">
    <tr><td class="sec" colspan="5">Armadura / Item de Proteção</td></tr>
    </table>
    <table class="arm-row" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td style="width: 30%;"><span class="arm-lbl">Tipo</span><span class="arm-val">{{ $armaduraPrincipal ? $armaduraPrincipal->nome : '' }}</span></td>
        <td style="width: 20%;"><span class="arm-lbl">Bônus de Armadura</span><span class="arm-val">{{ $armaduraPrincipal ? sprintf('%+d', (int)$armaduraPrincipal->bonus_ca) : '' }}</span></td>
        <td style="width: 20%;"><span class="arm-lbl">Penalidade por Arm.</span><span class="arm-val">{{ $armaduraPrincipal ? (int)$armaduraPrincipal->penalidade_armadura : '' }}</span></td>
        <td style="width: 15%;"><span class="arm-lbl">Bôn. Máx. DES</span><span class="arm-val">{{ $armaduraPrincipal ? (is_null($armaduraPrincipal->destreza_max) ? '—' : $armaduraPrincipal->destreza_max) : '' }}</span></td>
        <td style="width: 15%;"><span class="arm-lbl">Falha Arcana</span><span class="arm-val">{{ $armaduraPrincipal ? (is_null($armaduraPrincipal->falha_arcana) ? '—' : $armaduraPrincipal->falha_arcana . '%') : '' }}</span></td>
    </tr>
    <tr>
        <td><span class="arm-lbl">Deslocamento</span><span class="arm-val">&nbsp;</span></td>
        <td><span class="arm-lbl">Peso</span><span class="arm-val">{{ $armaduraPrincipal && $armaduraPrincipal->peso ? $armaduraPrincipal->peso . ' kg' : '' }}</span></td>
        <td colspan="3"><span class="arm-lbl">Propriedades Especiais</span><span class="arm-val">&nbsp;</span></td>
    </tr>
    </table>

    {{-- ESCUDO --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 2px;">
    <tr><td class="sec" colspan="4">Escudo / Item de Proteção</td></tr>
    </table>
    <table class="arm-row" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td style="width: 25%;"><span class="arm-lbl">Bônus de Armadura</span><span class="arm-val">{{ $escudo ? sprintf('%+d', (int)$escudo->bonus_ca) : '' }}</span></td>
        <td style="width: 25%;"><span class="arm-lbl">Peso</span><span class="arm-val">{{ $escudo && $escudo->peso ? $escudo->peso . ' kg' : '' }}</span></td>
        <td style="width: 25%;"><span class="arm-lbl">Falha Arcana</span><span class="arm-val">{{ $escudo ? (is_null($escudo->falha_arcana) ? '—' : $escudo->falha_arcana . '%') : '' }}</span></td>
        <td style="width: 25%;"><span class="arm-lbl">Penalidade por Arm.</span><span class="arm-val">{{ $escudo ? (int)$escudo->penalidade_armadura : '' }}</span></td>
    </tr>
    <tr>
        <td colspan="4"><span class="arm-lbl">Propriedades Especiais</span><span class="arm-val">&nbsp;</span></td>
    </tr>
    </table>

    {{-- MUNIÇÃO --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 2px;">
    <tr><td class="sec" colspan="2">Munição</td></tr>
    </table>
    <table class="arm-row" cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr>
        <td style="width: 60%;"><span class="arm-lbl">Tipo</span><span class="arm-val">&nbsp;</span></td>
        <td style="width: 40%;"><span class="arm-lbl">Quantidade</span><span class="arm-val">&nbsp;</span></td>
    </tr>
    </table>

</td>

{{-- ===== COLUNA DIREITA — PERÍCIAS ===== --}}
<td style="width: 40%; vertical-align: top;">
    @php
    $gradMax = ($ficha->nivel ?? 1) + 3;
    $gradMaxFora = (int) floor($gradMax / 2);

    // Mapa de abreviação de habilidade → chave de $mods
    $mapaHab = [
        'FOR' => 'forca', 'DES' => 'destreza', 'CON' => 'constituicao',
        'INT' => 'inteligencia', 'SAB' => 'sabedoria', 'CAR' => 'carisma',
    ];

    // Indexar perícias do personagem pelo nome (lowercase) para lookup rápido
    $periciasPJ = $pericias->keyBy(fn($p) => mb_strtolower($p['nome']));
    @endphp

    <table cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td class="sec" colspan="7">Perícias &nbsp; Graduação Máx.: {{ $gradMax }} / {{ $gradMaxFora }}</td>
    </tr>
    {{-- Subheader --}}
    <tr>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 6%;">OC</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 2px; width: 38%;">Nome da Perícia</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 9%;">Hab.</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 13%;">Mod.<br>Perícia</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 11%;">Mod.<br>Hab.</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 11%;">Grad.</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Mod.<br>Var.</td>
    </tr>

    @foreach($todasPericias as $tp)
    @php
    $chaveAbr = strtoupper(substr($tp->habilidade_chave ?? '', 0, 3));
    $modKey   = $mapaHab[$chaveAbr] ?? null;
    $modHab   = $modKey ? $mods[$modKey] : 0;
    $lookup   = $periciasPJ->get(mb_strtolower($tp->nome));
    $temGrad  = $lookup && $lookup['grad'] > 0;
    $rowStyle = $temGrad ? 'background: #f0f0f0;' : '';
    @endphp
    <tr style="{{ $rowStyle }}">
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; font-size: 7pt; vertical-align: middle;">□</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; padding: 0 2px; font-size: 5.5pt; vertical-align: middle;">{{ $tp->nome }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; font-size: 5.5pt; font-weight: bold; vertical-align: middle;">{{ $chaveAbr }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; font-size: 6.5pt; font-weight: bold; vertical-align: middle;">
            @if($lookup){{ sprintf('%+d', $lookup['total']) }}@else<span class="sk-underline">&nbsp;</span>@endif
        </td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; font-size: 6pt; vertical-align: middle;">{{ sprintf('%+d', $modHab) }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; font-size: 6pt; vertical-align: middle;">
            @if($lookup && $lookup['grad'] > 0){{ number_format($lookup['grad'], 1, ',', '') }}@else&nbsp;@endif
        </td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; padding: 0 1px; vertical-align: middle;">&nbsp;</td>
    </tr>
    @endforeach

    {{-- Borda inferior da tabela --}}
    <tr><td colspan="7" style="border-top: 0.7pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; height: 1pt;"></td></tr>
    </table>

</td>
</tr>
</table>

{{-- ===== PÁGINA 2 ===== --}}
<div class="page-break"></div>

<table cellspacing="0" cellpadding="0" style="margin-bottom: 0;">
<tr>

{{-- ===== COL ESQ P2: 55% ===== --}}
<td style="width: 55%; padding-right: 2px; vertical-align: top;">

    {{-- PONTOS DE EXPERIÊNCIA --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="3">Pontos de Experiência</td></tr>
    <tr class="xp-row">
        <td style="border: 0.7pt solid #000; width: 33%; padding: 2px 3px;">
            <span class="lbl">XP Atual</span>
            <span style="font-size: 9pt; font-weight: bold; display: block;">{{ number_format((int)$ficha->xp_atual, 0, ',', '.') }}</span>
        </td>
        <td style="border: 0.7pt solid #000; width: 33%; padding: 2px 3px;">
            <span class="lbl">Próximo Nível</span>
            <span style="font-size: 9pt; font-weight: bold; display: block;">{{ number_format((int)$ficha->xp_proximo, 0, ',', '.') }}</span>
        </td>
        <td style="border: 0.7pt solid #000; width: 34%; padding: 2px 3px;">
            <span class="lbl">Faltam</span>
            <span style="font-size: 9pt; font-weight: bold; display: block;">{{ number_format(max(0, (int)$ficha->xp_proximo - (int)$ficha->xp_atual), 0, ',', '.') }}</span>
        </td>
    </tr>
    </table>

    {{-- EQUIPAMENTO (armaduras completo) --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="6">Equipamento (Armaduras e Escudos)</td></tr>
    <tr>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 2px; width: 28%;">Nome</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Tipo</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Bônus CA</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Penal.</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Peso</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 24%;">Prop. Especiais</td>
    </tr>
    @php $eqPad = 5; $eqCount = $ficha->armaduras->count(); @endphp
    @foreach($ficha->armaduras as $ea)
    <tr>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt;">{{ $ea->nome }}</td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; text-align: center;">{{ $ea->tipo ?: '—' }}</td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; text-align: center;">{{ sprintf('%+d', (int)$ea->bonus_ca) }}</td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; text-align: center;">{{ (int)$ea->penalidade_armadura }}</td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt; text-align: center;">{{ $ea->peso ? $ea->peso . ' kg' : '—' }}</td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 6pt;">&nbsp;</td>
    </tr>
    @endforeach
    @for($ei = $eqCount; $ei < $eqPad; $ei++)
    <tr>
        <td style="border: 0.7pt solid #000; height: 10pt;">&nbsp;</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
        <td style="border: 0.7pt solid #000;">&nbsp;</td>
    </tr>
    @endfor
    </table>

    {{-- OUTROS ITENS (equipamentos) --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="4">Outros Itens</td></tr>
    <tr>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 2px; width: 45%;">Item</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 10%;">Qtd</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 12%;">Peso</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 2px; width: 33%;">Categoria</td>
    </tr>
    @php $itemPad = 15; $itemCount = $ficha->equipamentos->count(); @endphp
    @foreach($ficha->equipamentos as $it)
    <tr>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; padding: 0 2px; font-size: 6pt; height: 9pt;">{{ $it->nome }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; font-size: 6pt;">{{ $it->pivot->quantidade ?? 1 }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; text-align: center; font-size: 6pt;">{{ $it->peso ? $it->peso . ' kg' : '—' }}</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; padding: 0 2px; font-size: 6pt;">{{ $it->categoria ?: '—' }}</td>
    </tr>
    @endforeach
    @for($ii = $itemCount; $ii < $itemPad; $ii++)
    <tr>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; height: 9pt;">&nbsp;</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000;">&nbsp;</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000;">&nbsp;</td>
        <td style="border-bottom: 0.3pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000;">&nbsp;</td>
    </tr>
    @endfor
    <tr><td colspan="4" style="border-top: 0.7pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; height: 1pt;"></td></tr>
    </table>

    {{-- PESO TOTAL --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr>
        <td style="border: 0.7pt solid #000; padding: 2px 4px; width: 60%;">
            <span class="lbl">Total de Peso Carregado</span>
            <span style="font-size: 9pt; font-weight: bold;">{{ number_format($pesoTotal, 1, ',', '.') }} kg</span>
        </td>
        <td style="border: 0.7pt solid #000; padding: 2px 4px; width: 40%;">
            <span class="lbl">Ouro em Bolsa</span>
            <span style="font-size: 9pt; font-weight: bold;">{{ number_format((float)($ficha->ouro ?? 0), 2, ',', '.') }} PO</span>
        </td>
    </tr>
    </table>

    {{-- CARGA --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="3">Capacidade de Carga (kg)</td></tr>
    <tr>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px; width: 33%;">
            <span class="lbl">Leve</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['leve'] }}</span>
        </td>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px; width: 33%;">
            <span class="lbl">Média</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['media'] }}</span>
        </td>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px; width: 34%;">
            <span class="lbl">Pesada</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['pesada'] }}</span>
        </td>
    </tr>
    <tr>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px;">
            <span class="lbl">Levantar (cabeça)</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['levantarCabeca'] }}</span>
        </td>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px;">
            <span class="lbl">Levantar (solo)</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['levantarSolo'] }}</span>
        </td>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px;">
            <span class="lbl">Arrastar</span>
            <span style="font-size: 7pt; font-weight: bold; display: block;">{{ $cargas['arrastar'] }}</span>
        </td>
    </tr>
    </table>

    {{-- DINHEIRO --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="4">Dinheiro</td></tr>
    <tr>
        <td class="money-cell" style="width: 25%;"><span class="money-lbl">PC</span><span class="money-val">{{ (int)$ficha->dinheiro_pc }}</span></td>
        <td class="money-cell" style="width: 25%;"><span class="money-lbl">PP</span><span class="money-val">{{ (int)$ficha->dinheiro_pp }}</span></td>
        <td class="money-cell" style="width: 25%;"><span class="money-lbl">PO</span><span class="money-val">{{ (int)($ficha->ouro ?? 0) }}</span></td>
        <td class="money-cell" style="width: 25%;"><span class="money-lbl">PL</span><span class="money-val">{{ (int)$ficha->dinheiro_pl }}</span></td>
    </tr>
    </table>

    {{-- IDIOMAS --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec">Idiomas</td></tr>
    <tr>
        <td style="border: 0.7pt solid #000; padding: 2px 4px; font-size: 6.5pt; min-height: 16pt;">{{ $ficha->idiomas ?: 'Comum' }}</td>
    </tr>
    </table>

</td>

{{-- ===== COL DIR P2: 45% ===== --}}
<td style="width: 45%; vertical-align: top;">

    {{-- TALENTOS --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec">Talentos e Dons ({{ $ficha->talentos->count() }})</td></tr>
    <tr>
        <td style="border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; padding: 2px 3px;">
            @foreach($ficha->talentos as $t)
            <div style="margin-bottom: 3px; border-bottom: 0.4pt solid #ccc; padding-bottom: 2px;">
                <span class="tal-name">{{ $t->nome }}</span>
                @if($t->tipo)<span class="tal-tipo"> — {{ $t->tipo }}</span>@endif
                @if($t->beneficio)<div class="tal-benef">{{ mb_substr($t->beneficio, 0, 250) }}{{ mb_strlen($t->beneficio) > 250 ? '…' : '' }}</div>@endif
            </div>
            @endforeach
            @php $talentosPad = max(0, 8 - $ficha->talentos->count()); @endphp
            @for($ti = 0; $ti < $talentosPad; $ti++)
            <div class="tal-blank">&nbsp;</div>
            @endfor
        </td>
    </tr>
    <tr><td style="border-bottom: 0.7pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; height: 1pt;"></td></tr>
    </table>

    {{-- HABILIDADES ESPECIAIS --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec">Habilidades Especiais</td></tr>
    <tr>
        <td style="border: 0.7pt solid #000; padding: 2px 3px; font-size: 6pt; min-height: 30pt; white-space: pre-wrap;">{{ $ficha->habilidades_especiais ? mb_substr($ficha->habilidades_especiais, 0, 600) : '' }}</td>
    </tr>
    @if(!$ficha->habilidades_especiais)
    @for($hi = 0; $hi < 3; $hi++)
    <tr><td style="border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; border-bottom: 0.4pt solid #000; height: 9pt;">&nbsp;</td></tr>
    @endfor
    <tr><td style="border-bottom: 0.7pt solid #000; border-left: 0.7pt solid #000; border-right: 0.7pt solid #000; height: 1pt;"></td></tr>
    @endif
    </table>

    {{-- MAGIAS --}}
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec" colspan="4">Magias — Grimório / Escola de Especialização</td></tr>
    <tr>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 10%;">Nível</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 16%;">Magias Con.</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; text-align: center; padding: 1px; width: 14%;">Espaços/Dia</td>
        <td style="background: #d0d0d0; border: 0.7pt solid #000; font-size: 4.5pt; font-weight: bold; text-transform: uppercase; padding: 1px 2px; width: 60%;">Magias</td>
    </tr>
    @php $totalMagias = collect($magiasPorNivel)->sum(fn($c) => $c->count()); @endphp
    @foreach($magiasPorNivel as $nivel => $magias)
    <tr>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px; font-size: 7pt; font-weight: bold; vertical-align: middle;">{{ $nivel }}</td>
        <td style="border: 0.7pt solid #000; text-align: center; padding: 1px; font-size: 6.5pt; vertical-align: middle;">@if($magias->isNotEmpty()){{ $magias->count() }}@else&nbsp;@endif</td>
        <td style="border: 0.7pt solid #000; padding: 1px; vertical-align: middle;"><span class="field">&nbsp;</span></td>
        <td style="border: 0.7pt solid #000; padding: 1px 2px; font-size: 5.5pt; vertical-align: middle; min-height: 9pt;">
            @if($magias->isNotEmpty())
                {{ mb_substr($magias->pluck('nome')->implode(', '), 0, 150) }}{{ mb_strlen($magias->pluck('nome')->implode(', ')) > 150 ? '…' : '' }}
            @else
                &nbsp;
            @endif
        </td>
    </tr>
    @endforeach
    </table>

    {{-- NOTAS DE COMBATE / OBSERVAÇÕES --}}
    @if($ficha->notas_combate)
    <table cellspacing="0" cellpadding="0" style="width: 100%; margin-bottom: 2px;">
    <tr><td class="sec">Notas de Combate</td></tr>
    <tr><td style="border: 0.7pt solid #000; padding: 2px 3px; font-size: 6pt; white-space: pre-wrap;">{{ mb_substr($ficha->notas_combate, 0, 500) }}</td></tr>
    </table>
    @endif

</td>
</tr>
</table>

<div style="text-align: center; font-size: 5pt; color: #888; margin-top: 4px; letter-spacing: 1px; text-transform: uppercase;">
    Forja de Almas &nbsp;·&nbsp; Ficha de Personagem D&amp;D 3.5
</div>

</body>
</html>
