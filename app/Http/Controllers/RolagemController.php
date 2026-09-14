<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RolagemController extends Controller
{
    public function atributos(Request $request): JsonResponse
    {
        $data = $request->validate([
            'metodo' => 'required|in:four_d6,twelve_d6',
        ]);

        $rolagens = [];

        if ($data['metodo'] === 'four_d6') {
            for ($i = 0; $i < 6; $i++) {
                $dados = [
                    random_int(1, 6),
                    random_int(1, 6),
                    random_int(1, 6),
                    random_int(1, 6),
                ];
                $ordenados = $dados;
                rsort($ordenados);
                $soma = $ordenados[0] + $ordenados[1] + $ordenados[2];
                $rolagens[] = ['dados' => $dados, 'soma' => $soma];
            }
        } else {
            for ($i = 0; $i < 12; $i++) {
                $dados = [random_int(1, 6), random_int(1, 6), random_int(1, 6)];
                $rolagens[] = ['dados' => $dados, 'soma' => array_sum($dados)];
            }
        }

        return response()->json(['rolagens' => $rolagens]);
    }
}
