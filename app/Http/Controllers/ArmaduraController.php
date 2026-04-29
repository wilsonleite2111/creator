<?php

namespace App\Http\Controllers;

use App\Models\Armadura;
use Illuminate\Http\Request;

class ArmaduraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $armaduras = Armadura::all();
        return view('armaduras.index', compact('armaduras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('armaduras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
