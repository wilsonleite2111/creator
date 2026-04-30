@extends('layouts.app')

@section('title', 'Forjar Novo Herói - Ficha D&D 3.5')

@section('content')
<div x-data="characterCreator()" x-init="init()" class="max-w-7xl mx-auto">
    <!-- Header Decorativo -->
    <div class="mb-6 border-b-4 border-parchment-900 pb-2 flex items-center justify-between">
        <div>
            <h1 class="text-5xl font-cinzel font-bold text-parchment-900 tracking-tighter uppercase">
                <i class="fa-solid fa-scroll-torah text-blood-700 mr-2"></i>Ficha de Personagem
            </h1>
            <p class="text-parchment-800 font-cinzel font-bold text-sm tracking-widest mt-1">Dungeons & Dragons Edição 3.5</p>
        </div>
        <div class="text-right">
            <button type="submit" form="main-form" class="btn-medieval bg-blood-700 text-white font-cinzel py-3 px-10 rounded shadow-xl hover:bg-blood-800 transform hover:scale-105 transition flex items-center text-xl">
                <i class="fa-solid fa-dragon mr-3"></i> FINALIZAR HERÓI
            </button>
        </div>
    </div>

    <form id="main-form" action="{{ route('fichas.store') }}" method="POST" @submit="playMagic()">
        @csrf

        <!-- SEÇÃO 1: CABEÇALHO (INFORMAÇÕES BÁSICAS) -->
        <div class="glass-parchment p-6 rounded border-2 border-parchment-900 mb-6 shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-x-6 gap-y-4">
                <div class="md:col-span-4">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Nome do Personagem</label>
                    <input type="text" name="nome_personagem" x-model="form.nome_personagem" required
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-xl px-1">
                </div>
                <div class="md:col-span-4">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Classe e Nível</label>
                    <div class="flex items-end space-x-2">
                        <select name="classe_id" x-model="form.classe_id" @change="updateClass()" required
                            class="flex-grow bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1 appearance-none">
                            <option value="">Escolha...</option>
                            <template x-for="classe in classes" :key="classe.id">
                                <option :value="classe.id" x-text="classe.nome"></option>
                            </template>
                        </select>
                        <input type="number" name="nivel" x-model.number="form.nivel" min="1" max="20" @change="calculateProgression()"
                            class="w-16 bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg text-center">
                    </div>
                </div>
                <div class="md:col-span-4">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Nome do Jogador</label>
                    <input type="text" name="nome_jogador" x-model="form.nome_jogador" required
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>

                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Raça</label>
                    <select name="raca_id" x-model="form.raca_id" @change="updateRace()" required
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1 appearance-none">
                        <option value="">Escolha...</option>
                        <template x-for="raca in racas" :key="raca.id">
                            <option :value="raca.id" x-text="raca.nome"></option>
                        </template>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Tendência</label>
                    <select name="tendencia_id" x-model="form.tendencia_id" required
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1 appearance-none">
                        <option value="">Escolha...</option>
                        <template x-for="tend in tendencias" :key="tend.id">
                            <option :value="tend.id" x-text="tend.nome"></option>
                        </template>
                    </select>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Divindade</label>
                    <input type="text" name="divindade" x-model="form.divindade"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Tamanho</label>
                    <input type="text" name="tamanho" x-model="form.tamanho"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Idade</label>
                    <input type="number" name="idade" x-model.number="form.idade"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Sexo</label>
                    <input type="text" name="sexo" x-model="form.sexo"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Altura</label>
                    <input type="text" name="altura" x-model="form.altura"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Peso</label>
                    <input type="text" name="peso" x-model="form.peso"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Olhos</label>
                    <input type="text" name="olhos" x-model="form.olhos"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Cabelo</label>
                    <input type="text" name="cabelos" x-model="form.cabelos"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-bold uppercase text-parchment-900 mb-1">Pele</label>
                    <input type="text" name="pele" x-model="form.pele"
                        class="w-full bg-transparent border-b border-parchment-800 focus:outline-none font-lora text-lg px-1">
                </div>
                
                <!-- Versão do Sistema (Oculto mas necessário) -->
                <input type="hidden" name="versao" value="3.5">
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- COLUNA ESQUERDA: ATRIBUTOS -->
            <div class="lg:col-span-3 space-y-4">
                <div class="bg-parchment-900 p-1 rounded-t shadow-inner">
                    <h3 class="text-parchment-100 text-center font-cinzel font-bold text-xs uppercase tracking-widest">Habilidades</h3>
                </div>
                <template x-for="attr in attributes" :key="attr.key">
                    <div class="flex items-center space-x-2">
                        <div class="w-20 text-right">
                            <label class="block text-[9px] font-bold text-parchment-900 uppercase leading-tight" x-text="attr.label"></label>
                            <span class="text-[7px] text-parchment-700 uppercase tracking-tighter" x-text="attr.sub"></span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="relative group">
                                <input type="number" :name="attr.key + '_base'" x-model.number="form[attr.key + '_base']" @input="calculateMods()"
                                    class="w-16 h-16 border-2 border-parchment-900 rounded-lg bg-white text-center font-cinzel font-bold text-2xl shadow-md focus:ring-2 focus:ring-blood-700 outline-none">
                                <button type="button" @click="rollStat(attr.key)" class="absolute -right-6 top-1/2 -translate-y-1/2 text-blood-700 opacity-50 hover:opacity-100 transition">
                                    <i class="fa-solid fa-dice-d20"></i>
                                </button>
                            </div>
                            <div class="mt-[-10px] bg-parchment-900 text-parchment-100 w-12 h-8 rounded border-2 border-white flex items-center justify-center font-cinzel font-bold text-lg z-10"
                                x-text="formatMod(getMod(attr.key))">
                            </div>
                        </div>
                        <div class="flex-grow space-y-1">
                            <div class="flex justify-between border-b border-parchment-300 px-1">
                                <span class="text-[8px] text-parchment-700">Racial:</span>
                                <span class="text-[10px] font-bold" :class="getRacialMod(attr.key) >= 0 ? 'text-green-700' : 'text-blood-700'" x-text="formatMod(getRacialMod(attr.key))"></span>
                            </div>
                            <div class="flex justify-between border-b border-parchment-300 px-1">
                                <span class="text-[8px] text-parchment-700">Equip:</span>
                                <span class="text-[10px] font-bold text-magic-600">+0</span>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="mt-4 p-4 glass-parchment border border-dashed border-parchment-400 text-center">
                    <button type="button" @click="rollAllStats()" class="btn-medieval bg-blood-700 text-white px-4 py-2 rounded text-xs font-cinzel">
                        <i class="fa-solid fa-dice-d20 mr-1"></i> Rolar Atributos
                    </button>
                </div>
            </div>

            <!-- COLUNA CENTRAL: COMBATE E DEFESA -->
            <div class="lg:col-span-6 space-y-6">
                <!-- HP E SPEED -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="border-2 border-parchment-900 p-2 relative bg-white/50">
                        <div class="absolute -top-3 left-4 bg-parchment-100 px-2 font-cinzel font-bold text-xs border border-parchment-900">PONTOS DE VIDA</div>
                        <div class="flex items-center space-x-2 mt-2">
                            <div class="flex-grow">
                                <label class="block text-[8px] font-bold text-parchment-700">TOTAL</label>
                                <input type="number" name="pv_max" x-model.number="form.pv_max"
                                    class="w-full bg-transparent border-b-2 border-parchment-900 font-cinzel font-bold text-2xl text-center focus:outline-none">
                            </div>
                            <div class="w-1/2">
                                <button type="button" @click="rollHP()" class="w-full h-full bg-blood-700 text-white rounded text-[10px] font-bold hover:bg-blood-800">ROLAR DADOS DE VIDA</button>
                            </div>
                        </div>
                        <div class="mt-2 text-[10px] italic text-parchment-700">Ferimentos / HP Atual: <span class="border-b border-parchment-400 w-full inline-block"></span></div>
                    </div>
                    <div class="border-2 border-parchment-900 p-2 relative bg-white/50">
                        <div class="absolute -top-3 left-4 bg-parchment-100 px-2 font-cinzel font-bold text-xs border border-parchment-900">DESLOCAMENTO</div>
                        <div class="flex items-center space-x-2 mt-2">
                            <input type="text" name="deslocamento" x-model="form.deslocamento"
                                class="w-full bg-transparent border-b-2 border-parchment-900 font-cinzel font-bold text-2xl text-center focus:outline-none">
                            <span class="font-cinzel text-xs font-bold">m/q</span>
                        </div>
                    </div>
                </div>

                <!-- ARMOR CLASS -->
                <div class="border-2 border-parchment-900 p-3 bg-white/50 shadow-inner">
                    <div class="flex items-center space-x-2">
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] font-bold uppercase tracking-widest">CA</span>
                            <div class="w-20 h-20 border-2 border-parchment-900 bg-white flex items-center justify-center font-cinzel font-bold text-4xl shadow-md"
                                x-text="calculateTotalAC()">
                            </div>
                            <span class="text-[8px] font-bold text-parchment-700 mt-1 uppercase">Classe de Armadura</span>
                        </div>
                        <div class="flex-grow">
                            <div class="flex items-center space-x-1">
                                <span class="text-xl font-cinzel font-bold">= 10 +</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_armadura" x-model.number="form.ca_armadura" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Armadura</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_escudo" x-model.number="form.ca_escudo" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Escudo</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <span class="w-10 border-b border-parchment-900 text-center font-bold" x-text="formatMod(getMod('destreza'))"></span>
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">DEX</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_tamanho" x-model.number="form.ca_tamanho" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Tamanho</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_natural" x-model.number="form.ca_natural" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Natural</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_deflexao" x-model.number="form.ca_deflexao" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Deflexão</span>
                                </div>
                                <span class="text-lg font-bold">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" name="ca_misc" x-model.number="form.ca_misc" class="w-10 border-b border-parchment-900 text-center font-bold">
                                    <span class="text-[7px] uppercase font-bold text-parchment-700">Misc</span>
                                </div>
                            </div>
                            <div class="mt-3 flex justify-around">
                                <div class="flex items-center space-x-2">
                                    <span class="text-[10px] font-bold uppercase">Toque:</span>
                                    <span class="w-10 border-b-2 border-parchment-900 text-center font-cinzel font-bold text-lg" x-text="calculateTouchAC()"></span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-[10px] font-bold uppercase">Surpreso:</span>
                                    <span class="w-10 border-b-2 border-parchment-900 text-center font-cinzel font-bold text-lg" x-text="calculateFlatFootedAC()"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SAVING THROWS AND INITIATIVE -->
                <div class="grid grid-cols-12 gap-4">
                    <!-- INITIATIVE -->
                    <div class="col-span-4 border-2 border-parchment-900 p-2 bg-white/50 h-full flex flex-col justify-center">
                        <div class="text-center">
                            <span class="text-[9px] font-bold uppercase tracking-widest block">Iniciativa</span>
                            <div class="flex items-center justify-center space-x-1">
                                <div class="w-12 h-12 border-2 border-parchment-900 bg-white flex items-center justify-center font-cinzel font-bold text-2xl shadow-md"
                                    x-text="formatMod(getMod('destreza') + form.iniciativa_misc)">
                                </div>
                                <div class="flex flex-col text-[8px] font-bold text-left ml-2">
                                    <span>= <span x-text="formatMod(getMod('destreza'))"></span> DEX</span>
                                    <span>+ <input type="number" name="iniciativa_misc" x-model.number="form.iniciativa_misc" class="w-8 border-b border-parchment-900 text-center inline"> MISC</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SAVING THROWS -->
                    <div class="col-span-8 space-y-2">
                        <template x-for="save in saves" :key="save.key">
                            <div class="flex items-center space-x-2 bg-white/50 border border-parchment-300 p-1 rounded">
                                <div class="w-20 text-right">
                                    <span class="text-[9px] font-bold uppercase" x-text="save.label"></span>
                                    <span class="text-[7px] block leading-tight text-parchment-700" x-text="save.sub"></span>
                                </div>
                                <div class="w-10 h-10 border-2 border-parchment-900 bg-parchment-900 text-parchment-100 flex items-center justify-center font-cinzel font-bold text-xl shadow-md"
                                    x-text="formatMod(calculateSave(save.key))">
                                </div>
                                <span class="text-sm font-bold">=</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" :name="save.key + '_base'" x-model.number="form[save.key + '_base']" class="w-8 border-b border-parchment-400 text-center text-xs">
                                    <span class="text-[6px] uppercase font-bold text-parchment-700">Base</span>
                                </div>
                                <span class="text-xs">+</span>
                                <div class="flex flex-col items-center">
                                    <span class="w-8 border-b border-parchment-400 text-center text-xs" x-text="formatMod(getMod(save.attr))"></span>
                                    <span class="text-[6px] uppercase font-bold text-parchment-700" x-text="save.attr.substring(0,3).toUpperCase()"></span>
                                </div>
                                <span class="text-xs">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" :name="save.key + '_magia'" x-model.number="form[save.key + '_magia']" class="w-8 border-b border-parchment-400 text-center text-xs">
                                    <span class="text-[6px] uppercase font-bold text-parchment-700">Mágic</span>
                                </div>
                                <span class="text-xs">+</span>
                                <div class="flex flex-col items-center">
                                    <input type="number" :name="save.key + '_misc'" x-model.number="form[save.key + '_misc']" class="w-8 border-b border-parchment-400 text-center text-xs">
                                    <span class="text-[6px] uppercase font-bold text-parchment-700">Misc</span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- BAB AND GRAPPLE -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="border-2 border-parchment-900 p-2 bg-white/50 flex flex-col justify-center">
                        <label class="block text-[9px] font-bold uppercase text-center mb-1">Bônus Base de Ataque</label>
                        <input type="number" name="bab" x-model.number="form.bab"
                            class="w-full bg-transparent border-b-2 border-parchment-900 font-cinzel font-bold text-2xl text-center focus:outline-none">
                    </div>
                    <div class="border-2 border-parchment-900 p-2 bg-white/50">
                        <label class="block text-[9px] font-bold uppercase text-center mb-1">Agarre (Total)</label>
                        <div class="flex items-center justify-center space-x-1">
                            <div class="w-12 h-12 border-2 border-parchment-900 bg-white flex items-center justify-center font-cinzel font-bold text-2xl shadow-md"
                                x-text="formatMod(form.bab + getMod('forca') + form.agarre_tamanho + form.agarre_misc)">
                            </div>
                            <div class="flex flex-col text-[7px] font-bold text-left ml-1">
                                <span>= <span x-text="form.bab"></span> BAB</span>
                                <span>+ <span x-text="formatMod(getMod('forca'))"></span> FOR</span>
                                <span>+ <input type="number" name="agarre_tamanho" x-model.number="form.agarre_tamanho" class="w-6 border-b border-parchment-900 text-center"> TAM</span>
                                <span>+ <input type="number" name="agarre_misc" x-model.number="form.agarre_misc" class="w-6 border-b border-parchment-900 text-center"> MISC</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ARMAS -->
                <div class="border-2 border-parchment-900 p-3 bg-parchment-100/80">
                    <h4 class="font-cinzel font-bold text-xs uppercase border-b-2 border-parchment-900 mb-3"><i class="fa-solid fa-sword mr-2"></i>Ataques e Armas</h4>
                    <div class="space-y-4 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($armas as $arma)
                        <div class="flex items-center space-x-2 border-b border-parchment-400 pb-2">
                            <input type="checkbox" name="armas[]" value="{{ $arma->id }}" class="accent-blood-700">
                            <div class="flex-grow">
                                <div class="flex justify-between">
                                    <span class="text-[10px] font-bold text-parchment-900">{{ $arma->nome }}</span>
                                    <span class="text-[10px] font-cinzel font-bold text-blood-700">Atk: +<span x-text="form.bab + (['Corpo a Corpo', 'Haste'].includes('{{ $arma->tipo }}') ? getMod('forca') : getMod('destreza'))"></span></span>
                                </div>
                                <div class="grid grid-cols-4 gap-1 text-[8px] uppercase font-bold text-parchment-700 mt-1">
                                    <div>Dano: <span class="text-parchment-900">{{ $arma->dano_m }}</span></div>
                                    <div>Crítico: <span class="text-parchment-900">{{ $arma->critico }}</span></div>
                                    <div>Tipo: <span class="text-parchment-900">{{ $arma->tipo }}</span></div>
                                    <div>Preço: <span class="text-blood-700">{{ $arma->preco }}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA: PERÍCIAS -->
            <div class="lg:col-span-3 border-2 border-parchment-900 p-4 bg-white/70 shadow-lg">
                <div class="flex justify-between items-center border-b-2 border-parchment-900 mb-3 pb-1">
                    <h3 class="font-cinzel font-bold text-xs uppercase tracking-widest">Perícias</h3>
                    <div class="bg-parchment-900 text-parchment-100 px-2 py-1 rounded text-[10px] font-cinzel">
                        PTS: <span x-text="availableSkillPoints - spentSkillPoints"></span>
                    </div>
                </div>
                <div class="space-y-1 max-h-[700px] overflow-y-auto pr-2 custom-scrollbar">
                    <div class="grid grid-cols-12 text-[7px] font-bold uppercase text-parchment-700 mb-1 px-1">
                        <div class="col-span-7">Nome da Perícia</div>
                        <div class="col-span-2 text-center">Mod</div>
                        <div class="col-span-1 text-center">Atb</div>
                        <div class="col-span-2 text-center">Grad</div>
                    </div>
                    <template x-for="pericia in pericias" :key="pericia.id">
                        <div class="grid grid-cols-12 gap-1 items-center py-1 border-b border-parchment-200 hover:bg-parchment-200 transition"
                            :class="isClassSkill(pericia.nome) ? 'bg-green-100/30' : ''">
                            <div class="col-span-7 flex items-center space-x-1">
                                <template x-if="isClassSkill(pericia.nome)">
                                    <span class="w-1.5 h-1.5 bg-green-700 rounded-full"></span>
                                </template>
                                <span class="text-[9px] font-bold text-parchment-900 truncate" x-text="pericia.nome"></span>
                            </div>
                            <div class="col-span-2 text-center font-bold text-magic-600 text-[10px]" x-text="formatMod(calculateSkillTotal(pericia))"></div>
                            <div class="col-span-1 text-center text-[7px] text-parchment-700" x-text="pericia.habilidade_chave"></div>
                            <div class="col-span-2 flex items-center justify-center space-x-1">
                                <button type="button" @click="updateSkill(pericia.id, -1)" class="w-3 h-3 bg-parchment-300 text-[8px] flex items-center justify-center rounded-sm hover:bg-parchment-400">-</button>
                                <input type="number" :name="'pericias['+pericia.id+']'" :value="getSkillRanks(pericia.id)" readonly
                                    class="w-5 text-[9px] text-center bg-transparent font-bold">
                                <button type="button" @click="updateSkill(pericia.id, 1)" class="w-3 h-3 bg-parchment-300 text-[8px] flex items-center justify-center rounded-sm hover:bg-parchment-400">+</button>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="mt-4 text-[7px] italic text-parchment-700">
                    * Pontos pretos indicam perícias de classe.
                </div>
            </div>
        </div>

        <!-- SEÇÃO FINAL: EQUIPAMENTO, TALENTOS E XP -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- DINHEIRO E XP -->
            <div class="border-2 border-parchment-900 p-4 bg-white/50">
                <h4 class="font-cinzel font-bold text-xs uppercase border-b-2 border-parchment-900 mb-3">Tesouro e Experiência</h4>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="space-y-2">
                        <label class="block text-[8px] font-bold text-parchment-700 uppercase">XP Atual</label>
                        <input type="number" name="xp_atual" x-model.number="form.xp_atual" class="w-full border-b border-parchment-900 text-lg font-cinzel font-bold text-center">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[8px] font-bold text-parchment-700 uppercase">Próximo Nível</label>
                        <input type="number" name="xp_proximo" x-model.number="form.xp_proximo" class="w-full border-b border-parchment-900 text-lg font-cinzel font-bold text-center">
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] font-bold text-parchment-900">PL</span>
                        <input type="number" name="dinheiro_pl" x-model.number="form.dinheiro_pl" class="w-full border-2 border-parchment-300 text-center font-bold text-xs p-1">
                        <span class="text-[6px] text-parchment-500 uppercase">Platina</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] font-bold text-parchment-900">PO</span>
                        <input type="number" name="ouro" x-model.number="form.ouro" class="w-full border-2 border-blood-200 text-center font-bold text-xs p-1 bg-yellow-50">
                        <span class="text-[6px] text-parchment-500 uppercase">Ouro</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] font-bold text-parchment-900">PP</span>
                        <input type="number" name="dinheiro_pp" x-model.number="form.dinheiro_pp" class="w-full border-2 border-parchment-300 text-center font-bold text-xs p-1">
                        <span class="text-[6px] text-parchment-500 uppercase">Prata</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-[10px] font-bold text-parchment-900">PC</span>
                        <input type="number" name="dinheiro_pc" x-model.number="form.dinheiro_pc" class="w-full border-2 border-parchment-300 text-center font-bold text-xs p-1">
                        <span class="text-[6px] text-parchment-500 uppercase">Cobre</span>
                    </div>
                </div>
            </div>

            <!-- TALENTOS E HABILIDADES -->
            <div class="lg:col-span-2 border-2 border-parchment-900 p-4 bg-white/50">
                <div class="grid grid-cols-2 gap-4 h-full">
                    <div class="flex flex-col">
                        <h4 class="font-cinzel font-bold text-xs uppercase border-b-2 border-parchment-900 mb-2">Talentos</h4>
                        <textarea name="talentos_descricao" x-model="form.talentos_descricao" class="flex-grow bg-transparent border border-parchment-300 p-2 text-[10px] font-lora outline-none focus:border-blood-700" placeholder="Liste seus talentos aqui..."></textarea>
                    </div>
                    <div class="flex flex-col">
                        <h4 class="font-cinzel font-bold text-xs uppercase border-b-2 border-parchment-900 mb-2">Habilidades Especiais</h4>
                        <textarea name="habilidades_especiais" x-model="form.habilidades_especiais" class="flex-grow bg-transparent border border-parchment-300 p-2 text-[10px] font-lora outline-none focus:border-blood-700" placeholder="Traços raciais e de classe..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="btn-medieval bg-blood-700 text-white font-cinzel py-4 px-16 rounded shadow-2xl hover:bg-blood-800 transform hover:scale-105 transition flex items-center text-2xl border-4 border-parchment-900">
                <i class="fa-solid fa-dragon mr-4"></i> CONCLUIR FORJA DO HERÓI
            </button>
        </div>
    </form>
