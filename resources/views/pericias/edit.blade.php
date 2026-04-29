@extends('layouts.app')

@section('title', 'Editar Perícia: ' . $pericia->nome)

@section('content')
<div class="glass-parchment p-8 rounded-lg max-w-4xl mx-auto">
    <div class="mb-8 border-b border-parchment-400 pb-4">
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900">
            <i class="fa-solid fa-feather mr-3 text-magic-600"></i>Editar Perícia: {{ $pericia->nome }}
        </h1>
        <p class="text-parchment-800 font-lora mt-2 italic">Modifique os registros desta habilidade antiga.</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 font-lora" role="alert">
            <strong class="font-bold">A magia falhou!</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pericias.update', $pericia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Nome -->
            <div>
                <label for="nome" class="block font-cinzel font-bold text-parchment-900 mb-2">Nome da Perícia *</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $pericia->nome) }}" required 
                    class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900">
            </div>

            <!-- Versão -->
            <div>
                <label for="versao" class="block font-cinzel font-bold text-parchment-900 mb-2">Edição/Versão</label>
                <input type="text" name="versao" id="versao" value="{{ old('versao', $pericia->versao) }}" 
                    class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900">
            </div>

            <!-- Habilidade Chave -->
            <div class="md:col-span-2">
                <label for="habilidade_chave" class="block font-cinzel font-bold text-parchment-900 mb-2">Habilidade Chave</label>
                <select name="habilidade_chave" id="habilidade_chave" class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora">
                    <option value="">Nenhuma / Varia</option>
                    <option value="FOR" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'FOR' ? 'selected' : '' }}>Força (FOR)</option>
                    <option value="DES" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'DES' ? 'selected' : '' }}>Destreza (DES)</option>
                    <option value="CON" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'CON' ? 'selected' : '' }}>Constituição (CON)</option>
                    <option value="INT" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'INT' ? 'selected' : '' }}>Inteligência (INT)</option>
                    <option value="SAB" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'SAB' ? 'selected' : '' }}>Sabedoria (SAB)</option>
                    <option value="CAR" {{ old('habilidade_chave', $pericia->habilidade_chave) == 'CAR' ? 'selected' : '' }}>Carisma (CAR)</option>
                </select>
            </div>

            <!-- Descrição -->
            <div class="md:col-span-2 border-t border-parchment-400 pt-4 mt-2">
                <label for="descricao" class="block font-cinzel font-bold text-parchment-900 mb-2"><i class="fa-solid fa-scroll mr-2"></i>Descrição</label>
                <textarea name="descricao" id="descricao" rows="5" 
                    class="w-full px-3 py-2 bg-parchment-100 border border-parchment-400 rounded focus:outline-none focus:ring-2 focus:ring-blood-600 font-lora text-parchment-900">{{ old('descricao', $pericia->descricao) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-parchment-400">
            <a href="{{ route('pericias.index') }}" class="mr-4 px-6 py-2 text-parchment-800 font-bold hover:text-blood-700 transition" @mouseenter="playHover()" @click="playPage()">
                Cancelar
            </a>
            <button type="submit" class="btn-medieval bg-blood-700 hover:bg-blood-600 text-white font-cinzel font-bold py-2 px-8 rounded border border-blood-600 shadow-md inline-flex items-center" @mouseenter="playHover()" @click="playSword()">
                <i class="fa-solid fa-pen-nib mr-2"></i> Atualizar Perícia
            </button>
        </div>
    </form>
</div>
@endsection
