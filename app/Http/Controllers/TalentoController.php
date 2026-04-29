<?php

namespace App\Http\Controllers;

use App\Models\Talento;
use Illuminate\Http\Request;

class TalentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $talentos = Talento::all();
        return view('talentos.index', compact('talentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('talentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Talento $talento)
    {
        return view('talentos.show', compact('talento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Talento $talento)
    {
        return view('talentos.edit', compact('talento'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Talento $talento)
    {
        $talento->delete();

        return redirect()->route('talentos.index')->with('success', 'Talento removido dos tomos!');
    }
}
