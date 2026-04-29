<?php

namespace App\Http\Controllers;

use App\Models\Arma;
use Illuminate\Http\Request;

class ArmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $armas = Arma::all();
        return view('armas.index', compact('armas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('armas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'nullable|string',
            'dano_p' => 'nullable|string',
            'dano_m' => 'nullable|string',
            'critico' => 'nullable|string',
            'alcance' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'tipo' => 'nullable|string',
            'categoria' => 'nullable|string',
            'uso' => 'nullable|string',
        ]);

        Arma::create($validated);

        return redirect()->route('armas.index')->with('success', 'Arma forjada com sucesso!');
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
