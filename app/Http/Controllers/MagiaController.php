<?php

namespace App\Http\Controllers;

use App\Models\Magia;
use App\Models\Classe;
use Illuminate\Http\Request;

class MagiaController extends Controller
{
    public function index(Request $request)
    {
        $versao = $request->get('versao', '3.5');
        $magias = Magia::where('versao', $versao)->with('classes')->get();
        return view('magias.index', compact('magias', 'versao'));
    }

    public function create()
    {
        $classes = Classe::all();
        return view('magias.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'escola' => 'nullable|string',
            'componentes' => 'nullable|string',
            'tempo_execucao' => 'nullable|string',
            'alcance' => 'nullable|string',
            'alvo_area_efeito' => 'nullable|string',
            'duracao' => 'nullable|string',
            'teste_resistencia' => 'nullable|string',
            'resistencia_magia' => 'nullable|string',
            'descricao' => 'nullable|string',
            'versao' => 'required|string',
            'niveis' => 'required|array', // [classe_id => nivel]
        ]);

        $magia = Magia::create($validated);

        foreach ($request->niveis as $classe_id => $nivel) {
            if ($nivel !== null && $nivel !== '') {
                $magia->classes()->attach($classe_id, ['nivel' => $nivel]);
            }
        }

        return redirect()->route('magias.index')->with('success', 'Magia conjurada com sucesso no registro!');
    }

    public function show(Magia $magia)
    {
        $magia->load('classes');
        return view('magias.show', compact('magia'));
    }

    public function edit(Magia $magia)
    {
        $classes = Classe::all();
        $magia->load('classes');
        return view('magias.edit', compact('magia', 'classes'));
    }

    public function update(Request $request, Magia $magia)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'escola' => 'nullable|string',
            'componentes' => 'nullable|string',
            'tempo_execucao' => 'nullable|string',
            'alcance' => 'nullable|string',
            'alvo_area_efeito' => 'nullable|string',
            'duracao' => 'nullable|string',
            'teste_resistencia' => 'nullable|string',
            'resistencia_magia' => 'nullable|string',
            'descricao' => 'nullable|string',
            'versao' => 'required|string',
            'niveis' => 'required|array',
        ]);

        $magia->update($validated);

        $syncData = [];
        foreach ($request->niveis as $classe_id => $nivel) {
            if ($nivel !== null && $nivel !== '') {
                $syncData[$classe_id] = ['nivel' => $nivel];
            }
        }
        $magia->classes()->sync($syncData);

        return redirect()->route('magias.index')->with('success', 'Grimório atualizado!');
    }

    public function destroy(Magia $magia)
    {
        $magia->delete();
        return redirect()->route('magias.index')->with('success', 'Magia dissipada!');
    }
}
