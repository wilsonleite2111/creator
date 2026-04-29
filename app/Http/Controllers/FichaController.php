<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\Raca;
use App\Models\Classe;
use App\Models\Tendencia;
use App\Models\Divindade;
use App\Models\Pericia;
use App\Models\Arma;
use App\Models\Armadura;
use App\Models\Equipamento;
use Illuminate\Http\Request;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fichas = Ficha::with(['raca', 'classe'])->get();
        return view('fichas.index', compact('fichas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $racas = Raca::all();
        $classes = Classe::all();
        $tendencias = Tendencia::all();
        $divindades = Divindade::all();
        $pericias = Pericia::all();
        $armas = Arma::all();
        $armaduras = Armadura::all();
        $equipamentos = Equipamento::all();
        
        return view('fichas.create', compact('racas', 'classes', 'tendencias', 'divindades', 'pericias', 'armas', 'armaduras', 'equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'versao' => 'required|string',
            'nome_personagem' => 'required|string|max:100',
            'nome_jogador' => 'required|string|max:100',
            'raca_id' => 'required|exists:racas,id',
            'classe_id' => 'required|exists:classes,id',
            'tendencia_id' => 'required|exists:tendencias,id',
            'divindade' => 'nullable|string',
            'tamanho' => 'nullable|string',
            'idade' => 'nullable|integer',
            'sexo' => 'nullable|string',
            'altura' => 'nullable|numeric',
            'peso' => 'nullable|numeric',
            'olhos' => 'nullable|string',
            'cabelos' => 'nullable|string',
            'pele' => 'nullable|string',
            'nivel' => 'required|integer|min:1',
            'ouro' => 'required|numeric',
            'forca_base' => 'required|integer',
            'destreza_base' => 'required|integer',
            'constituicao_base' => 'required|integer',
            'inteligencia_base' => 'required|integer',
            'sabedoria_base' => 'required|integer',
            'carisma_base' => 'required|integer',
            'pv_max' => 'required|integer',
            'bab' => 'required|integer',
            'fortitude_base' => 'required|integer',
            'reflexos_base' => 'required|integer',
            'vontade_base' => 'required|integer',
            'xp_atual' => 'required|integer',
            'deslocamento' => 'required|string',
            'iniciativa_misc' => 'required|integer',
            'ca_natural' => 'required|integer',
            'ca_deflexao' => 'required|integer',
            'ca_misc' => 'required|integer',
            'fortitude_misc' => 'required|integer',
            'reflexos_misc' => 'required|integer',
            'vontade_misc' => 'required|integer',
            'agarre_misc' => 'required|integer',
            'talentos_descricao' => 'nullable|string',
            'habilidades_especiais' => 'nullable|string',
            'idiomas' => 'nullable|string',
            'notas_combate' => 'nullable|string',
        ]);

        $validated['pv_atual'] = $validated['pv_max'];

        $ficha = Ficha::create($validated);

        if ($request->has('pericias')) {
            foreach ($request->pericias as $pericia_id => $graduacoes) {
                if ($graduacoes > 0) {
                    $ficha->pericias()->attach($pericia_id, ['graduacoes' => $graduacoes]);
                }
            }
        }

        if ($request->has('armas')) {
            foreach ($request->armas as $arma_id) {
                $ficha->armas()->attach($arma_id, ['quantidade' => 1, 'esta_equipado' => true]);
            }
        }

        if ($request->has('armaduras')) {
            foreach ($request->armaduras as $armadura_id) {
                $ficha->armaduras()->attach($armadura_id, ['esta_equipado' => true]);
            }
        }

        if ($request->has('equipamentos')) {
            foreach ($request->equipamentos as $equip_id) {
                $ficha->equipamentos()->attach($equip_id, ['quantidade' => 1]);
            }
        }

        return redirect()->route('fichas.index')->with('success', 'Ficha de Personagem forjada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ficha $ficha)
    {
        $ficha->load(['raca', 'classe', 'tendencia', 'pericias']);
        return view('fichas.show', compact('ficha'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ficha $ficha)
    {
        // Implementação futura ou se necessário
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ficha $ficha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ficha $ficha)
    {
        $ficha->delete();
        return redirect()->route('fichas.index')->with('success', 'Ficha removida do registro.');
    }
}
