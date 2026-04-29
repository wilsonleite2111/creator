<?php

namespace App\Http\Controllers;

use App\Models\Tendencia;
use Illuminate\Http\Request;

class TendenciaController extends Controller
{
    public function index()
    {
        $tendencias = Tendencia::all();
        return view('tendencias.index', compact('tendencias'));
    }

    public function create()
    {
        return view('tendencias.create');
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

    public function edit(Tendencia $tendencia)
    {
        return view('tendencias.edit', compact('tendencia'));
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
