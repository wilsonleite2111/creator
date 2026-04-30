@extends('layouts.app')

@section('title', 'Conjurar Nova Magia')

@section('content')
<div class="mb-8 border-b-2 border-parchment-800 pb-4">
    <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
        <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Registrar Nova Magia
    </h1>
    <p class="text-parchment-800 mt-2 italic font-lora">"Transcreva as palavras de poder no grande registro arcano."</p>
</div>

<form action="{{ route('magias.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Coluna 1: Dados Básicos -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">Detalhes da Magia</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Nome da Magia</label>
                        <input type="text" name="nome" required placeholder="Ex: Bola de Fogo"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Escola</label>
                        <input type="text" name="escola" placeholder="Ex: Evocação"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Versão</label>
                        <select name="versao" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                            <option value="3.5" selected>D&D 3.5</option>
                            <option value="5.0">D&D 5.0</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Componentes</label>
                        <input type="text" name="componentes" placeholder="Ex: V, S, M (pó de ferro)"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Tempo de Execução</label>
                        <input type="text" name="tempo_execucao" placeholder="Ex: 1 ação padrão"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Alcance</label>
                        <input type="text" name="alcance" placeholder="Ex: Longo (120m + 12m/nível)"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Duração</label>
                        <input type="text" name="duracao" placeholder="Ex: Instantânea"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Alvo, Área ou Efeito</label>
                        <input type="text" name="alvo_area_efeito" placeholder="Ex: Explosão com 6m de raio"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Teste de Resistência</label>
                        <input type="text" name="teste_resistencia" placeholder="Ex: Reflexos anula"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Resistência à Magia</label>
                        <input type="text" name="resistencia_magia" placeholder="Ex: Sim"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Descrição Completa</label>
                        <textarea name="descricao" rows="6" placeholder="Descreva os efeitos mágicos em detalhes..."
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coluna 2: Níveis por Classe -->
        <div class="lg:col-span-1 space-y-6">
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6 h-full">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">Nível por Classe</h2>
                <p class="text-xs text-parchment-800 italic mb-4">Defina o nível da magia para cada classe que pode conjurá-la. Deixe em branco se não for acessível à classe.</p>
                
                <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($classes as $classe)
                    <div class="flex items-center justify-between p-3 rounded border border-parchment-300 bg-parchment-100/50">
                        <label class="font-cinzel font-bold text-parchment-900">{{ $classe->nome }}</label>
                        <div class="flex items-center space-x-2">
                            <span class="text-[10px] uppercase font-bold text-parchment-700">Nível</span>
                            <input type="number" name="niveis[{{ $classe->id }}]" min="0" max="9"
                                class="w-12 bg-white border-2 border-parchment-300 rounded p-1 text-center font-bold focus:border-magic-500">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 pt-6">
        <a href="{{ route('magias.index') }}" class="btn-medieval bg-parchment-800 text-white px-8 py-3 rounded font-cinzel shadow-lg">
            Cancelar
        </a>
        <button type="submit" class="btn-medieval bg-magic-600 text-white px-12 py-3 rounded font-cinzel font-bold shadow-xl transform hover:scale-105 transition" @click="playMagic()">
            <i class="fa-solid fa-scroll mr-2"></i> Registrar Magia
        </button>
    </div>
</form>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(90, 70, 36, 0.05);
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #5a4624;
    border-radius: 3px;
}
</style>
@endsection
