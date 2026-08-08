<?php

namespace App\Http\Controllers;

use App\Models\Divindade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DivindadeController extends Controller
{
    public function index()
    {
        return Inertia::render('Divindades/Index', ['divindades' => Divindade::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Divindades/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'titulo' => 'nullable|string|max:255',
            'versao' => 'nullable|string|max:50',
            'tendencia' => 'nullable|string|max:100',
            'dominios' => 'nullable|string|max:255',
            'arma_preferida' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Divindade::create($validated);

        return redirect()->route('divindades.index')->with('success', 'Divindade registrada no Panteão!');
    }

    public function show(Divindade $divindade)
    {
        return Inertia::render('Divindades/Edit', ['divindade' => $divindade]);
    }

    public function edit(Divindade $divindade)
    {
        return Inertia::render('Divindades/Edit', ['divindade' => $divindade]);
    }

    public function update(Request $request, Divindade $divindade)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'titulo' => 'nullable|string|max:255',
            'versao' => 'nullable|string|max:50',
            'tendencia' => 'nullable|string|max:100',
            'dominios' => 'nullable|string|max:255',
            'arma_preferida' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $divindade->update($validated);

        return redirect()->route('divindades.index')->with('success', 'Divindade atualizada com sucesso!');
    }

    public function destroy(Divindade $divindade)
    {
        $divindade->delete();
        return redirect()->route('divindades.index')->with('success', 'Divindade removida do Panteão!');
    }
}
