@extends('layouts.app')

@section('title', 'Documentar Novo Talento')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Novo Talento
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Registre uma nova habilidade extraordinária nos anais da história."</p>
        </div>
        <a href="{{ route('talentos.index') }}" class="text-parchment-800 hover:text-magic-600 font-cinzel font-bold flex items-center transition" @mouseenter="playHover()">
            <i class="fa-solid fa-reply mr-2"></i> Voltar
        </a>
    </div>

    <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl relative overflow-hidden">
        <!-- Detalhe decorativo de pergaminho -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-parchment-300 rounded-full opacity-20 border-4 border-parchment-400"></div>
        
        <form action="{{ route('talentos.store') }}" method="POST" class="space-y-6 relative z-10" @submit="playMagic()">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nome" class="block text-parchment-900 font-cinzel font-bold mb-2">Nome do Talento</label>
                    <input type="text" name="nome" id="nome" required
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Sucesso Decisivo Aprimorado">
                </div>

                <!-- Versão -->
                <div>
                    <label for="versao" class="block text-parchment-900 font-cinzel font-bold mb-2">Versão/Edição</label>
                    <select name="versao" id="versao" 
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                        <option value="5.0">D&D 5.0</option>
                        <option value="3.5" selected>D&D 3.5</option>
                        <option value="AD&D">AD&D</option>
                        <option value="Custom">Custom</option>
                    </select>
                </div>

                <!-- Tipo -->
                <div class="col-span-2 md:col-span-1">
                    <label for="tipo" class="block text-parchment-900 font-cinzel font-bold mb-2">Tipo de Talento</label>
                    <input type="text" name="tipo" id="tipo"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Combate, Geral, Criação de Itens">
                </div>

                <!-- Pré-requisitos -->
                <div class="col-span-2">
                    <label for="pre_requisitos" class="block text-parchment-900 font-cinzel font-bold mb-2">Pré-requisitos</label>
                    <input type="text" name="pre_requisitos" id="pre_requisitos"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Força 13, Ataque Poderoso, BBA +1">
                </div>
            </div>

            <!-- Benefício -->
            <div>
                <label for="beneficio" class="block text-parchment-900 font-cinzel font-bold mb-2">Benefício (Efeito)</label>
                <textarea name="beneficio" id="beneficio" rows="4" required
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                    placeholder="Descreva o que o talento concede ao herói..."></textarea>
            </div>

            <!-- Descrição (Lore) -->
            <div>
                <label for="descricao" class="block text-parchment-900 font-cinzel font-bold mb-2">Descrição (Histórico/Lore)</label>
                <textarea name="descricao" id="descricao" rows="2"
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner italic"
                    placeholder="Uma breve citação ou contexto histórico do talento..."></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-3 px-10 rounded-lg border-2 border-magic-700 shadow-lg text-xl tracking-widest">
                    <i class="fa-solid fa-scroll mr-2"></i> Selar Pergaminho
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
