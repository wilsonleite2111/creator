@extends('layouts.app')

@section('title', 'Alterar Tendência')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Alterar Tendência
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Ajustando os rumos de: {{ $tendencia->nome }}"</p>
        </div>
        <a href="{{ route('tendencias.index') }}" class="text-parchment-800 hover:text-magic-600 font-cinzel font-bold flex items-center transition" @mouseenter="playHover()">
            <i class="fa-solid fa-reply mr-2"></i> Voltar
        </a>
    </div>

    <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl">
        <form action="{{ route('tendencias.update', $tendencia->id) }}" method="POST" class="space-y-6" @submit="playMagic()">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nome" class="block text-parchment-900 font-cinzel font-bold mb-2">Nome da Tendência</label>
                    <input type="text" name="nome" id="nome" value="{{ $tendencia->nome }}" required
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>

                <!-- Apelido -->
                <div class="col-span-2 md:col-span-1">
                    <label for="apelido" class="block text-parchment-900 font-cinzel font-bold mb-2">Apelido/Título</label>
                    <input type="text" name="apelido" id="apelido" value="{{ $tendencia->apelido }}" required
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>

                <!-- Iniciais -->
                <div>
                    <label for="iniciais" class="block text-parchment-900 font-cinzel font-bold mb-2">Iniciais (Sigla)</label>
                    <input type="text" name="iniciais" id="iniciais" value="{{ $tendencia->iniciais }}" required maxlength="10"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                </div>
            </div>

            <!-- Descrição -->
            <div>
                <label for="descricao" class="block text-parchment-900 font-cinzel font-bold mb-2">Descrição da Filosofia</label>
                <textarea name="descricao" id="descricao" rows="6" required
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">{{ $tendencia->descricao }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-3 px-10 rounded-lg border-2 border-magic-700 shadow-lg text-xl tracking-widest">
                    <i class="fa-solid fa-feather-pointed mr-2"></i> Atualizar Norte
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
