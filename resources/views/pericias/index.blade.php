@extends('layouts.app')

@section('title', 'Grimório de Perícias')

@section('content')
<div class="glass-parchment p-8 rounded-lg">
    <div class="flex justify-between items-center mb-6 border-b border-parchment-400 pb-4">
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900">
            <i class="fa-solid fa-book-journal-whills mr-3 text-blood-700"></i>Perícias
        </h1>
        <a href="{{ route('pericias.create') }}" class="btn-medieval bg-blood-700 hover:bg-blood-600 text-white font-cinzel font-bold py-2 px-6 rounded border border-blood-600 shadow-md inline-flex items-center" @mouseenter="playHover()" @click="playPage()">
            <i class="fa-solid fa-feather-pointed mr-2"></i> Adicionar Perícia
        </a>
    </div>

    @if($pericias->isEmpty())
        <div class="text-center py-12">
            <i class="fa-solid fa-ghost text-6xl text-parchment-400 mb-4 opacity-50"></i>
            <p class="text-xl text-parchment-800 font-lora italic">O grimório de perícias está vazio. Adicione a primeira habilidade.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pericias as $pericia)
                <div class="bg-parchment-100 border border-parchment-300 p-5 rounded shadow-sm hover:shadow-md transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-blood-600"></div>
                    
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-2xl font-cinzel font-bold text-parchment-900 group-hover:text-blood-700 transition">
                            {{ $pericia->nome }}
                        </h2>
                        <span class="bg-parchment-300 text-parchment-900 text-xs px-2 py-1 rounded font-bold font-lora border border-parchment-400">
                            {{ $pericia->versao ?? 'Geral' }}
                        </span>
                    </div>

                    <div class="mb-4 text-sm font-lora text-parchment-800 flex items-center">
                        <i class="fa-solid fa-star-half-stroke mr-2 text-blood-600"></i>
                        <strong>Atributo Chave:</strong> <span class="ml-1 uppercase">{{ $pericia->habilidade_chave ?? 'N/A' }}</span>
                    </div>
                    
                    <p class="text-parchment-800 font-lora text-sm mb-6 line-clamp-3 italic">
                        {{ $pericia->descricao ?? 'Nenhuma descrição registrada para esta perícia...' }}
                    </p>
                    
                    <div class="flex justify-end space-x-2 border-t border-parchment-300 pt-3 mt-auto">
                        <a href="{{ route('pericias.edit', $pericia->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300 transition" @click="playMagic()" title="Editar pergaminho">
                            <i class="fa-solid fa-feather"></i>
                        </a>
                        <form action="{{ route('pericias.destroy', $pericia->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar esta perícia do grimório?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-parchment-800 hover:text-blood-700 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300 transition" @click="playExplosion()" title="Destruir pergaminho">
                                <i class="fa-solid fa-fire"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
