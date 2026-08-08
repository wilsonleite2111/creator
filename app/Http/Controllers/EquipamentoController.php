<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipamentoController extends Controller
{
    public function index()
    {
        return Inertia::render('Equipamentos/Index', ['equipamentos' => Equipamento::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Equipamentos/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'descricao' => 'nullable|string',
        ]);

        Equipamento::create($validated);

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento registrado com sucesso!');
    }

    public function show(Equipamento $equipamento)
    {
        return Inertia::render('Equipamentos/Edit', ['equipamento' => $equipamento]);
    }

    public function edit(Equipamento $equipamento)
    {
        return Inertia::render('Equipamentos/Edit', ['equipamento' => $equipamento]);
    }

    public function update(Request $request, Equipamento $equipamento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'descricao' => 'nullable|string',
        ]);

        $equipamento->update($validated);

        return redirect()->route('equipamentos.index')->with('success', 'Equipamento atualizado com sucesso!');
    }

    public function destroy(Equipamento $equipamento)
    {
        $equipamento->delete();
        return redirect()->route('equipamentos.index')->with('success', 'Equipamento removido do inventário!');
    }
}
