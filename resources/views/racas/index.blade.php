@extends('layouts.app')

@section('title', 'Tomos de Raças')

@section('content')
<div class="mb-8 flex justify-between items-end border-b-2 border-parchment-800 pb-4">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-users text-magic-600 mr-3"></i>Tomos de Raças</h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"Descubra as linhagens ancestrais e suas heranças."</p>
    </div>
    <a href="{{ route('racas.create') }}" 
       class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-6 rounded border border-magic-600 shadow-md inline-flex items-center"
       @mouseenter="playHover()" @click="playMagic()">
        <i class="fa-solid fa-plus-circle mr-2"></i> Nova Raça
    </a>
</div>

@if($racas->isEmpty())
    <div class="glass-parchment p-12 text-center rounded-lg border border-parchment-400">
        <i class="fa-solid fa-book-open text-6xl text-parchment-400 mb-4"></i>
        <h2 class="text-2xl font-cinzel font-bold text-parchment-800">Os Tomos estão vazios.</h2>
        <p class="mt-2 text-parchment-900">Nenhuma raça foi documentada ainda. Seja o primeiro a descrever seu povo.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($racas as $raca)
            <div class="glass-parchment rounded-lg border border-parchment-400 p-6 transform hover:scale-105 transition duration-300 relative group cursor-pointer"
                 x-data="{ showActions: false }" 
                 @mouseenter="showActions = true; playHover()" 
                 @mouseleave="showActions = false">
                
                <div class="absolute top-0 right-0 p-3" x-show="showActions" x-transition.opacity style="display: none;">
                    <div class="flex space-x-2">
                        <a href="{{ route('racas.edit', $raca->id) }}" class="text-parchment-800 hover:text-magic-600 bg-parchment-200 p-2 rounded-full shadow-sm border border-parchment-300" @click="playPage()" title="Editar pergaminho">
                            <i class="fa-solid fa-feather-pointed"></i>
                        </a>
                        <form action="{{ route('racas.destroy', $raca->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar esta raça dos tomos?');">
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
                        {{ substr($raca->nome, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-cinzel font-bold text-parchment-900">{{ $raca->nome }}</h2>
                        <span class="inline-block bg-parchment-300 text-parchment-900 text-xs px-2 py-1 rounded font-bold uppercase tracking-wider border border-parchment-400">
                            {{ $raca->versao ?: 'D&D' }}
                        </span>
                    </div>
                </div>
                
                <p class="text-parchment-900 line-clamp-3 mb-4 font-lora italic h-16">
                    {{ $raca->descricao ?: 'Nenhuma lenda escrita para esta raça ainda...' }}
                </p>

                <div class="grid grid-cols-2 gap-2 text-sm text-parchment-800 font-bold border-t border-parchment-400 pt-4">
                    <div class="flex items-center">
                        <i class="fa-solid fa-expand text-magic-600 mr-2 w-4 text-center"></i> 
                        Tam: {{ ucfirst($raca->tamanho ?: '?') }}
                    </div>
                    <div class="flex items-center">
                        <i class="fa-solid fa-shoe-prints text-blood-600 mr-2 w-4 text-center"></i> 
                        Desl: {{ $raca->deslocamento ?: '?' }}m
                    </div>
                    <div class="col-span-2 flex items-center mt-1 text-xs">
                        <i class="fa-solid fa-dna text-parchment-800 mr-2 w-4 text-center"></i> 
                        FOR {{ $raca->mod_forca > 0 ? '+'.$raca->mod_forca : $raca->mod_forca }} | 
                        DES {{ $raca->mod_destreza > 0 ? '+'.$raca->mod_destreza : $raca->mod_destreza }} | 
                        CON {{ $raca->mod_constituicao > 0 ? '+'.$raca->mod_constituicao : $raca->mod_constituicao }} | 
                        INT {{ $raca->mod_inteligencia > 0 ? '+'.$raca->mod_inteligencia : $raca->mod_inteligencia }} | 
                        SAB {{ $raca->mod_sabedoria > 0 ? '+'.$raca->mod_sabedoria : $raca->mod_sabedoria }} | 
                        CAR {{ $raca->mod_carisma > 0 ? '+'.$raca->mod_carisma : $raca->mod_carisma }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
