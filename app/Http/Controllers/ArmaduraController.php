<?php

namespace App\Http\Controllers;

use App\Models\Armadura;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArmaduraController extends Controller
{
    public function index()
    {
        return Inertia::render('Armaduras/Index', ['armaduras' => Armadura::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Armaduras/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'bonus_ca' => 'required|integer',
            'destreza_max' => 'nullable|integer',
            'penalidade_armadura' => 'nullable|integer',
            'falha_arcana' => 'nullable|integer',
            'deslocamento_9m' => 'nullable|string',
            'deslocamento_6m' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'tipo' => 'nullable|string',
        ]);

        Armadura::create($validated);

        return redirect()->route('armaduras.index')->with('success', 'Armadura forjada com sucesso!');
    }

    public function show(Armadura $armadura)
    {
        return Inertia::render('Armaduras/Edit', ['armadura' => $armadura]);
    }

    public function edit(Armadura $armadura)
    {
        return Inertia::render('Armaduras/Edit', ['armadura' => $armadura]);
    }

    public function update(Request $request, Armadura $armadura)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'bonus_ca' => 'required|integer',
            'destreza_max' => 'nullable|integer',
            'penalidade_armadura' => 'nullable|integer',
            'falha_arcana' => 'nullable|integer',
            'deslocamento_9m' => 'nullable|string',
            'deslocamento_6m' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'tipo' => 'nullable|string',
        ]);

        $armadura->update($validated);

        return redirect()->route('armaduras.index')->with('success', 'Armadura atualizada com sucesso!');
    }

    public function destroy(Armadura $armadura)
    {
        $armadura->delete();
        return redirect()->route('armaduras.index')->with('success', 'Armadura removida do arsenal!');
    }
}
