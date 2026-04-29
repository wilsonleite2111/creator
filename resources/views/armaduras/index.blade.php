@extends('layouts.app')

@section('title', 'Forja: Armaduras')

@section('content')
<div class="mb-8 flex justify-between items-center border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
            <i class="fa-solid fa-shield-halved text-magic-700 mr-3"></i>Forja: Armaduras
        </h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Uma boa couraça é a diferença entre a vida e o abraço do esquecimento."</p>
    </div>
    <a href="{{ route('armaduras.create') }}" class="btn-medieval bg-magic-600 text-white px-6 py-3 rounded shadow-lg flex items-center font-cinzel tracking-wider" @click="playMagic()">
        <i class="fa-solid fa-plus mr-2"></i> Forjar Armadura
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($armaduras as $armadura)
    <div class="glass-parchment p-6 rounded-lg border border-parchment-400 shadow-xl hover:scale-[1.02] transition-transform relative group">
        <div class="absolute top-4 right-4 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('armaduras.edit', $armadura) }}" class="text-magic-700 hover:text-magic-900"><i class="fa-solid fa-pen-to-square"></i></a>
            <form action="{{ route('armaduras.destroy', $armadura) }}" method="POST" onsubmit="return confirm('Deseja destruir esta armadura?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blood-700 hover:text-blood-900"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>

        <h3 class="text-xl font-cinzel font-bold text-magic-900 border-b border-parchment-300 pb-2 mb-4">{{ $armadura->nome }}</h3>
        
        <div class="grid grid-cols-2 gap-4 text-sm font-lora">
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Bônus de CA</p>
                <p class="text-parchment-900 font-bold text-lg">+{{ $armadura->bonus_ca }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Des. Máxima</p>
                <p class="text-parchment-900">{{ $armadura->destreza_max ?? '—' }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Penalidade</p>
                <p class="text-parchment-900">{{ $armadura->penalidade_armadura }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Falha Arcana</p>
                <p class="text-parchment-900">{{ $armadura->falha_arcana }}%</p>
            </div>
            <div class="col-span-2">
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Tipo / Peso</p>
                <p class="text-parchment-900 text-xs">{{ $armadura->tipo }} ({{ $armadura->peso }} kg)</p>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-parchment-300 flex justify-between items-center">
            <span class="text-magic-700 font-cinzel font-bold">{{ $armadura->preco }}</span>
            <span class="text-[10px] text-parchment-600 italic">D&D 3.5 SRD</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
