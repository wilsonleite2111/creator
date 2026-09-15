<?php

namespace App\Services;

use App\Models\Ficha;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class FichaPdfService
{
    public function generate(Ficha $ficha): Response
    {
        $ficha->loadMissing([
            'raca',
            'classe',
            'tendencia',
            'pericias',
            'armas',
            'armaduras',
            'equipamentos',
            'talentos',
            'magias.classes',
        ]);

        $data = $this->buildViewData($ficha);

        $pdf = Pdf::loadView('pdf.ficha', $data)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
            ]);

        $filename = 'ficha-' . str($ficha->nome_personagem ?: 'personagem')->slug() . '.pdf';

        return $pdf->download($filename);
    }

    private function buildViewData(Ficha $ficha): array
    {
        $mods = [
            'forca'        => $this->modifier((int) $ficha->forca_base),
            'destreza'     => $this->modifier((int) $ficha->destreza_base),
            'constituicao' => $this->modifier((int) $ficha->constituicao_base),
            'inteligencia' => $this->modifier((int) $ficha->inteligencia_base),
            'sabedoria'    => $this->modifier((int) $ficha->sabedoria_base),
            'carisma'      => $this->modifier((int) $ficha->carisma_base),
        ];

        $caTotal = 10
            + (int) $ficha->ca_armadura
            + (int) $ficha->ca_escudo
            + $mods['destreza']
            + (int) $ficha->ca_tamanho
            + (int) $ficha->ca_natural
            + (int) $ficha->ca_deflexao
            + (int) $ficha->ca_misc;

        $iniciativa = $mods['destreza'] + (int) $ficha->iniciativa_misc;

        $saves = [
            'fortitude' => [
                'base'  => (int) $ficha->fortitude_base,
                'hab'   => $mods['constituicao'],
                'magia' => (int) $ficha->fortitude_magia,
                'misc'  => (int) $ficha->fortitude_misc,
            ],
            'reflexos' => [
                'base'  => (int) $ficha->reflexos_base,
                'hab'   => $mods['destreza'],
                'magia' => (int) $ficha->reflexos_magia,
                'misc'  => (int) $ficha->reflexos_misc,
            ],
            'vontade' => [
                'base'  => (int) $ficha->vontade_base,
                'hab'   => $mods['sabedoria'],
                'magia' => (int) $ficha->vontade_magia,
                'misc'  => (int) $ficha->vontade_misc,
            ],
        ];
        foreach ($saves as &$s) {
            $s['total'] = $s['base'] + $s['hab'] + $s['magia'] + $s['misc'];
        }
        unset($s);

        $bab = (int) $ficha->bab;
        $atkCorpo = $bab + $mods['forca'] + (int) $ficha->ca_tamanho;
        $atkDist = $bab + $mods['destreza'] + (int) $ficha->ca_tamanho;
        $agarrar = $bab + $mods['forca'] + (int) $ficha->agarre_tamanho + (int) $ficha->agarre_misc;

        $pericias = $ficha->pericias->map(function ($p) use ($mods) {
            $chave = strtolower($p->habilidade_chave ?? '');
            $mapa = [
                'forca' => 'forca', 'força' => 'forca', 'for' => 'forca',
                'destreza' => 'destreza', 'des' => 'destreza',
                'constituicao' => 'constituicao', 'constituição' => 'constituicao', 'con' => 'constituicao',
                'inteligencia' => 'inteligencia', 'inteligência' => 'inteligencia', 'int' => 'inteligencia',
                'sabedoria' => 'sabedoria', 'sab' => 'sabedoria',
                'carisma' => 'carisma', 'car' => 'carisma',
            ];
            $key = $mapa[$chave] ?? null;
            $mod = $key ? $mods[$key] : 0;
            $grad = (float) ($p->pivot->graduacoes ?? 0);

            return [
                'nome'   => $p->nome,
                'chave'  => strtoupper(substr($p->habilidade_chave ?? '', 0, 3)),
                'grad'   => $grad,
                'mod'    => $mod,
                'total'  => (int) floor($grad + $mod),
            ];
        })->sortBy('nome')->values();

        $magiasPorNivel = collect(range(0, 9))->mapWithKeys(fn ($n) => [$n => collect()]);
        $classeId = $ficha->classe_id;
        foreach ($ficha->magias as $magia) {
            $nivel = null;
            foreach ($magia->classes as $classe) {
                if ($classe->id === $classeId) {
                    $nivel = (int) ($classe->pivot->nivel ?? 0);
                    break;
                }
            }
            if ($nivel === null && $magia->classes->isNotEmpty()) {
                $nivel = (int) ($magia->classes->first()->pivot->nivel ?? 0);
            }
            $nivel = $nivel ?? 0;
            if ($nivel >= 0 && $nivel <= 9) {
                $magiasPorNivel[$nivel]->push($magia);
            }
        }

        $forca = (int) $ficha->forca_base;
        $cargas = $this->cargaPorForca($forca);
        $cargas['levantarCabeca'] = $cargas['pesada'];
        $cargas['levantarSolo']   = $cargas['pesada'] * 2;
        $cargas['arrastar']       = $cargas['pesada'] * 5;

        $caToque    = 10 + (int) $ficha->ca_tamanho + (int) $ficha->ca_deflexao + (int) $ficha->ca_misc + $mods['destreza'];
        $caSurpreso = $caTotal - max(0, $mods['destreza']);

        $pesoTotal = 0.0;
        foreach ($ficha->armas as $a) {
            $pesoTotal += ((float) ($a->peso ?? 0)) * ((int) ($a->pivot->quantidade ?? 1));
        }
        foreach ($ficha->armaduras as $a) {
            $pesoTotal += (float) ($a->peso ?? 0);
        }
        foreach ($ficha->equipamentos as $e) {
            $pesoTotal += ((float) ($e->peso ?? 0)) * ((int) ($e->pivot->quantidade ?? 1));
        }

        $todasPericias = \App\Models\Pericia::orderBy('nome')->get();

        return [
            'ficha'          => $ficha,
            'mods'           => $mods,
            'caTotal'        => $caTotal,
            'caToque'        => $caToque,
            'caSurpreso'     => $caSurpreso,
            'iniciativa'     => $iniciativa,
            'saves'          => $saves,
            'atkCorpo'       => $atkCorpo,
            'atkDist'        => $atkDist,
            'agarrar'        => $agarrar,
            'pericias'       => $pericias,
            'todasPericias'  => $todasPericias,
            'magiasPorNivel' => $magiasPorNivel,
            'cargas'         => $cargas,
            'pesoTotal'      => $pesoTotal,
        ];
    }

    private function modifier(int $score): int
    {
        return (int) floor(($score - 10) / 2);
    }

    private function cargaPorForca(int $str): array
    {
        $base = [
            1 => 3,  2 => 6,   3 => 10,  4 => 13,  5 => 16,
            6 => 20, 7 => 23,  8 => 26,  9 => 30,  10 => 33,
            11 => 38, 12 => 43, 13 => 50, 14 => 58, 15 => 66,
            16 => 76, 17 => 86, 18 => 100, 19 => 116, 20 => 133,
            21 => 153, 22 => 173, 23 => 200, 24 => 233, 25 => 266,
            26 => 306, 27 => 346, 28 => 400, 29 => 466,
        ];

        if ($str < 1) {
            return ['leve' => 0, 'media' => 0, 'pesada' => 0];
        }

        if ($str <= 29) {
            $leve = $base[$str];
        } else {
            $ciclos = intdiv($str - 20, 10);
            $resto = 20 + (($str - 20) % 10);
            $leve = (int) round($base[$resto] * (4 ** $ciclos));
        }

        return [
            'leve'   => $leve,
            'media'  => $leve * 2,
            'pesada' => $leve * 3,
        ];
    }
}
