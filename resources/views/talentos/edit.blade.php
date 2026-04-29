@extends('layouts.app')

@section('title', 'Alterar Tomo de Talento')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Alterar Talento
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Reescrevendo a essência de: {{ $talento->nome }}"</p>
        </div>
        <a href="{{ route('talentos.index') }}" class="text-parchment-800 hover:text-magic-600 font-cinzel font-bold flex items-center transition" @mouseenter="playHover()">
            <i class="fa-solid fa-reply mr-2"></i> Voltar
        </a>
    </div>

    <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl relative overflow-hidden">
        <form action="{{ route('talentos.update', $talento->id) }}" method="POST" class="space-y-6 relative z-10" @submit="playMagic()">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nome" class="block text-parchment-900 font-cinzel font-bold mb-2">Nome do Talento</label>
                    <input type="text" name="nome" id="nome" value="{{ $talento->nome }}" required
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>

                <!-- Versão -->
                <div>
                    <label for="versao" class="block text-parchment-900 font-cinzel font-bold mb-2">Versão/Edição</label>
                    <select name="versao" id="versao" 
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                        <option value="5.0" {{ $talento->versao == '5.0' ? 'selected' : '' }}>D&D 5.0</option>
                        <option value="3.5" {{ $talento->versao == '3.5' ? 'selected' : '' }}>D&D 3.5</option>
                        <option value="AD&D" {{ $talento->versao == 'AD&D' ? 'selected' : '' }}>AD&D</option>
                        <option value="Custom" {{ $talento->versao == 'Custom' ? 'selected' : '' }}>Custom</option>
                    </select>
                </div>

                <!-- Tipo -->
                <div class="col-span-2 md:col-span-1">
                    <label for="tipo" class="block text-parchment-900 font-cinzel font-bold mb-2">Tipo de Talento</label>
                    <input type="text" name="tipo" id="tipo" value="{{ $talento->tipo }}"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>

                <!-- Pré-requisitos -->
                <div class="col-span-2">
                    <label for="pre_requisitos" class="block text-parchment-900 font-cinzel font-bold mb-2">Pré-requisitos</label>
                    <input type="text" name="pre_requisitos" id="pre_requisitos" value="{{ $talento->pre_requisitos }}"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>
            </div>

            <!-- Benefício -->
            <div>
                <label for="beneficio" class="block text-parchment-900 font-cinzel font-bold mb-2">Benefício (Efeito)</label>
                <textarea name="beneficio" id="beneficio" rows="4" required
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">{{ $talento->beneficio }}</textarea>
            </div>

            <!-- Descrição (Lore) -->
            <div>
                <label for="descricao" class="block text-parchment-900 font-cinzel font-bold mb-2">Descrição (Histórico/Lore)</label>
                <textarea name="descricao" id="descricao" rows="2"
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner italic">{{ $talento->descricao }}</textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-3 px-10 rounded-lg border-2 border-magic-700 shadow-lg text-xl tracking-widest">
                    <i class="fa-solid fa-feather-pointed mr-2"></i> Atualizar Tomo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
