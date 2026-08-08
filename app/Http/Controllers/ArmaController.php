<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArmaController extends Controller
{
    public function index()
    {
        return Inertia::render('Armas/Index', ['armas' => Arma::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Armas/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'dano_p' => 'nullable|string',
            'dano_m' => 'nullable|string',
            'critico' => 'nullable|string',
            'alcance' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'tipo' => 'nullable|string',
            'categoria' => 'nullable|string',
            'uso' => 'nullable|string',
        ]);

        Arma::create($validated);

        return redirect()->route('armas.index')->with('success', 'Arma forjada com sucesso!');
    }

    public function show(Arma $arma)
    {
        return Inertia::render('Armas/Edit', ['arma' => $arma]);
    }

    public function edit(Arma $arma)
    {
        return Inertia::render('Armas/Edit', ['arma' => $arma]);
    }

    public function update(Request $request, Arma $arma)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'dano_p' => 'nullable|string',
            'dano_m' => 'nullable|string',
            'critico' => 'nullable|string',
            'alcance' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'tipo' => 'nullable|string',
            'categoria' => 'nullable|string',
            'uso' => 'nullable|string',
        ]);

        $arma->update($validated);

        return redirect()->route('armas.index')->with('success', 'Arma atualizada com sucesso!');
    }

    public function destroy(Arma $arma)
    {
        $arma->delete();
        return redirect()->route('armas.index')->with('success', 'Arma removida do arsenal!');
    }
}
