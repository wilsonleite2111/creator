@extends('layouts.app')

@section('title', 'Editar Ficha: ' . $ficha->nome_personagem)

@section('content')
<div x-data="characterCreator()" x-init="init()">
    <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                <i class="fa-solid fa-scroll text-magic-600 mr-3"></i>Editar Herói
            </h1>
            <p class="text-parchment-800 mt-2 italic font-lora">"As lendas podem ser reescritas, mas as cicatrizes permanecem."</p>
        </div>
        <div class="flex space-x-4">
             <div class="flex bg-parchment-300 rounded-full p-1 border border-parchment-400">
                <template x-for="i in 6">
                    <div class="w-3 h-3 rounded-full m-1" :class="step >= i ? 'bg-magic-600' : 'bg-parchment-400'"></div>
                </template>
            </div>
        </div>
    </div>

    <form action="{{ route('fichas.update', $ficha) }}" method="POST" @submit="playMagic()">
        @csrf
        @method('PUT')

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
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="attr in attributes" :key="attr.key">
                        <div class="bg-parchment-100 p-4 rounded-lg border-2 border-parchment-300 shadow-inner relative">
                            <label class="block text-parchment-900 font-cinzel font-bold mb-2 text-center" x-text="attr.label"></label>
                            
                            <div class="flex items-center space-x-2">
                                <input type="number" :name="attr.key + '_base'" x-model.number="form[attr.key + '_base']" @input="calculateMods()"
                                    class="w-full text-center text-3xl font-cinzel font-bold bg-transparent border-b-2 border-parchment-400 focus:outline-none">
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

                <div class="max-h-96 overflow-y-auto space-y-2 pr-2 custom-scrollbar">
                    <template x-for="pericia in pericias" :key="pericia.id">
                        <div class="flex items-center justify-between p-3 rounded border border-parchment-300 transition"
                             :class="isClassSkill(pericia.nome) ? 'bg-green-50/30' : 'bg-parchment-200/50'">
                            
                            <div class="flex-grow">
                                <span class="font-bold font-cinzel text-parchment-900" x-text="pericia.nome"></span>
                                <span class="text-[10px] bg-parchment-300 px-1 rounded ml-2" x-text="pericia.habilidade_chave"></span>
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
                            <label class="block text-[10px] font-bold text-parchment-700 uppercase">Ouro</label>
                            <input type="number" name="ouro" x-model.number="form.ouro" @input="calculateRemainingGold()"
                                class="w-24 bg-parchment-100 border border-parchment-400 rounded px-2 py-1 text-right font-bold text-magic-800">
                        </div>
                        <div class="bg-magic-600 text-white px-4 py-2 rounded font-cinzel text-lg shadow-inner">
                            Saldo: <span :class="remainingGold < 0 ? 'text-red-300' : ''" x-text="remainingGold"></span> PO
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
                                        :checked="selectedItems.some(i => i.type === 'armas' && i.id == {{ $arma->id }})"
                                        @change="toggleItem('armas', {{ $arma->id }}, '{{ $arma->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $arma->nome }}</p>
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
                                        :checked="selectedItems.some(i => i.type === 'armaduras' && i.id == {{ $armadura->id }})"
                                        @change="toggleItem('armaduras', {{ $armadura->id }}, '{{ $armadura->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $armadura->nome }}</p>
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
                                        :checked="selectedItems.some(i => i.type === 'equipamentos' && i.id == {{ $equip->id }})"
                                        @change="toggleItem('equipamentos', {{ $equip->id }}, '{{ $equip->preco }}')"
                                        class="mr-3 accent-magic-600">
                                    <div class="text-xs flex-grow">
                                        <p class="font-bold text-parchment-900">{{ $equip->nome }}</p>
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

        <!-- Passo 5: Combate -->
        <div x-show="step === 5" x-transition>
            <div class="glass-parchment p-8 rounded-lg border border-parchment-400 shadow-xl space-y-6">
                <h2 class="text-2xl font-cinzel font-bold border-b border-parchment-400 pb-2">5. Parâmetros de Combate</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- HP -->
                    <div class="bg-parchment-200 p-6 rounded-lg border-2 border-blood-200 relative overflow-hidden">
                        <h3 class="font-cinzel font-bold text-blood-800 mb-4">Pontos de Vida</h3>
                        <div class="flex items-end space-x-4">
                            <input type="number" name="pv_max" x-model.number="form.pv_max" class="text-4xl font-bold font-cinzel bg-transparent border-b-2 border-blood-400 w-24">
                        </div>
                    </div>

                    <!-- BAB e CA -->
                    <div class="bg-parchment-200 p-6 rounded-lg border-2 border-magic-200">
                        <h3 class="font-cinzel font-bold text-magic-800 mb-4">Ataque e Defesa</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-parchment-700">BBA</label>
                                <input type="number" name="bab" x-model.number="form.bab" class="w-full text-2xl font-bold bg-transparent border-b-2 border-parchment-400">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-parchment-700">CA Natural</label>
                                <input type="number" name="ca_natural" x-model.number="form.ca_natural" class="w-full text-2xl font-bold bg-transparent border-b-2 border-parchment-400">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-4 border-t border-parchment-400">
                    <div class="col-span-4"><h3 class="font-cinzel font-bold text-parchment-800">Ajustes Miscelâneos</h3></div>
                    <div><label class="text-[10px] font-bold">Iniciativa</label><input type="number" name="iniciativa_misc" x-model.number="form.iniciativa_misc" class="w-full bg-parchment-100 border p-1 text-center"></div>
                    <div><label class="text-[10px] font-bold">CA Deflexão</label><input type="number" name="ca_deflexao" x-model.number="form.ca_deflexao" class="w-full bg-parchment-100 border p-1 text-center"></div>
                    <div><label class="text-[10px] font-bold">CA Misc</label><input type="number" name="ca_misc" x-model.number="form.ca_misc" class="w-full bg-parchment-100 border p-1 text-center"></div>
                    <div><label class="text-[10px] font-bold">Agarre</label><input type="number" name="agarre_misc" x-model.number="form.agarre_misc" class="w-full bg-parchment-100 border p-1 text-center"></div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="button" @click="nextStep()" class="btn-medieval bg-magic-600 text-white font-cinzel py-2 px-8 rounded">
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
                        <textarea name="talentos_descricao" x-model="form.talentos_descricao" rows="3" class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Habilidades Especiais</label>
                        <textarea name="habilidades_especiais" x-model="form.habilidades_especiais" rows="3" class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Idiomas</label>
                        <textarea name="idiomas" x-model="form.idiomas" rows="2" class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                    <div>
                        <label class="block text-parchment-900 font-cinzel font-bold mb-2">Notas de Combate</label>
                        <textarea name="notas_combate" x-model="form.notas_combate" rows="2" class="w-full bg-parchment-100 border-2 border-parchment-300 rounded p-3 font-lora focus:border-magic-500 shadow-inner"></textarea>
                    </div>
                </div>

                <div class="flex justify-between pt-4">
                    <button type="button" @click="prevStep()" class="btn-medieval bg-parchment-800 text-white font-cinzel py-2 px-8 rounded">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                    </button>
                    <button type="submit" class="btn-medieval bg-blood-700 text-white font-cinzel py-3 px-12 rounded shadow-xl hover:bg-blood-800 transition">
                        <i class="fa-solid fa-save mr-2"></i> SALVAR ALTERAÇÕES
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
        fichaOriginal: @json($ficha),
        
        attributes: [
            { key: 'forca', label: 'FORÇA' },
            { key: 'destreza', label: 'DESTREZA' },
            { key: 'constituicao', label: 'CONSTITUIÇÃO' },
            { key: 'inteligencia', label: 'INTELIGÊNCIA' },
            { key: 'sabedoria', label: 'SABEDORIA' },
            { key: 'carisma', label: 'CARISMA' }
        ],

        form: {
            versao: '{{ $ficha->versao }}',
            nome_personagem: '{{ $ficha->nome_personagem }}',
            nome_jogador: '{{ $ficha->nome_jogador }}',
            raca_id: {{ $ficha->raca_id }},
            classe_id: {{ $ficha->classe_id }},
            nivel: {{ $ficha->nivel }},
            xp_atual: {{ $ficha->xp_atual }},
            deslocamento: '{{ $ficha->deslocamento }}',
            ouro: {{ $ficha->ouro }},
            tendencia_id: {{ $ficha->tendencia_id }},
            divindade: '{{ $ficha->divindade }}',
            tamanho: '{{ $ficha->tamanho }}',
            idade: {{ $ficha->idade }},
            sexo: '{{ $ficha->sexo }}',
            altura: {{ $ficha->altura }},
            peso: {{ $ficha->peso }},
            olhos: '{{ $ficha->olhos }}',
            cabelos: '{{ $ficha->cabelos }}',
            pele: '{{ $ficha->pele }}',
            forca_base: {{ $ficha->forca_base }},
            destreza_base: {{ $ficha->destreza_base }},
            constituicao_base: {{ $ficha->constituicao_base }},
            inteligencia_base: {{ $ficha->inteligencia_base }},
            sabedoria_base: {{ $ficha->sabedoria_base }},
            carisma_base: {{ $ficha->carisma_base }},
            pv_max: {{ $ficha->pv_max }},
            bab: {{ $ficha->bab }},
            iniciativa_misc: {{ $ficha->iniciativa_misc }},
            ca_natural: {{ $ficha->ca_natural }},
            ca_deflexao: {{ $ficha->ca_deflexao }},
            ca_misc: {{ $ficha->ca_misc }},
            fortitude_base: {{ $ficha->fortitude_base }},
            fortitude_misc: {{ $ficha->fortitude_misc }},
            reflexos_base: {{ $ficha->reflexos_base }},
            reflexos_misc: {{ $ficha->reflexos_misc }},
            vontade_base: {{ $ficha->vontade_base }},
            vontade_misc: {{ $ficha->vontade_misc }},
            agarre_misc: {{ $ficha->agarre_misc }},
            talentos_descricao: @json($ficha->talentos_descricao),
            habilidades_especiais: @json($ficha->habilidades_especiais),
            idiomas: @json($ficha->idiomas),
            notas_combate: @json($ficha->notas_combate),
            pericias: {}
        },

        selectedItems: [],
        remainingGold: 0,
        currentRaca: null,
        currentClass: null,
        availableSkillPoints: 0,
        spentSkillPoints: 0,

        init() {
            // Popular perícias
            this.fichaOriginal.pericias.forEach(p => {
                this.form.pericias[p.id] = p.pivot.graduacoes;
            });

            // Popular inventário
            this.fichaOriginal.armas.forEach(a => this.selectedItems.push({ type: 'armas', id: a.id, price: a.preco }));
            this.fichaOriginal.armaduras.forEach(a => this.selectedItems.push({ type: 'armaduras', id: a.id, price: a.preco }));
            this.fichaOriginal.equipamentos.forEach(e => this.selectedItems.push({ type: 'equipamentos', id: e.id, price: e.preco }));

            this.updateRace();
            this.updateClass();
            this.calculateRemainingGold();
            this.calculateSpentSkillPoints();
        },

        calculateSpentSkillPoints() {
            let total = 0;
            this.pericias.forEach(p => {
                const ranks = this.form.pericias[p.id] || 0;
                const cost = this.isClassSkill(p.nome) ? 1 : 2;
                total += ranks * cost;
            });
            this.spentSkillPoints = total;
        },

        calculateRemainingGold() {
            let totalSpent = 0;
            this.selectedItems.forEach(item => {
                totalSpent += this.parsePrice(item.price);
            });
            this.remainingGold = (this.form.ouro - totalSpent).toFixed(2);
        },

        toggleItem(type, id, price) {
            const index = this.selectedItems.findIndex(i => i.type === type && i.id == id);
            if (index > -1) {
                this.selectedItems.splice(index, 1);
            } else {
                this.selectedItems.push({ type, id, price });
            }
            this.calculateRemainingGold();
        },

        parsePrice(priceStr) {
            if (!priceStr || priceStr === '-' || priceStr === '0') return 0;
            const match = priceStr.match(/([\d.]+)\s*([A-Z]+)/i);
            if (!match) return 0;
            const value = parseFloat(match[1]);
            const unit = match[2].toUpperCase();
            if (unit === 'PO') return value;
            if (unit === 'PP') return value / 10;
            if (unit === 'PC') return value / 100;
            return value;
        },

        nextStep() { if(this.step < 6) this.step++; window.sfx.playPage(); },
        prevStep() { if(this.step > 1) this.step--; window.sfx.playPage(); },

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

        formatMod(val) { return val >= 0 ? '+' + val : val; },

        calculateProgression() {
            if (!this.currentClass) return;
            const intMod = this.getMod('inteligencia');
            let pts = (this.currentClass.pontos_pericia + intMod);
            if (pts < 1) pts = 1;
            const lvl = this.form.nivel;
            this.availableSkillPoints = (pts * 4) + (pts * (lvl - 1));
            if (this.currentRaca && this.currentRaca.nome.includes('Humano')) {
                this.availableSkillPoints += (lvl === 1 ? 4 : 3 + lvl);
            }
            this.calculateSpentSkillPoints();
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

        getSkillRanks(id) { return this.form.pericias[id] || 0; },

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
            const attrKeyMap = { 'FOR': 'forca', 'DES': 'destreza', 'CON': 'constituicao', 'INT': 'inteligencia', 'SAB': 'sabedoria', 'CAR': 'carisma' };
            const mod = this.getMod(attrKeyMap[pericia.habilidade_chave]);
            return ranks + mod;
        },
        playMagic() { window.sfx.playMagic(); }
    }
}
</script>
@endsection
