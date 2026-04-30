@extends('layouts.app')

@section('title', 'Pergaminho: ' . $magia->nome)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-center">
        <a href="{{ route('magias.index') }}" class="btn-medieval bg-parchment-800 text-white px-6 py-2 rounded font-cinzel text-sm shadow-md">
            <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Grimório
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('magias.edit', $magia) }}" class="btn-medieval bg-blue-700 text-white px-6 py-2 rounded font-cinzel text-sm shadow-md">
                <i class="fa-solid fa-pen-to-square mr-2"></i> Editar
            </a>
            <button onclick="window.print()" class="btn-medieval bg-blood-700 text-white px-6 py-2 rounded font-cinzel text-sm shadow-md">
                <i class="fa-solid fa-print mr-2"></i> Imprimir
            </button>
        </div>
    </div>

    <!-- O PERGAMINHO -->
    <div class="relative bg-[#f4e8c1] p-12 lg:p-20 shadow-2xl rounded-sm border-x-[12px] border-parchment-900 overflow-hidden" 
         style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png'); min-height: 800px;">
        
        <!-- Detalhes Decorativos -->
        <div class="absolute top-0 left-0 w-full h-8 bg-gradient-to-b from-parchment-900/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-8 bg-gradient-to-t from-parchment-900/20 to-transparent"></div>
        <div class="absolute top-8 left-8 text-parchment-900 opacity-10 text-8xl">
            <i class="fa-solid fa-wand-sparkles"></i>
        </div>

        <div class="relative z-10">
            <!-- Cabeçalho do Pergaminho -->
            <div class="text-center mb-12 border-b-2 border-parchment-900 pb-8">
                <h1 class="text-6xl font-cinzel font-bold text-parchment-900 uppercase tracking-tighter mb-2">{{ $magia->nome }}</h1>
                <div class="flex justify-center space-x-4 text-xl font-cinzel font-bold text-blood-800">
                    <span>{{ $magia->escola }}</span>
                    <span>•</span>
                    <span>Versão {{ $magia->versao }}</span>
                </div>
            </div>

            <!-- Níveis -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                @foreach($magia->classes as $classe)
                    <div class="bg-parchment-900 text-parchment-100 px-4 py-2 rounded-lg font-cinzel font-bold text-sm shadow-lg transform rotate-[-1deg]">
                        {{ $classe->nome }} {{ $magia->classes->find($classe->id)->pivot->nivel }}
                    </div>
                @endforeach
            </div>

            <!-- Atributos Técnicos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mb-12 font-lora text-lg border-y-2 border-parchment-900/30 py-8">
                <div class="flex flex-col">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Componentes</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->componentes ?: 'Nenhum' }}</span>
                </div>
                <div class="flex flex-col text-right md:text-left">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Tempo de Execução</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->tempo_execucao ?: 'Imediato' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Alcance</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->alcance ?: 'Pessoal' }}</span>
                </div>
                <div class="flex flex-col text-right md:text-left">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Duração</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->duracao ?: 'Instantânea' }}</span>
                </div>
                <div class="flex flex-col col-span-2">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Alvo, Área ou Efeito</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->alvo_area_efeito ?: 'Variável' }}</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Teste de Resistência</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->teste_resistencia ?: 'Nenhum' }}</span>
                </div>
                <div class="flex flex-col text-right md:text-left">
                    <span class="text-xs uppercase font-bold text-blood-700 tracking-widest mb-1">Resistência à Magia</span>
                    <span class="text-parchment-900 font-bold italic">{{ $magia->resistencia_magia ?: 'Não' }}</span>
                </div>
            </div>

            <!-- Descrição Narrativa -->
            <div class="prose prose-lg max-w-none text-parchment-900 font-lora leading-relaxed first-letter:text-5xl first-letter:font-cinzel first-letter:font-bold first-letter:float-left first-letter:mr-3 first-letter:text-blood-800">
                {!! nl2br(e($magia->descricao)) !!}
            </div>
        </div>

        <!-- Rodapé do Pergaminho -->
        <div class="mt-20 pt-8 border-t border-parchment-900/20 text-center text-xs font-cinzel text-parchment-800 uppercase tracking-[0.3em]">
            Selo de Autenticidade da Academia Arcana
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, .btn-medieval { display: none !important; }
    body { background: white !important; }
    .max-w-4xl { max-width: 100% !important; margin: 0 !important; }
    .relative { border: none !important; box-shadow: none !important; padding: 0 !important; }
}
</style>
@endsection
