@extends('layouts.app')

@section('title', 'Compasso de Tendências')

@section('content')
<div class="mb-8 flex justify-between items-end border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-compass text-magic-600 mr-3"></i>Tendências</h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"A bússola moral que guia o espírito dos aventureiros."</p>
    </div>
    <a href="{{ route('tendencias.create') }}" 
       class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-6 rounded border border-magic-600 shadow-md inline-flex items-center"
       @mouseenter="playHover()" @click="playMagic()">
        <i class="fa-solid fa-plus-circle mr-2"></i> Nova Tendência
    </a>
</div>

@if($tendencias->isEmpty())
    <div class="glass-parchment p-12 text-center rounded-lg border border-parchment-400">
        <i class="fa-solid fa-compass text-6xl text-parchment-400 mb-4"></i>
        <h2 class="text-2xl font-cinzel font-bold text-parchment-800">A bússola está perdida.</h2>
        <p class="mt-2 text-parchment-900">Nenhuma filosofia moral foi registrada ainda.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($tendencias as $tendencia)
            <div class="glass-parchment rounded-lg border-2 border-parchment-400 p-8 transform hover:-rotate-1 transition duration-300 relative group shadow-lg"
                 x-data="{ showActions: false }" 
                 @mouseenter="showActions = true; playHover()" 
                 @mouseleave="showActions = false">
                
                <div class="absolute top-0 right-0 p-3" x-show="showActions" x-transition.opacity style="display: none;">
                    <div class="flex space-x-2">
                        <a href="{{ route('tendencias.edit', $tendencia->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playPage()">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </a>
                        <form action="{{ route('tendencias.destroy', $tendencia->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar esta tendência?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-parchment-800 hover:text-blood-700 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playSword()">
                                <i class="fa-solid fa-fire"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-center mb-6">
                    <div class="inline-block bg-parchment-900 text-parchment-100 font-cinzel font-bold text-4xl p-4 rounded-lg border-4 border-parchment-400 shadow-inner mb-4 w-20 h-20 flex items-center justify-center">
                        {{ $tendencia->iniciais }}
                    </div>
                    <h2 class="text-3xl font-cinzel font-bold text-parchment-900">{{ $tendencia->nome }}</h2>
                    <p class="text-blood-700 font-lora italic font-bold uppercase tracking-widest text-sm">{{ $tendencia->apelido }}</p>
                </div>

                <div class="border-t border-parchment-400 pt-4">
                    <p class="text-parchment-900 text-sm font-lora leading-relaxed text-justify">
                        {{ $tendencia->descricao }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
