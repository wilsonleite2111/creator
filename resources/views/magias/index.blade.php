@extends('layouts.app')

@section('title', 'Grimório de Magias')

@section('content')
<div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
    <div>
        <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
            <i class="fa-solid fa-wand-sparkles text-magic-600 mr-3"></i>Grimório de Magias
        </h1>
        <p class="text-parchment-800 mt-2 italic font-lora">"O conhecimento arcano e divino registrado para a eternidade."</p>
    </div>
    <a href="{{ route('magias.create') }}" class="btn-medieval bg-magic-600 text-white px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center" @mouseenter="playHover()" @click="playSword()">
        <i class="fa-solid fa-plus mr-2"></i> Nova Magia
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="glass-parchment p-4 rounded-lg flex items-center space-x-4 border border-parchment-400">
        <div class="bg-magic-100 p-3 rounded-full text-magic-600">
            <i class="fa-solid fa-book-sparkles text-2xl"></i>
        </div>
        <div>
            <p class="text-xs uppercase font-bold text-parchment-700">Total de Magias</p>
            <p class="text-2xl font-cinzel font-bold text-parchment-900">{{ $magias->count() }}</p>
        </div>
    </div>
</div>

<div class="glass-parchment rounded-lg shadow-xl overflow-hidden border border-parchment-400">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-parchment-300 text-parchment-900 font-cinzel uppercase text-sm border-b border-parchment-400">
                <th class="px-6 py-4">Nome</th>
                <th class="px-6 py-4">Escola</th>
                <th class="px-6 py-4">Classes / Nível</th>
                <th class="px-6 py-4">Componentes</th>
                <th class="px-6 py-4">Versão</th>
                <th class="px-6 py-4 text-center">Ações</th>
            </tr>
        </thead>
        <tbody class="font-lora text-parchment-900">
            @foreach($magias as $magia)
            <tr class="border-b border-parchment-300 hover:bg-parchment-200 transition-colors" @mouseenter="playHover()">
                <td class="px-6 py-4 font-bold">{{ $magia->nome }}</td>
                <td class="px-6 py-4">{{ $magia->escola }}</td>
                <td class="px-6 py-4">
                    @foreach($magia->classes as $classe)
                        <span class="bg-parchment-300 text-[10px] px-2 py-1 rounded-full mr-1">
                            {{ $classe->nome }} ({{ $magia->classes->find($classe->id)->pivot->nivel }})
                        </span>
                    @endforeach
                </td>
                <td class="px-6 py-4">{{ $magia->componentes }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 rounded text-xs font-bold {{ $magia->versao == '3.5' ? 'bg-blood-100 text-blood-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $magia->versao }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center space-x-3">
                        <a href="{{ route('magias.show', $magia) }}" class="text-magic-600 hover:text-magic-800 transition text-lg" title="Ver Pergaminho">
                            <i class="fa-solid fa-scroll"></i>
                        </a>
                        <a href="{{ route('magias.edit', $magia) }}" class="text-blue-600 hover:text-blue-800 transition text-lg" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('magias.destroy', $magia) }}" method="POST" onsubmit="return confirm('Deseja dissipar esta magia para sempre?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blood-600 hover:text-blood-800 transition text-lg" title="Excluir">
                                <i class="fa-solid fa-fire-burner"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @if($magias->isEmpty())
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-parchment-700 italic">
                    <i class="fa-solid fa-feather-pointed text-4xl mb-4 block opacity-30"></i>
                    Nenhuma magia registrada neste grimório ainda.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
