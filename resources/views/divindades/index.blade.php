@extends('layouts.app')

@section('title', 'Panteão de Divindades')

@section('content')
<div class="mb-8 flex justify-between items-end border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-sun text-magic-600 mr-3"></i>Panteão de Divindades</h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Os deuses observam dos céus, guiando o destino dos mortais."</p>
    </div>
    <a href="{{ route('divindades.create') }}" 
       class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-6 rounded border border-magic-600 shadow-md inline-flex items-center"
       @mouseenter="playHover()" @click="playMagic()">
        <i class="fa-solid fa-plus-circle mr-2"></i> Nova Divindade
    </a>
</div>

@if($divindades->isEmpty())
    <div class="glass-parchment p-12 text-center rounded-lg border border-parchment-400">
        <i class="fa-solid fa-ankh text-6xl text-parchment-400 mb-4"></i>
        <h2 class="text-2xl font-cinzel font-bold text-parchment-800">O Panteão está em silêncio.</h2>
        <p class="mt-2 text-parchment-900">Nenhuma divindade foi clamada nestes tomos ainda.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($divindades as $divindade)
            <div class="glass-parchment rounded-lg border border-parchment-400 p-6 transform hover:scale-105 transition duration-300 relative group cursor-pointer"
                 x-data="{ showActions: false }" 
                 @mouseenter="showActions = true; playHover()" 
                 @mouseleave="showActions = false">
                
                <div class="absolute top-0 right-0 p-3" x-show="showActions" x-transition.opacity style="display: none;">
                    <div class="flex space-x-2">
                        <a href="{{ route('divindades.edit', $divindade->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playPage()" title="Editar pergaminho">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </a>
                        <form action="{{ route('divindades.destroy', $divindade->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar esta divindade?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-parchment-800 hover:text-blood-700 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playSword()" title="Destruir pergaminho">
                                <i class="fa-solid fa-fire"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <div class="bg-parchment-800 text-parchment-100 rounded-full w-12 h-12 flex items-center justify-center font-cinzel font-bold text-xl mr-4 border-2 border-parchment-400 shadow-inner">
                        <i class="fa-solid fa-sun"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-cinzel font-bold text-parchment-900">{{ $divindade->nome }}</h2>
                        <p class="text-sm text-blood-700 font-lora italic leading-tight">{{ $divindade->titulo }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4 text-sm font-cinzel">
                    <div>
                        <span class="text-xs text-parchment-800 block uppercase">Tendência</span>
                        <span class="text-parchment-900 font-bold">{{ $divindade->tendencia ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-xs text-parchment-800 block uppercase">Arma</span>
                        <span class="text-parchment-900 font-bold">{{ $divindade->arma_preferida ?: 'N/A' }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="text-xs text-parchment-800 block uppercase font-cinzel mb-1">Domínios</span>
                    <div class="flex flex-wrap gap-1">
                        @foreach(explode(',', $divindade->dominios) as $dominio)
                            <span class="bg-parchment-300 text-parchment-900 text-[10px] px-2 py-0.5 rounded border border-parchment-400">
                                {{ trim($dominio) }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-parchment-400 pt-3">
                    <p class="text-parchment-900 text-sm font-lora line-clamp-3 italic leading-relaxed">
                        {{ $divindade->descricao ?: 'Sua lenda ainda não foi escrita...' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