</div>

<script>
function characterCreator() {
    return {
        racas: @json($racas),
        classes: @json($classes),
        tendencias: @json($tendencias),
        divindades: @json($divindades),
        pericias: @json($pericias),
        
        attributes: [
            { key: 'forca', label: 'Força', sub: 'Strength' },
            { key: 'destreza', label: 'Destreza', sub: 'Dexterity' },
            { key: 'constituicao', label: 'Constituição', sub: 'Constitution' },
            { key: 'inteligencia', label: 'Inteligência', sub: 'Intelligence' },
            { key: 'sabedoria', label: 'Sabedoria', sub: 'Wisdom' },
            { key: 'carisma', label: 'Carisma', sub: 'Charisma' }
        ],

        saves: [
            { key: 'fortitude', label: 'Fortitude', sub: 'Constitution', attr: 'constituicao' },
            { key: 'reflexos', label: 'Reflexos', sub: 'Dexterity', attr: 'destreza' },
            { key: 'vontade', label: 'Vontade', sub: 'Wisdom', attr: 'sabedoria' }
        ],

        form: {
            nome_personagem: '',
            nome_jogador: '',
            raca_id: '',
            classe_id: '',
            nivel: 1,
            xp_atual: 0,
            xp_proximo: 1000,
            deslocamento: '9m',
            ouro: 100,
            dinheiro_pc: 0,
            dinheiro_pp: 0,
            dinheiro_pl: 0,
            tendencia_id: '',
            divindade: '',
            tamanho: 'Médio',
            idade: '',
            sexo: '',
            altura: '',
            peso: '',
            olhos: '',
            cabelos: '',
            pele: '',
            forca_base: 10,
            destreza_base: 10,
            constituicao_base: 10,
            inteligencia_base: 10,
            sabedoria_base: 10,
            carisma_base: 10,
            pv_max: 10,
            bab: 0,
            iniciativa_misc: 0,
            ca_armadura: 0,
            ca_escudo: 0,
            ca_tamanho: 0,
            ca_natural: 0,
            ca_deflexao: 0,
            ca_misc: 0,
            fortitude_base: 0,
            fortitude_magia: 0,
            fortitude_misc: 0,
            reflexos_base: 0,
            reflexos_magia: 0,
            reflexos_misc: 0,
            vontade_base: 0,
            vontade_magia: 0,
            vontade_misc: 0,
            agarre_tamanho: 0,
            agarre_misc: 0,
            talentos_descricao: '',
            habilidades_especiais: '',
            idiomas: '',
            notas_combate: '',
            pericias: {}
        },

        currentRaca: null,
        currentClass: null,
        availableSkillPoints: 0,
        spentSkillPoints: 0,

        init() {
            this.calculateProgression();
        },

        updateRace() {
            this.currentRaca = this.racas.find(r => r.id == this.form.raca_id);
            if (this.currentRaca) {
                // Ajustar tamanho se a raça mudar
                if (this.currentRaca.nome.includes('Anão') || this.currentRaca.nome.includes('Halfling')) {
                   // logic...
                }
            }
            this.calculateProgression();
        },

        updateClass() {
            this.currentClass = this.classes.find(c => c.id == this.form.classe_id);
            this.calculateProgression();
        },

        getRacialMod(attrKey) {
            if (!this.currentRaca) return 0;
            return this.currentRaca['mod_' + attrKey] || 0;
        },

        getMod(attrKey) {
            const base = this.form[attrKey + '_base'] || 0;
            const racial = this.getRacialMod(attrKey);
            const total = base + racial;
            return Math.floor((total - 10) / 2);
        },

        formatMod(val) {
            return val >= 0 ? '+' + val : val;
        },

        rollStat(key) {
            let rolls = [];
            for (let i = 0; i < 4; i++) {
                rolls.push(Math.floor(Math.random() * 6) + 1);
            }
            rolls.sort().shift(); // drop lowest
            this.form[key + '_base'] = rolls.reduce((a, b) => a + b, 0);
            this.calculateProgression();
        },

        rollAllStats() {
            this.attributes.forEach(a => this.rollStat(a.key));
            window.sfx.playExplosion();
        },

        calculateProgression() {
            if (!this.currentClass) return;

            const lvl = this.form.nivel;
            
            // BBA
            if (this.currentClass.bba_progressao === 'boa') this.form.bab = lvl;
            else if (this.currentClass.bba_progressao === 'media') this.form.bab = Math.floor(lvl * 0.75);
            else this.form.bab = Math.floor(lvl * 0.5);

            // Saves
            const calcSave = (type) => {
                const prog = this.currentClass['resistencia_' + type];
                if (prog === 'boa') return 2 + Math.floor(lvl / 2);
                return Math.floor(lvl / 3);
            };

            this.form.fortitude_base = calcSave('fortitude');
            this.form.reflexos_base = calcSave('reflexos');
            this.form.vontade_base = calcSave('vontade');

            // Skill Points
            const intMod = this.getMod('inteligencia');
            let pts = (this.currentClass.pontos_pericia + intMod);
            if (pts < 1) pts = 1;
            
            if (lvl === 1) {
                this.availableSkillPoints = pts * 4;
            } else {
                this.availableSkillPoints = (pts * 4) + (pts * (lvl - 1));
            }

            // Racial Bonus (Human)
            if (this.currentRaca && this.currentRaca.nome.includes('Humano')) {
                this.availableSkillPoints += (lvl === 1 ? 4 : 3 + lvl);
            }
            
            this.rollHP();
        },

        rollHP() {
            if (!this.currentClass) return;
            const conMod = this.getMod('constituicao');
            let total = this.currentClass.dado_vida + conMod;
            for (let i = 1; i < this.form.nivel; i++) {
                total += (Math.floor(Math.random() * this.currentClass.dado_vida) + 1) + conMod;
            }
            this.form.pv_max = total;
        },

        calculateTotalAC() {
            return 10 + this.form.ca_armadura + this.form.ca_escudo + this.getMod('destreza') + 
                   this.form.ca_tamanho + this.form.ca_natural + this.form.ca_deflexao + this.form.ca_misc;
        },

        calculateTouchAC() {
            return 10 + this.getMod('destreza') + this.form.ca_tamanho + this.form.ca_deflexao + this.form.ca_misc;
        },

        calculateFlatFootedAC() {
            return 10 + this.form.ca_armadura + this.form.ca_escudo + this.form.ca_tamanho + 
                   this.form.ca_natural + this.form.ca_deflexao + this.form.ca_misc;
        },

        calculateSave(key) {
            return (this.form[key + '_base'] || 0) + this.getMod(this.saves.find(s => s.key === key).attr) + 
                   (this.form[key + '_magia'] || 0) + (this.form[key + '_misc'] || 0);
        },

        isClassSkill(nomePericia) {
            if (!this.currentClass) return false;
            const c = this.currentClass.nome;
            if (c === 'Ladino') return true;
            if (c === 'Guerreiro' && ['Escalar', 'Saltar', 'Natação', 'Cavalgar', 'Intimidação'].includes(nomePericia)) return true;
            if (c === 'Mago' && ['Conhecimento (Arcano)', 'Identificar Magia', 'Ofícios', 'Concentração'].includes(nomePericia)) return true;
            if (c === 'Clérigo' && ['Cura', 'Diplomacia', 'Conhecimento (Religião)', 'Concentração'].includes(nomePericia)) return true;
            return false;
        },

        getSkillRanks(id) {
            return this.form.pericias[id] || 0;
        },

        updateSkill(id, delta) {
            const pericia = this.pericias.find(p => p.id == id);
            const isClass = this.isClassSkill(pericia.nome);
            const cost = isClass ? 1 : 2;
            const currentRanks = this.getSkillRanks(id);
            
            if (delta > 0 && (this.spentSkillPoints + cost) <= this.availableSkillPoints) {
                if (currentRanks < (this.form.nivel + 3)) {
                    this.form.pericias[id] = currentRanks + 1;
                    this.spentSkillPoints += cost;
                }
            } else if (delta < 0 && currentRanks > 0) {
                this.form.pericias[id] = currentRanks - 1;
                this.spentSkillPoints -= cost;
            }
        },

        calculateSkillTotal(pericia) {
            const ranks = this.getSkillRanks(pericia.id);
            const attrKeyMap = {
                'FOR': 'forca', 'DES': 'destreza', 'CON': 'constituicao',
                'INT': 'inteligencia', 'SAB': 'sabedoria', 'CAR': 'carisma'
            };
            const mod = this.getMod(attrKeyMap[pericia.habilidade_chave]);
            return ranks + mod;
        },

        playMagic() {
            if (window.sfx) window.sfx.playMagic();
            return true;
        }
    }
}
</script>

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
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=number] {
  -moz-appearance: textfield;
}
</style>
@endsection
