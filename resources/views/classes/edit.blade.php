@extends('layouts.app')

@section('title', 'Reescrever Pergaminho da Classe')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center border-b-2 border-parchment-800 pb-4">
        <a href="{{ route('classes.index') }}" class="text-parchment-800 hover:text-blood-700 mr-4 transition" @mouseenter="playHover()" @click="playPage()">
            <i class="fa-solid fa-arrow-left text-2xl"></i>
        </a>
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-feather-pointed text-blood-700 mr-3"></i>Reescrever Pergaminho</h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Altere as lendas de {{ $classe->nome }}."</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 font-lora">
            <strong class="font-bold">A magia falhou!</strong>
            <ul class="list-disc mt-2 ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-lg relative">
        <div class="absolute top-0 left-0 w-8 h-8 border-t-2 border-l-2 border-parchment-800 rounded-tl-lg m-2"></div>
        <div class="absolute top-0 right-0 w-8 h-8 border-t-2 border-r-2 border-parchment-800 rounded-tr-lg m-2"></div>
        <div class="absolute bottom-0 left-0 w-8 h-8 border-b-2 border-l-2 border-parchment-800 rounded-bl-lg m-2"></div>
        <div class="absolute bottom-0 right-0 w-8 h-8 border-b-2 border-r-2 border-parchment-800 rounded-br-lg m-2"></div>

        <form action="{{ route('classes.update', $classe->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="md:col-span-2">
                    <label for="nome" class="block font-cinzel font-bold text-parchment-900 mb-2">Nome da Classe <span class="text-blood-600">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-signature text-parchment-800"></i>
                        </div>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $classe->nome) }}" required
                            class="w-full pl-10 pr-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 focus:border-transparent font-lora text-parchment-900 placeholder-parchment-400">
                    </div>
                </div>

                <!-- Versão -->
                <div>
                    <label for="versao" class="block font-cinzel font-bold text-parchment-900 mb-2">Versão do Sistema</label>
                    <div class="relative">
                        <select name="versao" id="versao" class="w-full pl-3 pr-10 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 focus:border-transparent font-lora text-parchment-900 appearance-none">
                            <option value="3.5" {{ old('versao', $classe->versao) == '3.5' ? 'selected' : '' }}>D&D 3.5</option>
                            <option value="5.0" {{ old('versao', $classe->versao) == '5.0' ? 'selected' : '' }}>D&D 5.0</option>
                            <option value="ad&d" {{ old('versao', $classe->versao) == 'ad&d' ? 'selected' : '' }}>AD&D</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-parchment-800"></i>
                        </div>
                    </div>
                </div>

                <!-- Dado de Vida -->
                <div>
                    <label for="dado_vida" class="block font-cinzel font-bold text-parchment-900 mb-2">Dado de Vida</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-dice-d20 text-magic-600"></i>
                        </div>
                        <select name="dado_vida" id="dado_vida" class="w-full pl-10 pr-10 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 focus:border-transparent font-lora text-parchment-900 appearance-none">
                            <option value="">Selecione...</option>
                            <option value="4" {{ old('dado_vida', $classe->dado_vida) == '4' ? 'selected' : '' }}>d4</option>
                            <option value="6" {{ old('dado_vida', $classe->dado_vida) == '6' ? 'selected' : '' }}>d6</option>
                            <option value="8" {{ old('dado_vida', $classe->dado_vida) == '8' ? 'selected' : '' }}>d8</option>
                            <option value="10" {{ old('dado_vida', $classe->dado_vida) == '10' ? 'selected' : '' }}>d10</option>
                            <option value="12" {{ old('dado_vida', $classe->dado_vida) == '12' ? 'selected' : '' }}>d12</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-parchment-800"></i>
                        </div>
                    </div>
                </div>

                <!-- BBA -->
                <div>
                    <label for="bba_progressao" class="block font-cinzel font-bold text-parchment-900 mb-2">Progressão de BBA</label>
                    <select name="bba_progressao" id="bba_progressao" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900">
                        <option value="">Selecione...</option>
                        <option value="ruim" {{ old('bba_progressao', $classe->bba_progressao) == 'ruim' ? 'selected' : '' }}>Ruim (+1/2)</option>
                        <option value="media" {{ old('bba_progressao', $classe->bba_progressao) == 'media' ? 'selected' : '' }}>Média (+3/4)</option>
                        <option value="boa" {{ old('bba_progressao', $classe->bba_progressao) == 'boa' ? 'selected' : '' }}>Boa (+1)</option>
                    </select>
                </div>

                <!-- Pontos de Perícia -->
                <div>
                    <label for="pontos_pericia" class="block font-cinzel font-bold text-parchment-900 mb-2">Pontos de Perícia (Nível 1)</label>
                    <div class="flex items-center space-x-2">
                        <input type="number" name="pontos_pericia" id="pontos_pericia" value="{{ old('pontos_pericia', $classe->pontos_pericia) }}" min="2" step="2"
                            class="w-24 px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900 text-center">
                        <span class="text-parchment-800 font-bold">+ Mod. Inteligência</span>
                    </div>
                </div>

                <!-- Resistências -->
                <div class="md:col-span-2 border-t border-parchment-400 pt-4 mt-2">
                    <h3 class="font-cinzel font-bold text-parchment-900 text-lg mb-4"><i class="fa-solid fa-shield-halved mr-2"></i>Testes de Resistência</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-bold text-parchment-800 mb-1">Fortitude</label>
                            <select name="resistencia_fortitude" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora">
                                <option value="">Selecione...</option>
                                <option value="ruim" {{ old('resistencia_fortitude', $classe->resistencia_fortitude) == 'ruim' ? 'selected' : '' }}>Ruim</option>
                                <option value="boa" {{ old('resistencia_fortitude', $classe->resistencia_fortitude) == 'boa' ? 'selected' : '' }}>Boa</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-parchment-800 mb-1">Reflexos</label>
                            <select name="resistencia_reflexos" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora">
                                <option value="">Selecione...</option>
                                <option value="ruim" {{ old('resistencia_reflexos', $classe->resistencia_reflexos) == 'ruim' ? 'selected' : '' }}>Ruim</option>
                                <option value="boa" {{ old('resistencia_reflexos', $classe->resistencia_reflexos) == 'boa' ? 'selected' : '' }}>Boa</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-parchment-800 mb-1">Vontade</label>
                            <select name="resistencia_vontade" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora">
                                <option value="">Selecione...</option>
                                <option value="ruim" {{ old('resistencia_vontade', $classe->resistencia_vontade) == 'ruim' ? 'selected' : '' }}>Ruim</option>
                                <option value="boa" {{ old('resistencia_vontade', $classe->resistencia_vontade) == 'boa' ? 'selected' : '' }}>Boa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="md:col-span-2 border-t border-parchment-400 pt-4 mt-2">
                    <label for="descricao" class="block font-cinzel font-bold text-parchment-900 mb-2"><i class="fa-solid fa-scroll mr-2"></i>Descrição e Lendas</label>
                    <textarea name="descricao" id="descricao" rows="5" 
                        class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900">{{ old('descricao', $classe->descricao) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-parchment-400">
                <a href="{{ route('classes.index') }}" class="mr-4 px-6 py-2 text-parchment-800 font-bold hover:text-blood-700 transition" @mouseenter="playHover()" @click="playPage()">
                    Cancelar
                </a>
                <button type="submit" class="btn-medieval bg-blood-700 hover:bg-blood-600 text-white font-cinzel font-bold py-2 px-8 rounded border border-blood-600 shadow-md inline-flex items-center" @mouseenter="playHover()" @click="playMagic()">
                    <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Atualizar Classe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
