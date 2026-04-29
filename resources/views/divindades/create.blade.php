@extends('layouts.app')

@section('title', 'Clamar Nova Divindade')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Nova Divindade
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Registre uma presença divina no panteão dos heróis."</p>
        </div>
        <a href="{{ route('divindades.index') }}" class="text-parchment-800 hover:text-magic-600 font-cinzel font-bold flex items-center transition" @mouseenter="playHover()">
            <i class="fa-solid fa-reply mr-2"></i> Voltar
        </a>
    </div>

    <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl">
        <form action="{{ route('divindades.store') }}" method="POST" class="space-y-6" @submit="playMagic()">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="col-span-2 md:col-span-1">
                    <label for="nome" class="block text-parchment-900 font-cinzel font-bold mb-2">Nome do Deus</label>
                    <input type="text" name="nome" id="nome" required
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Heironeous">
                </div>

                <!-- Título -->
                <div class="col-span-2 md:col-span-1">
                    <label for="titulo" class="block text-parchment-900 font-cinzel font-bold mb-2">Título/Epíteto</label>
                    <input type="text" name="titulo" id="titulo"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: O Invencível">
                </div>

                <!-- Versão -->
                <div>
                    <label for="versao" class="block text-parchment-900 font-cinzel font-bold mb-2">Versão</label>
                    <select name="versao" id="versao" 
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner">
                        <option value="5.0">D&D 5.0</option>
                        <option value="3.5" selected>D&D 3.5</option>
                        <option value="AD&D">AD&D</option>
                    </select>
                </div>

                <!-- Tendência -->
                <div>
                    <label for="tendencia" class="block text-parchment-900 font-cinzel font-bold mb-2">Tendência</label>
                    <input type="text" name="tendencia" id="tendencia"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Leal e Bom">
                </div>

                <!-- Domínios -->
                <div class="col-span-2">
                    <label for="dominios" class="block text-parchment-900 font-cinzel font-bold mb-2">Domínios (Separados por vírgula)</label>
                    <input type="text" name="dominios" id="dominios"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Bem, Guerra, Lei, Glória">
                </div>

                <!-- Arma Preferida -->
                <div class="col-span-2 md:col-span-1">
                    <label for="arma_preferida" class="block text-parchment-900 font-cinzel font-bold mb-2">Arma Preferida</label>
                    <input type="text" name="arma_preferida" id="arma_preferida"
                        class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                        placeholder="Ex: Espada Longa">
                </div>
            </div>

            <!-- Descrição -->
            <div>
                <label for="descricao" class="block text-parchment-900 font-cinzel font-bold mb-2">Descrição e Dogmas</label>
                <textarea name="descricao" id="descricao" rows="4"
                    class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:outline-none focus:border-magic-500 transition shadow-inner"
                    placeholder="Descreva a aparência e os dogmas desta divindade..."></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-3 px-10 rounded-lg border-2 border-magic-700 shadow-lg text-xl tracking-widest">
                    <i class="fa-solid fa-sun mr-2"></i> Consagrar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
