@extends('layouts.app')

@section('title', 'Almoxarifado: Equipamentos')

@section('content')
<div class="mb-8 flex justify-between items-center border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
            <i class="fa-solid fa-sack-xmark text-parchment-800 mr-3"></i>Almoxarifado: Itens
        </h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Ferramentas certas para almas audazes."</p>
    </div>
    <a href="{{ route('equipamentos.create') }}" class="btn-medieval bg-magic-600 text-white px-6 py-3 rounded shadow-lg flex items-center font-cinzel tracking-wider" @click="playMagic()">
        <i class="fa-solid fa-plus mr-2"></i> Registrar Item
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($equipamentos as $item)
    <div class="glass-parchment p-4 rounded-lg border border-parchment-400 shadow-lg hover:bg-parchment-200 transition-colors group">
        <div class="flex justify-between items-start mb-2">
            <h3 class="font-cinzel font-bold text-parchment-900">{{ $item->nome }}</h3>
            <div class="opacity-0 group-hover:opacity-100 transition-opacity flex space-x-1 text-[10px]">
                <a href="{{ route('equipamentos.edit', $item) }}" class="text-magic-700"><i class="fa-solid fa-pen"></i></a>
            </div>
        </div>
        
        <p class="text-xs font-lora text-parchment-800 italic mb-3 min-h-[32px]">{{ $item->descricao }}</p>
        
        <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-tighter">
            <span class="text-parchment-600"><i class="fa-solid fa-weight-hanging mr-1"></i> {{ $item->peso }} kg</span>
            <span class="text-magic-800 bg-parchment-300 px-2 py-0.5 rounded">{{ $item->preco }}</span>
        </div>
    </div>
    @endforeach
</div>
@endsection
