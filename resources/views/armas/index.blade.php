@extends('layouts.app')

@section('title', 'Arsenal: Armas')

@section('content')
<div class="mb-8 flex justify-between items-center border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
            <i class="fa-solid fa-sword text-blood-700 mr-3"></i>Arsenal: Armas
        </h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Aço e perícia decidem o destino nos campos de batalha."</p>
    </div>
    <a href="{{ route('armas.create') }}" class="btn-medieval bg-magic-600 text-white px-6 py-3 rounded shadow-lg flex items-center font-cinzel tracking-wider" @click="playMagic()">
        <i class="fa-solid fa-plus mr-2"></i> Forjar Nova Arma
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($armas as $arma)
    <div class="glass-parchment p-6 rounded-lg border border-parchment-400 shadow-xl hover:scale-[1.02] transition-transform relative group">
        <div class="absolute top-4 right-4 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('armas.edit', $arma) }}" class="text-magic-700 hover:text-magic-900"><i class="fa-solid fa-pen-to-square"></i></a>
            <form action="{{ route('armas.destroy', $arma) }}" method="POST" onsubmit="return confirm('Deseja destruir esta arma?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-blood-700 hover:text-blood-900"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>

        <h3 class="text-xl font-cinzel font-bold text-blood-900 border-b border-parchment-300 pb-2 mb-4">{{ $arma->nome }}</h3>
        
        <div class="grid grid-cols-2 gap-4 text-sm font-lora">
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Dano (P/M)</p>
                <p class="text-parchment-900">{{ $arma->dano_p }} / {{ $arma->dano_m }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Crítico</p>
                <p class="text-parchment-900">{{ $arma->critico }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Tipo</p>
                <p class="text-parchment-900">{{ $arma->tipo }}</p>
            </div>
            <div>
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Peso</p>
                <p class="text-parchment-900">{{ $arma->peso }} kg</p>
            </div>
            <div class="col-span-2">
                <p class="text-parchment-700 uppercase text-[10px] font-bold">Categoria / Uso</p>
                <p class="text-parchment-900 text-xs">{{ $arma->categoria }} ({{ $arma->uso }})</p>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-parchment-300 flex justify-between items-center">
            <span class="text-magic-700 font-cinzel font-bold">{{ $arma->preco }}</span>
            <span class="text-[10px] text-parchment-600 italic">D&D 3.5 SRD</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
