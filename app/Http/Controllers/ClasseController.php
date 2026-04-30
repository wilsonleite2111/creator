<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

use Inertia\Inertia;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::all();
        return Inertia::render('Classes/Index', [
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Classes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'dado_vida' => 'nullable|integer',
            'bba_progressao' => 'nullable|string|max:50',
            'resistencia_fortitude' => 'nullable|string|max:50',
            'resistencia_reflexos' => 'nullable|string|max:50',
            'resistencia_vontade' => 'nullable|string|max:50',
            'pontos_pericia' => 'nullable|integer',
        ]);

        Classe::create($validated);

        return redirect()->route('classes.index')->with('success', 'Classe criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class)
    {
        return Inertia::render('Classes/Show', [
            'classe' => $class
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class)
    {
        return Inertia::render('Classes/Edit', [
            'classe' => $class
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $class)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'dado_vida' => 'nullable|integer',
            'bba_progressao' => 'nullable|string|max:50',
            'resistencia_fortitude' => 'nullable|string|max:50',
            'resistencia_reflexos' => 'nullable|string|max:50',
            'resistencia_vontade' => 'nullable|string|max:50',
            'pontos_pericia' => 'nullable|integer',
        ]);

        $class->update($validated);

        return redirect()->route('classes.index')->with('success', 'Classe atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $class)
    {
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Classe removida com sucesso!');
    }
}
