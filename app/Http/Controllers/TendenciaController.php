<?php

namespace App\Http\Controllers;

use App\Models\Tendencia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TendenciaController extends Controller
{
    public function index()
    {
        return Inertia::render('Tendencias/Index', ['tendencias' => Tendencia::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Tendencias/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'apelido' => 'required|string|max:100',
            'iniciais' => 'required|string|max:10',
            'descricao' => 'required|string',
        ]);

        Tendencia::create($validated);

        return redirect()->route('tendencias.index')->with('success', 'Tendência registrada com sucesso!');
    }

    public function show(Tendencia $tendencia)
    {
        return Inertia::render('Tendencias/Edit', ['tendencia' => $tendencia]);
    }

    public function edit(Tendencia $tendencia)
    {
        return Inertia::render('Tendencias/Edit', ['tendencia' => $tendencia]);
    }

    public function update(Request $request, Tendencia $tendencia)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'apelido' => 'required|string|max:100',
            'iniciais' => 'required|string|max:10',
            'descricao' => 'required|string',
        ]);

        $tendencia->update($validated);

        return redirect()->route('tendencias.index')->with('success', 'Tendência atualizada com sucesso!');
    }

    public function destroy(Tendencia $tendencia)
    {
        $tendencia->delete();
        return redirect()->route('tendencias.index')->with('success', 'Tendência removida com sucesso!');
    }
}
