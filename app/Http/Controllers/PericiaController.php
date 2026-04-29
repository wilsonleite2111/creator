<?php

namespace App\Http\Controllers;

use App\Models\Pericia;
use Illuminate\Http\Request;

class PericiaController extends Controller
{
    public function index()
    {
        $pericias = Pericia::all();
        return view('pericias.index', compact('pericias'));
    }

    public function create()
    {
        return view('pericias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'habilidade_chave' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
        ]);

        Pericia::create($validated);

        return redirect()->route('pericias.index')->with('success', 'Perícia registrada no grimório!');
    }

    public function show(Pericia $pericia)
    {
        return view('pericias.show', compact('pericia'));
    }

    public function edit(Pericia $pericia)
    {
        return view('pericias.edit', compact('pericia'));
    }

    public function update(Request $request, Pericia $pericia)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'habilidade_chave' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
        ]);

        $pericia->update($validated);

        return redirect()->route('pericias.index')->with('success', 'Perícia atualizada no grimório!');
    }

    public function destroy(Pericia $pericia)
    {
        $pericia->delete();
        return redirect()->route('pericias.index')->with('success', 'Perícia apagada dos registros.');
    }
}
