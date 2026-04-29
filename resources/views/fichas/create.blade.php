@extends('layouts.app')

@section('title', 'Forjar Novo Herói')

@section('content')
<div x-data="characterCreator()" x-init="init()">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-feather-pointed text-magic-600 mr-3"></i>Forjar Herói
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"Uma nova alma está prestes a entrar no panteão das lendas."</p>
        </div>
        <div class="flex space-x-4">
             <div class="flex bg-parchment-300 rounded-full p-1 border border-parchment-400">
                <template x-for="i in 5">
                    <div class="w-3 h-3 rounded-full m-1" :class="step >= i ? 'bg-magic-600' : 'bg-parchment-400'"></div>
                </template>
            </div>
        </div>
    </div>

    <form action="{{ route('fichas.store') }}" method="POST" @submit="playMagic()">
        @csrf

        <!-- Passo 1: Informações Básicas -->
        <div x-show="step === 1" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">1. Origens e Identidade</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Versão do Sistema</label>
                        <select name="versao" x-model="form.versao" required
                            class="w-full bg-parchment-200 border-2 border-blood-800 rounded p-3 font-cinzel font-bold focus:border-blood-600 shadow-lg text-xl">
                            <option value="3.5">D&D 3.5 (Versão Padrão)</option>
                            <option value="5.0">D&D 5.0 (Experimental)</option>
                            <option value="Outra">Outra Versão</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Nome do Personagem</label>
                        <input type="text" name="nome_personagem" x-model="form.nome_personagem" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Nome do Jogador</label>
                        <input type="text" name="nome_jogador" x-model="form.nome_jogador" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Raça</label>
                        <select name="raca_id" x-model="form.raca_id" @change="updateRace()" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                            <option value="">Selecione...</option>
                            <template x-for="raca in racas" :key="raca.id">
                                <option :value="raca.id" x-text="raca.nome"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Classe</label>
                        <select name="classe_id" x-model="form.classe_id" @change="updateClass()" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                            <option value="">Selecione...</option>
                            <template x-for="classe in classes" :key="classe.id">
                                <option :value="classe.id" x-text="classe.nome"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Nível</label>
                        <input type="number" name="nivel" x-model.number="form.nivel" min="1" max="20" @change="calculateProgression()"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Tendência</label>
                        <select name="tendencia_id" x-model="form.tendencia_id" required
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                            <option value="">Selecione...</option>
                            <template x-for="tend in tendencias" :key="tend.id">
                                <option :value="tend.id" x-text="tend.nome"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Divindade</label>
                        <select name="divindade" x-model="form.divindade"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                            <option value="">Nenhuma</option>
                            <template x-for="div in divindades" :key="div.id">
                                <option :value="div.nome" x-text="div.nome"></option>
                            </template>
                        </select>
                    </div>

                    <div class="col-span-2 border-t border-parchment-400 pt-4">
                        <h3 class="font-cinzel font-bold text-parchment-800 mb-4">Aparência e Biografia</h3>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Sexo</label>
                        <input type="text" name="sexo" x-model="form.sexo" placeholder="M/F/Outro"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">XP Atual</label>
                        <input type="number" name="xp_atual" x-model.number="form.xp_atual"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Deslocamento (m)</label>
                        <input type="text" name="deslocamento" x-model="form.deslocamento" placeholder="Ex: 9m"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Tamanho</label>
                        <input type="text" name="tamanho" x-model="form.tamanho" placeholder="Ex: Médio"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" x-model.number="form.peso"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Altura (m)</label>
                        <input type="number" step="0.01" name="altura" x-model.number="form.altura"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Pele</label>
                        <input type="text" name="pele" x-model="form.pele"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Cabelos</label>
                        <input type="text" name="cabelos" x-model="form.cabelos"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-xs">Olhos</label>
                        <input type="text" name="olhos" x-model="form.olhos"
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-2 font-lora focus:border-magic-500 shadow-inner">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded shadow-lg">
                        Próximo <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Passo 2: Atributos -->
        <div x-show="step === 2" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">2. Atributos Primários</h2>
                
                <div class="flex justify-between items-center bg-parchment-300 p-4 rounded border border-parchment-400 mb-6">
                    <p class="font-lora italic text-parchment-900">Role os dados (4d6 drop lowest) para gerar seus atributos base.</p>
                    <button type="button" @click="rollAllStats()" class="btn-medieval bg-blood-700 text-white px-4 py-2 rounded font-cinzel">
                        <i class="fa-solid fa-dice-d20 mr-2"></i> Rolar Tudo
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="attr in attributes" :key="attr.key">
                        <div class="bg-parchment-100 p-4 rounded-lg border-2 border-parchment-300 shadow-inner relative">
                            <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-center" x-text="attr.label"></label>
                            
                            <div class="flex items-center space-x-2">
                                <input type="number" :name="attr.key + '_base'" x-model.number="form[attr.key + '_base']" @input="calculateMods()"
                                    class="w-full text-center text-3xl font-cinzel font-bold bg-transparent border-b-2 border-parchment-400 focus:outline-none">
                                <button type="button" @click="rollStat(attr.key)" class="text-magic-600 hover:text-magic-800" @click="playPage()">
                                    <i class="fa-solid fa-dice"></i>
                                </button>
                            </div>

                            <div class="mt-4 flex justify-between items-center text-xs font-bold uppercase text-parchment-800">
                                <span>Racial: <span :class="getRacialMod(attr.key) > 0 ? 'text-green-600' : (getRacialMod(attr.key) < 0 ? 'text-blood-700' : '')" x-text="formatMod(getRacialMod(attr.key))"></span></span>
                                <span class="bg-parchment-800 text-parchment-100 px-3 py-1 rounded text-lg" x-text="'Mod: ' + formatMod(getMod(attr.key))"></span>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded shadow-lg">
                        Próximo <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Passo 3: Perícias -->
        <div x-show="step === 3" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <div class="flex justify-between items-end border-b border-parchment-400 pb-2">
                    <h2 class="text-2xl font-cinzel font-bold">3. Perícias e Treinamento</h2>
                    <div class="bg-magic-600 text-white px-4 py-1 rounded font-cinzel text-lg shadow-inner">
                        Pontos Disponíveis: <span x-text="availableSkillPoints - spentSkillPoints"></span> / <span x-text="availableSkillPoints"></span>
                    </div>
                </div>

                <p class="text-sm text-parchment-800 italic">D&D 3.5: Perícias de classe custam 1 pt. Outras custam 2 pts por graduação.</p>

                <div class="max-h-96 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                    <template x-for="pericia in pericias" :key="pericia.id">
                        <div class="flex items-center justify-between p-3 rounded border border-parchment-300 transition"
                             :class="isClassSkill(pericia.nome) ? 'bg-green-50/30' : 'bg-parchment-200/50'">
                            
                            <div class="flex-grow">
                                <span class="font-bold font-cinzel text-parchment-900" x-text="pericia.nome"></span>
                                <span class="text-[10px] bg-parchment-300 px-1 rounded ml-2" x-text="pericia.habilidade_chave"></span>
                                <template x-if="isClassSkill(pericia.nome)">
                                    <span class="text-[9px] text-green-700 font-bold uppercase ml-2 tracking-tighter">Classe</span>
                                </template>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="text-sm font-bold text-parchment-800">
                                    Total: <span class="text-magic-600" x-text="calculateSkillTotal(pericia)"></span>
                                </div>
                                <div class="flex items-center bg-parchment-100 rounded border border-parchment-400">
                                    <button type="button" @click="updateSkill(pericia.id, -1)" class="px-2 py-1 hover:bg-parchment-300">-</button>
                                    <input type="number" :name="'pericias['+pericia.id+']'" :value="getSkillRanks(pericia.id)" readonly
                                        class="w-10 text-center bg-transparent font-bold">
                                    <button type="button" @click="updateSkill(pericia.id, 1)" class="px-2 py-1 hover:bg-parchment-300">+</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded shadow-lg">
                        Próximo <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Passo 4: Inventário -->
        <div x-show="step === 4" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <div class="flex justify-between items-end border-b border-parchment-400 pb-2">
                    <h2 class="text-2xl font-cinzel font-bold">4. Arsenal e Provisões</h2>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <label class="block text-[10px] font-bold text-parchment-700 uppercase">Ouro Inicial</label>
                            <input type="number" name="ouro" x-model.number="form.ouro" @input="calculateRemainingGold()"
                                class="w-24 bg-parchment-100 border border-parchment-400 rounded px-2 py-1 text-right font-bold text-magic-800">
                        </div>
                        <div class="bg-magic-600 text-white px-4 py-2 rounded font-cinzel text-lg shadow-inner">
                            Ouro Restante: <span :class="remainingGold < 0 ? 'text-red-300' : ''" x-text="remainingGold"></span> PO
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Armas -->
                    <div class="space-y-4">
                        <h3 class="font-cinzel font-bold text-blood-700 flex items-center"><i class="fa-solid fa-sword mr-2"></i> Armas</h3>
                        <div class="max-h-64 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                            @foreach($armas as $arma)
                                <label class="flex items-center p-2 rounded border border-parchment-300 bg-parchment-100 hover:bg-parchment-200 cursor-pointer transition">
                                    <input type="checkbox" name="armas[]" value="{{ $arma->id }}" 
                                        @change="toggleItem('armas', {{ $arma->id }}, '{{ $arma->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $arma->nome }}</p>
                                        <p class="text-[10px] opacity-70">{{ $arma->dano_m }} | {{ $arma->critico }}</p>
                                    </div>
                                    <span class="text-[10px] font-bold text-magic-700">{{ $arma->preco }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Armaduras -->
                    <div class="space-y-4">
                        <h3 class="font-cinzel font-bold text-magic-700 flex items-center"><i class="fa-solid fa-shield-halved mr-2"></i> Armaduras</h3>
                        <div class="max-h-64 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                            @foreach($armaduras as $armadura)
                                <label class="flex items-center p-2 rounded border border-parchment-300 bg-parchment-100 hover:bg-parchment-200 cursor-pointer transition">
                                    <input type="checkbox" name="armaduras[]" value="{{ $armadura->id }}" 
                                        @change="toggleItem('armaduras', {{ $armadura->id }}, '{{ $armadura->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $armadura->nome }}</p>
                                        <p class="text-[10px] opacity-70">+{{ $armadura->bonus_ca }} CA | Pen: {{ $armadura->penalidade_armadura }}</p>
                                    </div>
                                    <span class="text-[10px] font-bold text-magic-700">{{ $armadura->preco }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Itens Gerais -->
                    <div class="space-y-4">
                        <h3 class="font-cinzel font-bold text-parchment-800 flex items-center"><i class="fa-solid fa-sack-xmark mr-2"></i> Itens Gerais</h3>
                        <div class="max-h-64 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                            @foreach($equipamentos as $equip)
                                <label class="flex items-center p-2 rounded border border-parchment-300 bg-parchment-100 hover:bg-parchment-200 cursor-pointer transition">
                                    <input type="checkbox" name="equipamentos[]" value="{{ $equip->id }}" 
                                        @change="toggleItem('equipamentos', {{ $equip->id }}, '{{ $equip->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $equip->nome }}</p>
                                        <p class="text-[10px] opacity-70">{{ $equip->peso }} kg</p>
                                    </div>
                                    <span class="text-[10px] font-bold text-magic-700">{{ $equip->preco }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded shadow-lg">
                        Próximo <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Passo 5: Combate e Finalização -->
        <div x-show="step === 5" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">5. Parâmetros de Combate</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- HP -->
                    <div class="bg-parchment-200 p-6 rounded-lg border-2 border-blood-200 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 text-blood-700 opacity-10 text-6xl">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h3 class="font-cinzel font-bold text-blood-800 mb-4 flex items-center">
                            <i class="fa-solid fa-heart mr-2"></i> Pontos de Vida
                        </h3>
                        <div class="flex items-end space-x-4">
                            <div class="text-center">
                                <span class="text-4xl font-bold font-cinzel" x-text="form.pv_max"></span>
                                <span class="block text-[10px] uppercase font-bold text-parchment-700">Total Máximo</span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-xs text-parchment-800 mb-2" x-show="form.nivel == 1">Nível 1: Valor Máximo (<span x-text="currentClass.dado_vida"></span>) + Mod CON</p>
                                <p class="text-xs text-parchment-800 mb-2" x-show="form.nivel > 1">Nível 1: Máximo + <span x-text="form.nivel - 1"></span> d<span x-text="currentClass.dado_vida"></span> + CON</p>
                                <button type="button" @click="rollHP()" class="w-full bg-blood-700 text-white py-1 rounded text-xs font-bold hover:bg-blood-600 transition">
                                    <i class="fa-solid fa-dice mr-1"></i> Rolar/Atualizar Vida
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="pv_max" :value="form.pv_max">
                    </div>

                    <!-- BAB e CA -->
                    <div class="bg-parchment-200 p-6 rounded-lg border-2 border-magic-200 relative overflow-hidden">
                        <h3 class="font-cinzel font-bold text-magic-800 mb-4 flex items-center">
                            <i class="fa-solid fa-shield-halved mr-2"></i> Combate
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-xs uppercase font-bold text-parchment-700">BBA</span>
                                <div class="text-2xl font-bold text-magic-700 font-cinzel">
                                    +<span x-text="form.bab"></span>
                                </div>
                                <input type="hidden" name="bab" :value="form.bab">
                            </div>
                            <div>
                                <span class="text-xs uppercase font-bold text-parchment-700">CA Base</span>
                                <div class="text-2xl font-bold text-parchment-900 font-cinzel">
                                    <span x-text="10 + getMod('destreza')"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resistências -->
                    <div class="col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-parchment-300 p-4 rounded border border-parchment-400">
                            <h4 class="font-cinzel font-bold text-sm mb-2">FORTITUDE</h4>
                            <div class="text-xl font-bold">+<span x-text="form.fortitude_base + getMod('constituicao')"></span></div>
                            <span class="text-[9px] text-parchment-700 uppercase">Base: +<span x-text="form.fortitude_base"></span></span>
                            <input type="hidden" name="fortitude_base" :value="form.fortitude_base">
                        </div>
                        <div class="bg-parchment-300 p-4 rounded border border-parchment-400">
                            <h4 class="font-cinzel font-bold text-sm mb-2">REFLEXOS</h4>
                            <div class="text-xl font-bold">+<span x-text="form.reflexos_base + getMod('destreza')"></span></div>
                            <span class="text-[9px] text-parchment-700 uppercase">Base: +<span x-text="form.reflexos_base"></span></span>
                            <input type="hidden" name="reflexos_base" :value="form.reflexos_base">
                        </div>
                        <div class="bg-parchment-300 p-4 rounded border border-parchment-400">
                            <h4 class="font-cinzel font-bold text-sm mb-2">VONTADE</h4>
                            <div class="text-xl font-bold">+<span x-text="form.vontade_base + getMod('sabedoria')"></span></div>
                            <span class="text-[9px] text-parchment-700 uppercase">Base: +<span x-text="form.vontade_base"></span></span>
                            <input type="hidden" name="vontade_base" :value="form.vontade_base">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-4 border-t border-parchment-400">
                    <div class="col-span-4">
                        <h3 class="font-cinzel font-bold text-parchment-800">Ajustes e Modificadores Adicionais</h3>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">Iniciativa Misc</label>
                        <input type="number" x-model.number="form.iniciativa_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">CA Natural</label>
                        <input type="number" x-model.number="form.ca_natural" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">CA Deflexão</label>
                        <input type="number" x-model.number="form.ca_deflexao" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">CA Misc</label>
                        <input type="number" x-model.number="form.ca_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">Fort. Misc</label>
                        <input type="number" x-model.number="form.fortitude_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">Refl. Misc</label>
                        <input type="number" x-model.number="form.reflexos_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">Vont. Misc</label>
                        <input type="number" x-model.number="form.vontade_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-parchment-700 uppercase">Agarre Misc</label>
                        <input type="number" x-model.number="form.agarre_misc" class="w-full bg-parchment-100 border border-parchment-400 rounded p-1 text-center">
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded shadow-lg">
                        Próximo <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Passo 6: Detalhes Finais -->
        <div x-show="step === 6" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">6. Lendas e Idiomas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Talentos</label>
                        <textarea name="talentos_descricao" x-model="form.talentos_descricao" rows="3"
                            placeholder="Descreva os talentos escolhidos..."
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Habilidades Especiais</label>
                        <textarea name="habilidades_especiais" x-model="form.habilidades_especiais" rows="3"
                            placeholder="Habilidades de classe, raça ou outras..."
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Idiomas</label>
                        <textarea name="idiomas" x-model="form.idiomas" rows="2"
                            placeholder="Ex: Comum, Élfico, Anão..."
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>

                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Notas de Combate</label>
                        <textarea name="notas_combate" x-model="form.notas_combate" rows="2"
                            placeholder="Anotações sobre ataques, defesas, etc..."
                            class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="submit" class="btn-medieval bg-blood-700 text-white font-cinzel py-3 px-12 rounded shadow-xl hover:bg-blood-800 transform hover:scale-105 transition">
                        <i class="fa-solid fa-dragon mr-2"></i> FINALIZAR FICHA
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function characterCreator() {
    return {
        step: 1,
        racas: @json($racas),
        classes: @json($classes),
        tendencias: @json($tendencias),
        divindades: @json($divindades),
        pericias: @json($pericias),
        
        attributes: [
            { key: 'forca', label: 'FORÇA' },
            { key: 'destreza', label: 'DESTREZA' },
            { key: 'constituicao', label: 'CONSTITUIÇÃO' },
            { key: 'inteligencia', label: 'INTELIGÊNCIA' },
            { key: 'sabedoria', label: 'SABEDORIA' },
            { key: 'carisma', label: 'CARISMA' }
        ],

        form: {
            versao: '3.5',
            nome_personagem: '',
            nome_jogador: '',
            raca_id: '',
            classe_id: '',
            nivel: 1,
            xp_atual: 0,
            deslocamento: '9m',
            ouro: 100,
            tendencia_id: '',
            divindade: '',
            tamanho: 'Médio',
            idade: 20,
            sexo: '',
            altura: 1.70,
            peso: 70,
            olhos: '',
            cabelos: '',
            pele: '',
            forca_base: 10,
            destreza_base: 10,
            constituicao_base: 10,
            inteligencia_base: 10,
            sabedoria_base: 10,
            carisma_base: 10,
            pv_max: 0,
            bab: 0,
            iniciativa_misc: 0,
            ca_natural: 0,
            ca_deflexao: 0,
            ca_misc: 0,
            fortitude_base: 0,
            fortitude_misc: 0,
            reflexos_base: 0,
            reflexos_misc: 0,
            vontade_base: 0,
            vontade_misc: 0,
            agarre_misc: 0,
            talentos_descricao: '',
            habilidades_especiais: '',
            idiomas: '',
            notas_combate: '',
            pericias: {}
        },

        selectedItems: [],
        remainingGold: 100,
        currentRaca: null,
        currentClass: null,
        availableSkillPoints: 0,
        spentSkillPoints: 0,

        init() {
            this.calculateProgression();
            this.calculateRemainingGold();
        },

        calculateRemainingGold() {
            let totalSpent = 0;
            this.selectedItems.forEach(item => {
                totalSpent += this.parsePrice(item.price);
            });
            this.remainingGold = (this.form.ouro - totalSpent).toFixed(2);
        },

        toggleItem(type, id, price) {
            const index = this.selectedItems.findIndex(i => i.type === type && i.id === id);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push({ type, id, price });
            }
            this.calculateRemainingGold();
        },

        parsePrice(priceStr) {
            if (!priceStr || priceStr === '-' || priceStr === '0') return 0;
            
            // Regex to find number and currency unit (PO, PP, PC)
            const match = priceStr.match(/([\d.]+)\s*([A-Z]+)/i);
            if (!match) return 0;

            const value = parseFloat(match[1]);
            const unit = match[2].toUpperCase();

            // Convert to Gold (PO)
            if (unit === 'PO') return value;
            if (unit === 'PP') return value / 10;
            if (unit === 'PC') return value / 100;
            
            return value;
        },

        nextStep() {
            if(this.step < 6) this.step++;
            window.sfx.playPage();
        },

        prevStep() {
            if(this.step > 1) this.step--;
            window.sfx.playPage();
        },

        updateRace() {
            this.currentRaca = this.racas.find(r => r.id == this.form.raca_id);
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
                this.availableSkillPoints += (lvl === 1 ? 4 : 3 + lvl); // Simplificado para o seeder
            }

            this.rollHP();
        },

        rollHP() {
            if (!this.currentClass) return;
            const conMod = this.getMod('constituicao');
            let total = this.currentClass.dado_vida + conMod;
            
            for (let i = 1; i < this.form.nivel; i++) {
                let roll = Math.floor(Math.random() * this.currentClass.dado_vida) + 1;
                total += roll + conMod;
            }
            
            this.form.pv_max = total;
        },

        isClassSkill(nomePericia) {
            // Lógica simplificada: Ladino tem quase tudo, Guerreiro tem físicas, etc.
            // No futuro isso pode vir do banco (tabela pivot classe_pericia)
            if (!this.currentClass) return false;
            const c = this.currentClass.nome;
            if (c === 'Ladino') return true;
            if (c === 'Guerreiro' && ['Escalar', 'Saltar', 'Natação', 'Cavalgar', 'Intimidação'].includes(nomePericia)) return true;
            if (c === 'Mago' && ['Conhecimento (Arcano)', 'Identificar Magia', 'Ofícios', 'Concentração'].includes(nomePericia)) return true;
            if (c === 'Clérigo' && ['Cura', 'Diplomacia', 'Conhecimento (Religião)', 'Concentração'].includes(nomePericia)) return true;
            
            return false; // Default
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
                // Max rank in 3.5: Level + 3
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
        }
    }
}
</script>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 8px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(90, 70, 36, 0.1);
    border-radius: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #5a4624;
    border-radius: 4px;
}
</style>
@endsection
