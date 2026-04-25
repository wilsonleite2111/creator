@extends('layouts.app')

@section('title', 'Reescrever Pergaminho da Raça')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center border-b-2 border-parchment-800 pb-4">
        <a href="{{ route('racas.index') }}" class="text-parchment-800 hover:text-magic-600 mr-4 transition" @mouseenter="playHover()" @click="playPage()">
            <i class="fa-solid fa-arrow-left text-2xl"></i>
        </a>
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm"><i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Reescrever Tomo</h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Altere os registros do povo {{ $raca->nome }}."</p>
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

        <form action="{{ route('racas.update', $raca->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div class="md:col-span-2">
                    <label for="nome" class="block font-cinzel font-bold text-parchment-900 mb-2">Nome da Raça <span class="text-blood-600">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-signature text-parchment-800"></i>
                        </div>
                        <input type="text" name="nome" id="nome" value="{{ old('nome', $raca->nome) }}" required
                            class="w-full pl-10 pr-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 focus:border-transparent font-lora text-parchment-900 placeholder-parchment-400">
                    </div>
                </div>

                <!-- Versão -->
                <div>
                    <label for="versao" class="block font-cinzel font-bold text-parchment-900 mb-2">Versão do Sistema</label>
                    <div class="relative">
                        <select name="versao" id="versao" class="w-full pl-3 pr-10 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 focus:border-transparent font-lora text-parchment-900 appearance-none">
                            <option value="3.5" {{ old('versao', $raca->versao) == '3.5' ? 'selected' : '' }}>D&D 3.5</option>
                            <option value="5.0" {{ old('versao', $raca->versao) == '5.0' ? 'selected' : '' }}>D&D 5.0</option>
                            <option value="ad&d" {{ old('versao', $raca->versao) == 'ad&d' ? 'selected' : '' }}>AD&D</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-parchment-800"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Tamanho -->
                <div>
                    <label for="tamanho" class="block font-cinzel font-bold text-parchment-900 mb-2">Tamanho</label>
                    <div class="relative">
                        <select name="tamanho" id="tamanho" class="w-full pl-3 pr-10 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 focus:border-transparent font-lora text-parchment-900 appearance-none">
                            <option value="Miúdo" {{ old('tamanho', $raca->tamanho) == 'Miúdo' ? 'selected' : '' }}>Miúdo</option>
                            <option value="Pequeno" {{ old('tamanho', $raca->tamanho) == 'Pequeno' ? 'selected' : '' }}>Pequeno</option>
                            <option value="Médio" {{ old('tamanho', $raca->tamanho) == 'Médio' ? 'selected' : '' }}>Médio</option>
                            <option value="Grande" {{ old('tamanho', $raca->tamanho) == 'Grande' ? 'selected' : '' }}>Grande</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-parchment-800"></i>
                        </div>
                    </div>
                </div>

                <!-- Deslocamento -->
                <div>
                    <label for="deslocamento" class="block font-cinzel font-bold text-parchment-900 mb-2">Deslocamento (Metros)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-shoe-prints text-parchment-800"></i>
                        </div>
                        <input type="number" name="deslocamento" id="deslocamento" value="{{ old('deslocamento', $raca->deslocamento) }}"
                            class="w-full pl-10 pr-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 focus:border-transparent font-lora text-parchment-900 placeholder-parchment-400">
                    </div>
                </div>

                <!-- Modificadores -->
                <div class="md:col-span-2 border-t border-parchment-400 pt-4 mt-2">
                    <h3 class="font-cinzel font-bold text-parchment-900 text-lg mb-4"><i class="fa-solid fa-dna mr-2"></i>Modificadores de Atributo</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach(['forca' => 'Força', 'destreza' => 'Destreza', 'constituicao' => 'Constituição', 'inteligencia' => 'Inteligência', 'sabedoria' => 'Sabedoria', 'carisma' => 'Carisma'] as $key => $label)
                        <div>
                            <label class="block font-bold text-parchment-800 mb-1">{{ $label }}</label>
                            <input type="number" name="mod_{{ $key }}" value="{{ old('mod_'.$key, $raca->{'mod_'.$key}) }}" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 font-lora text-parchment-900 text-center">
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Descrição -->
                <div class="md:col-span-2 border-t border-parchment-400 pt-4 mt-2">
                    <label for="descricao" class="block font-cinzel font-bold text-parchment-900 mb-2"><i class="fa-solid fa-scroll mr-2"></i>Descrição e Origem</label>
                    <textarea name="descricao" id="descricao" rows="5" 
                        class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-magic-600 font-lora text-parchment-900">{{ old('descricao', $raca->descricao) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-parchment-400">
                <a href="{{ route('racas.index') }}" class="mr-4 px-6 py-2 text-parchment-800 font-bold hover:text-magic-600 transition" @mouseenter="playHover()" @click="playPage()">
                    Cancelar
                </a>
                <button type="submit" class="btn-medieval bg-magic-600 hover:bg-magic-500 text-white font-cinzel font-bold py-2 px-8 rounded border border-magic-600 shadow-md inline-flex items-center" @mouseenter="playHover()" @click="playMagic()">
                    <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Atualizar Raça
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
