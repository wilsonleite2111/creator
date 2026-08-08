<?php

namespace App\Http\Controllers;

use App\Models\Talento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TalentoController extends Controller
{
    public function index()
    {
        return Inertia::render('Talentos/Index', ['talentos' => Talento::orderBy('nome')->get()]);
    }

    public function create()
    {
        return Inertia::render('Talentos/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:100',
            'pre_requisitos' => 'nullable|string',
            'beneficio' => 'nullable|string',
            'descricao' => 'nullable|string',
        ]);

        Talento::create($validated);

        return redirect()->route('talentos.index')->with('success', 'Talento registrado nos tomos!');
    }

    public function show(Talento $talento)
    {
        return Inertia::render('Talentos/Edit', ['talento' => $talento]);
    }

    public function edit(Talento $talento)
    {
        return Inertia::render('Talentos/Edit', ['talento' => $talento]);
    }

    public function update(Request $request, Talento $talento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'tipo' => 'nullable|string|max:100',
            'pre_requisitos' => 'nullable|string',
            'beneficio' => 'nullable|string',
            'descricao' => 'nullable|string',
        ]);

        $talento->update($validated);

        return redirect()->route('talentos.index')->with('success', 'Talento atualizado com sucesso!');
    }

    public function destroy(Talento $talento)
    {
        $talento->delete();
        return redirect()->route('talentos.index')->with('success', 'Talento removido dos tomos!');
    }
}
