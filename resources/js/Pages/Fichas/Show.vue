<script setup>
import { computed } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    ficha: Object
});

// Modificadores
const getMod = (score) => Math.floor((score - 10) / 2);
const mods = computed(() => ({
    for: getMod(props.ficha.forca_base),
    des: getMod(props.ficha.destreza_base),
    con: getMod(props.ficha.constituicao_base),
    int: getMod(props.ficha.inteligencia_base),
    sab: getMod(props.ficha.sabedoria_base),
    car: getMod(props.ficha.carisma_base),
}));

// Cálculos de Combate
const ca_total = computed(() => 10 + Number(props.ficha.ca_armadura) + Number(props.ficha.ca_escudo) + mods.value.des + Number(props.ficha.ca_tamanho) + Number(props.ficha.ca_natural) + Number(props.ficha.ca_deflexao) + Number(props.ficha.ca_misc));
const fortitude_total = computed(() => Number(props.ficha.fortitude_base) + mods.value.con + Number(props.ficha.fortitude_magia) + Number(props.ficha.fortitude_misc));
const reflexos_total = computed(() => Number(props.ficha.reflexos_base) + mods.value.des + Number(props.ficha.reflexos_magia) + Number(props.ficha.reflexos_misc));
const vontade_total = computed(() => Number(props.ficha.vontade_base) + mods.value.sab + Number(props.ficha.vontade_magia) + Number(props.ficha.vontade_misc));

</script>

