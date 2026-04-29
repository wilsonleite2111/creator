@extends('layouts.app')

@section('title', 'Salão dos Heróis')

@section('content')
<div class="mb-8 flex justify-between items-end border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-scroll text-magic-600 mr-3"></i>Salão dos Heróis</h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Onde as lendas são registradas para a eternidade."</p>
    </div>
    <a href="{{ route('fichas.create') }}" 
       class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-6 rounded border border-magic-600 shadow-md inline-flex items-center"
       @mouseenter="playHover()" @click="playMagic()">
        <i class="fa-solid fa-plus-circle mr-2"></i> Nova Ficha
    </a>
</div>

@if($fichas->isEmpty())
    <div class="glass-parchment p-12 text-center rounded-lg border border-parchment-400">
        <i class="fa-solid fa-users-slash text-6xl text-parchment-400 mb-4"></i>
        <h2 class="text-2xl font-cinzel font-bold text-parchment-800">Nenhum herói caminhou por aqui ainda.</h2>
        <p class="mt-2 text-parchment-900">Comece a forjar seu primeiro aventureiro.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($fichas as $ficha)
            <div class="glass-parchment rounded-lg border border-parchment-400 p-6 transform hover:scale-105 transition duration-300 relative group cursor-pointer"
                 x-data="{ showActions: false }" 
                 @mouseenter="showActions = true; playHover()" 
                 @mouseleave="showActions = false">
                
                <div class="absolute top-0 right-0 p-3" x-show="showActions" x-transition.opacity style="display: none;">
                    <div class="flex space-x-2">
                        <a href="{{ route('fichas.show', $ficha->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playPage()">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{ route('fichas.destroy', $ficha->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente apagar esta ficha?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-parchment-800 hover:text-blood-700 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playSword()">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="flex items-center mb-4">
                    <div class="bg-blood-700 text-parchment-100 rounded shadow w-14 h-14 flex items-center justify-center font-cinzel font-bold text-2xl mr-4 border-2 border-parchment-400">
                        {{ $ficha->nivel }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-cinzel font-bold text-parchment-900">{{ $ficha->nome_personagem }}</h2>
                        <p class="text-sm text-parchment-800 font-lora italic">
                            {{ $ficha->raca->nome }} {{ $ficha->classe->nome }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 text-center mb-4">
                    <div class="bg-parchment-200 p-2 rounded border border-parchment-300">
                        <span class="text-[10px] uppercase block font-cinzel">PV</span>
                        <span class="font-bold text-blood-700">{{ $ficha->pv_atual }}/{{ $ficha->pv_max }}</span>
                    </div>
                    <div class="bg-parchment-200 p-2 rounded border border-parchment-300">
                        <span class="text-[10px] uppercase block font-cinzel">BBA</span>
                        <span class="font-bold text-magic-700">+{{ $ficha->bab }}</span>
                    </div>
                    <div class="bg-parchment-200 p-2 rounded border border-parchment-300">
                        <span class="text-[10px] uppercase block font-cinzel">Jogador</span>
                        <span class="font-bold text-xs truncate">{{ $ficha->nome_jogador }}</span>
                    </div>
                </div>

                <div class="border-t border-parchment-400 pt-3 flex justify-between items-center text-xs font-cinzel text-parchment-700">
                    <span>Criado em {{ $ficha->created_at->format('d/m/Y') }}</span>
                    <span class="bg-parchment-800 text-parchment-100 px-2 py-0.5 rounded italic">D&D 3.5</span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
