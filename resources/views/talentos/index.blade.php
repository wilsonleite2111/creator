@extends('layouts.app')

@section('title', 'Tomos de Talentos')

@section('content')
<div class="mb-8 flex justify-between items-end border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-scroll text-magic-600 mr-3"></i>Tomos de Talentos</h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Habilidades extraordinárias forjadas pelo treinamento e destino."</p>
    </div>
    <a href="{{ route('talentos.create') }}" 
       class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-6 rounded border border-magic-600 shadow-md inline-flex items-center"
       @mouseenter="playHover()" @click="playMagic()">
        <i class="fa-solid fa-plus-circle mr-2"></i> Novo Talento
    </a>
</div>

@if($talentos->isEmpty())
    <div class="glass-parchment p-12 text-center rounded-lg border border-parchment-400">
        <i class="fa-solid fa-scroll text-6xl text-parchment-400 mb-4"></i>
        <h2 class="text-2xl font-cinzel font-bold text-parchment-800">Nenhum talento documentado.</h2>
        <p class="mt-2 text-parchment-900">A sabedoria dos heróis ainda não foi registrada nestes pergaminhos.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($talentos as $talento)
            <div class="glass-parchment rounded-lg border border-parchment-400 p-6 transform hover:scale-105 transition duration-300 relative group cursor-pointer"
                 x-data="{ showActions: false }" 
                 @mouseenter="showActions = true; playHover()" 
                 @mouseleave="showActions = false">
                
                <div class="absolute top-0 right-0 p-3" x-show="showActions" x-transition.opacity style="display: none;">
                    <div class="flex space-x-2">
                        <a href="{{ route('talentos.edit', $talento->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playPage()" title="Editar pergaminho">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </a>
                        <form action="{{ route('talentos.destroy', $talento->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar este talento?');">
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
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-cinzel font-bold text-parchment-900">{{ $talento->nome }}</h2>
                        <div class="flex space-x-2 mt-1">
                            <span class="inline-block bg-parchment-300 text-parchment-900 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider border border-parchment-400">
                                {{ $talento->versao ?: 'D&D' }}
                            </span>
                            <span class="inline-block bg-magic-100 text-magic-800 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider border border-magic-200">
                                {{ $talento->tipo ?: 'Geral' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                @if($talento->pre_requisitos)
                <div class="mb-3">
                    <p class="text-xs font-bold text-parchment-800 uppercase tracking-tighter mb-1">Pré-requisitos:</p>
                    <p class="text-sm text-blood-700 italic font-lora">
                        {{ $talento->pre_requisitos }}
                    </p>
                </div>
                @endif

                <div class="mb-4">
                    <p class="text-xs font-bold text-parchment-800 uppercase tracking-tighter mb-1">Benefício:</p>
                    <p class="text-parchment-900 line-clamp-4 font-lora text-sm leading-relaxed">
                        {{ $talento->beneficio ?: 'Nenhum benefício descrito...' }}
                    </p>
                </div>

                @if($talento->descricao)
                <div class="border-t border-parchment-400 pt-3">
                     <p class="text-xs text-parchment-700 line-clamp-2 italic">
                        {{ $talento->descricao }}
                    </p>
                </div>
                @endif
            </div>
        @endforeach
    </div>
@endif

@endsection