<template>
    <AppLayout>
        <Head :title="'Ficha: ' + ficha.nome_personagem" />

        <div class="mb-6 flex justify-between items-center">
            <Link :href="route('fichas.index')" class="text-parchment-800 font-cinzel hover:text-blood-700 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Voltar ao Salão
            </Link>
            <div class="flex space-x-2">
                <Link :href="route('fichas.edit', ficha.id)" class="bg-blue-700 text-white px-6 py-2 rounded font-cinzel shadow-md hover:bg-blue-800 transition">
                    <i class="fa-solid fa-pen-nib mr-2"></i> Editar Ficha
                </Link>
                <v-btn color="blood-700" class="text-white font-cinzel" @click="window.print()">
                    <i class="fa-solid fa-print mr-2"></i> Imprimir
                </v-btn>
            </div>
        </div>

        <!-- A FICHA (Réplica do PDF) -->
        <div class="glass-parchment p-8 shadow-2xl rounded-sm border-2 border-parchment-900 bg-parchment-pattern max-w-6xl mx-auto printable-sheet">
            <!-- Cabeçalho -->
            <div class="grid grid-cols-12 gap-4 border-b-4 border-parchment-900 pb-6 mb-6">
                <div class="col-span-12 md:col-span-5">
                    <p class="text-[10px] font-bold uppercase text-blood-800">Nome do Personagem</p>
                    <p class="text-3xl font-cinzel font-bold border-b border-parchment-900/30">{{ ficha.nome_personagem }}</p>
                </div>
                <div class="col-span-12 md:col-span-7 grid grid-cols-3 gap-2">
                    <div>
                        <p class="text-[10px] font-bold uppercase text-parchment-700">Jogador</p>
                        <p class="font-lora font-bold border-b border-parchment-900/30">{{ ficha.nome_jogador }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-parchment-700">Classe / Nível</p>
                        <p class="font-lora font-bold border-b border-parchment-900/30">{{ ficha.classe ? ficha.classe.nome : 'N/A' }} {{ ficha.nivel }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase text-parchment-700">Raça</p>
                        <p class="font-lora font-bold border-b border-parchment-900/30">{{ ficha.raca ? ficha.raca.nome : 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <v-row>
                <!-- Lado Esquerdo: Atributos -->
                <v-col cols="12" md="3" class="border-r-2 border-parchment-900/10">
                    <div class="space-y-4">
                        <div v-for="(stat, key) in { FOR: 'forca_base', DES: 'destreza_base', CON: 'constituicao_base', INT: 'inteligencia_base', SAB: 'sabedoria_base', CAR: 'carisma_base' }" :key="key" class="flex items-center">
                            <div class="bg-parchment-900 text-white w-14 h-14 flex flex-col items-center justify-center rounded-l shadow-lg">
                                <span class="text-[8px] font-bold">{{ key }}</span>
                                <span class="text-xl font-cinzel font-bold">{{ mods[key.toLowerCase()] >= 0 ? '+' + mods[key.toLowerCase()] : mods[key.toLowerCase()] }}</span>
                            </div>
                            <div class="flex-grow border-2 border-parchment-900 border-l-0 p-2 text-center rounded-r bg-white/50">
                                <p class="text-2xl font-cinzel font-bold">{{ ficha[stat] }}</p>
                            </div>
                        </div>
                    </div>
                </v-col>

                <!-- Centro: Combate e Defesa -->
                <v-col cols="12" md="6">
                    <div class="space-y-6">
                        <!-- CA e Vida -->
                        <div class="flex justify-between items-start">
                            <div class="flex items-center">
                                <div class="bg-parchment-900 text-white p-4 rounded-lg shadow-xl text-center">
                                    <p class="text-[10px] font-bold uppercase opacity-60">CA</p>
                                    <p class="text-5xl font-cinzel font-bold">{{ ca_total }}</p>
                                </div>
                                <div class="ml-4 space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs font-bold uppercase text-parchment-700 w-16">Toque</span>
                                        <span class="font-cinzel font-bold text-xl">{{ 10 + mods.des }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs font-bold uppercase text-parchment-700 w-16">Surpreso</span>
                                        <span class="font-cinzel font-bold text-xl">{{ ca_total - mods.des }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-[10px] font-bold uppercase text-blood-700">Pontos de Vida</p>
                                <div class="flex items-end justify-end space-x-1">
                                    <span class="text-4xl font-cinzel font-bold">{{ ficha.pv_max }}</span>
                                    <span class="text-xl opacity-30">/</span>
                                    <span class="text-xl opacity-30">{{ ficha.pv_max }}</span>
                                </div>
                                <div class="w-full bg-parchment-300 h-2 rounded-full mt-1 overflow-hidden">
                                    <div class="bg-blood-700 h-full w-full"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Resistências -->
                        <div class="grid grid-cols-3 gap-4">
                            <div v-for="save in [
                                { id: 'fortitude', name: 'Fortitude', total: fortitude_total, icon: 'fa-heart' },
                                { id: 'reflexos', name: 'Reflexos', total: reflexos_total, icon: 'fa-bolt' },
                                { id: 'vontade', name: 'Vontade', total: vontade_total, icon: 'fa-brain' }
                            ]" :key="save.id" class="border-2 border-parchment-900 p-2 rounded relative bg-white/30 shadow-inner">
                                <p class="text-[8px] font-bold uppercase text-parchment-700 mb-1">{{ save.name }}</p>
                                <p class="text-2xl font-cinzel font-bold">{{ save.total >= 0 ? '+' : '' }}{{ save.total }}</p>
                                <i :class="['fa-solid', save.icon, 'absolute top-1 right-2 opacity-10 text-xl']"></i>
                            </div>
                        </div>

                        <!-- Ataque -->
                        <div class="border-2 border-parchment-900 p-4 rounded bg-white/30 shadow-inner">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-[8px] font-bold uppercase text-parchment-700">BBA</p>
                                    <p class="text-2xl font-cinzel font-bold">+{{ ficha.bab }}</p>
                                </div>
                                <div>
                                    <p class="text-[8px] font-bold uppercase text-parchment-700">Iniciativa</p>
                                    <p class="text-2xl font-cinzel font-bold">{{ mods.des >= 0 ? '+' : '' }}{{ mods.des }}</p>
                                </div>
                                <div>
                                    <p class="text-[8px] font-bold uppercase text-parchment-700">Velocidade</p>
                                    <p class="text-2xl font-cinzel font-bold">{{ ficha.deslocamento }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </v-col>

                <!-- Lado Direito: Perícias -->
                <v-col cols="12" md="3" class="border-l-2 border-parchment-900/10">
                    <div class="bg-white/40 p-3 rounded border border-parchment-900/20">
                        <h4 class="font-cinzel font-bold text-center border-b border-parchment-900/20 pb-1 mb-2 text-xs">Perícias</h4>
                        <div class="space-y-1 text-[10px] max-h-[600px] overflow-y-auto pr-1">
                            <div v-for="p in ficha.pericias" :key="p.id" class="flex justify-between border-b border-parchment-900/10 pb-1">
                                <span class="font-bold">{{ p.nome }}</span>
                                <span class="font-cinzel font-bold">{{ p.pivot.graduacoes + getMod(ficha[p.habilidade_chave.toLowerCase() + '_base']) }}</span>
                            </div>
                        </div>
                    </div>
                </v-col>
            </v-row>

            <!-- Rodapé da Ficha: Talentos e Equipamento -->
            <v-row class="mt-6">
                <v-col cols="12" md="6">
                    <h4 class="font-cinzel font-bold border-b-2 border-parchment-900 mb-2 uppercase text-sm">Talentos & Habilidades</h4>
                    <div class="font-lora text-sm italic whitespace-pre-line leading-tight">
                        {{ ficha.talentos_descricao || 'Nenhum talento registrado.' }}
                    </div>
                </v-col>
                <v-col cols="12" md="6">
                    <h4 class="font-cinzel font-bold border-b-2 border-parchment-900 mb-2 uppercase text-sm">Inventário & Riqueza</h4>
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex space-x-2">
                            <div class="bg-parchment-300 p-2 rounded text-center min-w-[60px]">
                                <span class="text-[8px] font-bold block">PO</span>
                                <span class="font-cinzel font-bold">{{ ficha.ouro }}</span>
                            </div>
                            <div class="bg-parchment-300 p-2 rounded text-center min-w-[60px]">
                                <span class="text-[8px] font-bold block">PP</span>
                                <span class="font-cinzel font-bold">{{ ficha.dinheiro_pp }}</span>
                            </div>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </div>
    </AppLayout>
</template>

<style scoped>
@media print {
    aside, footer, .mb-6 { display: none !important; }
    .printable-sheet { 
        border: none !important; 
        box-shadow: none !important; 
        margin: 0 !important; 
        padding: 0 !important;
        background: white !important;
    }
}
</style>
