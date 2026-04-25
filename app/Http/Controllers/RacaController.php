<?php

namespace App\Http\Controllers;

use App\Models\Raca;
use Illuminate\Http\Request;

class RacaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $racas = Raca::all();
        return view('racas.index', compact('racas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('racas.create');
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
            'mod_forca' => 'required|integer',
            'mod_destreza' => 'required|integer',
            'mod_constituicao' => 'required|integer',
            'mod_inteligencia' => 'required|integer',
            'mod_sabedoria' => 'required|integer',
            'mod_carisma' => 'required|integer',
            'tamanho' => 'nullable|string|max:50',
            'deslocamento' => 'nullable|integer',
        ]);

        Raca::create($validated);

        return redirect()->route('racas.index')->with('success', 'Tomo da Raça forjado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Raca $raca)
    {
        return view('racas.show', compact('raca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Raca $raca)
    {
        return view('racas.edit', compact('raca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Raca $raca)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'versao' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'mod_forca' => 'required|integer',
            'mod_destreza' => 'required|integer',
            'mod_constituicao' => 'required|integer',
            'mod_inteligencia' => 'required|integer',
            'mod_sabedoria' => 'required|integer',
            'mod_carisma' => 'required|integer',
            'tamanho' => 'nullable|string|max:50',
            'deslocamento' => 'nullable|integer',
        ]);

        $raca->update($validated);

        return redirect()->route('racas.index')->with('success', 'Tomo da Raça atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Raca $raca)
    {
        $raca->delete();

        return redirect()->route('racas.index')->with('success', 'Tomo da Raça destruído com sucesso!');
    }
}
