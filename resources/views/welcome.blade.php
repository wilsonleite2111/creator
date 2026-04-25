@extends('layouts.app')

@section('title', 'Início')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh]">
    <div class="text-center mb-12">
        <h1 class="text-6xl font-cinzel font-bold text-parchment-900 drop-shadow-sm mb-4">
            <i class="fa-solid fa-dragon text-blood-700 mr-4"></i>Creator RPG
        </h1>
        <p class="text-xl text-parchment-800 italic font-lora max-w-2xl mx-auto">
            "Bem-vindo ao reino da criação. Forje heróis lendários, defina seus caminhos e prepare-se para a aventura."
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">
        <!-- Card Classes -->
        <a href="{{ route('classes.index') }}" 
           class="glass-parchment rounded-xl border-2 border-parchment-400 p-8 transform hover:scale-105 hover:border-blood-600 transition duration-300 relative group cursor-pointer flex flex-col items-center text-center shadow-lg"
           @mouseenter="playHover()" @click="playPage()">
            <div class="bg-parchment-200 rounded-full w-24 h-24 flex items-center justify-center border-4 border-parchment-400 shadow-inner mb-6 group-hover:border-blood-600 group-hover:shadow-blood-600/50 transition duration-300">
                <i class="fa-solid fa-khanda text-4xl text-parchment-800 group-hover:text-blood-700 transition duration-300"></i>
            </div>
            <h2 class="text-3xl font-cinzel font-bold text-parchment-900 mb-4 group-hover:text-blood-700 transition duration-300">Grimório de Classes</h2>
            <p class="text-parchment-800 font-lora italic leading-relaxed">
                Defina as vocações dos heróis. Guerreiros destemidos, magos arcanos, ladinos sorrateiros e clérigos divinos aguardam para serem descritos em suas páginas.
            </p>
        </a>

        <!-- Card Raças -->
        <a href="/racas" 
           class="glass-parchment rounded-xl border-2 border-parchment-400 p-8 transform hover:scale-105 hover:border-magic-600 transition duration-300 relative group cursor-pointer flex flex-col items-center text-center shadow-lg"
           @mouseenter="playHover()" @click="playPage()">
            <div class="bg-parchment-200 rounded-full w-24 h-24 flex items-center justify-center border-4 border-parchment-400 shadow-inner mb-6 group-hover:border-magic-600 group-hover:shadow-magic-600/50 transition duration-300">
                <i class="fa-solid fa-users text-4xl text-parchment-800 group-hover:text-magic-600 transition duration-300"></i>
            </div>
            <h2 class="text-3xl font-cinzel font-bold text-parchment-900 mb-4 group-hover:text-magic-600 transition duration-300">Tomos de Raças</h2>
            <p class="text-parchment-800 font-lora italic leading-relaxed">
                Descreva as origens dos aventureiros. Humanos versáteis, elfos graciosos, anões robustos e outras linhagens ancestrais que habitam este mundo.
            </p>
        </a>
    </div>
</div>
@endsection
