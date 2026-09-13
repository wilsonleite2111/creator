<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    armaduras: Array
});

const ORDEM_TIPOS = ['Leve', 'Média', 'Pesada', 'Escudo'];
const LABEL_TIPOS = { 'Leve': 'Leves', 'Média': 'Médias', 'Pesada': 'Pesadas', 'Escudo': 'Escudos' };

const busca = ref('');
const tipoAtivo = ref('Leve');

const armadurasFiltradas = computed(() => filtrarPorNome(props.armaduras, busca.value));

const armadurasPorTipo = computed(() => {
    const grupos = {};
    for (const a of armadurasFiltradas.value) {
        const tipo = a.tipo || 'Outras';
        (grupos[tipo] = grupos[tipo] || []).push(a);
    }
    return grupos;
});

watch(busca, () => {
    if ((armadurasPorTipo.value[tipoAtivo.value] || []).length) return;
    const comResultado = ORDEM_TIPOS.find(t => (armadurasPorTipo.value[t] || []).length > 0);
    if (comResultado) tipoAtivo.value = comResultado;
});

const totalEncontrado = computed(() => armadurasFiltradas.value.length);

const destroy = (id) => {
    if (confirm('Remover esta armadura do arsenal?')) {
        router.delete(route('armaduras.destroy', id));
    }
};
</script>

<template>
    <Head title="Armaduras" />

    <AppLayout>
        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-shield-halved text-blood-700 mr-3"></i>Arsenal de Armaduras
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"Antes de erguer a lâmina, envergue a armadura."</p>
            </div>
            <Link :href="route('armaduras.create')" class="bg-blood-700 text-parchment-100 px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-blood-800 transition">
                <i class="fa-solid fa-plus mr-2"></i> Nova Armadura
            </Link>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar armadura pelo nome..."
            :resultados="totalEncontrado"
            :total="armaduras.length"
        />

        <div v-if="armaduras.length === 0" class="text-center py-24 italic text-parchment-600 font-lora text-lg">
            Nenhuma armadura registrada.
        </div>

        <div v-else-if="totalEncontrado === 0" class="text-center py-24 italic text-parchment-600 font-lora text-lg">
            Nenhuma armadura encontrada para "{{ busca }}".
        </div>

        <div v-else class="flex gap-6">
            <div class="flex-shrink-0 w-44">
                <p class="font-cinzel text-xs font-bold uppercase tracking-widest text-parchment-700 mb-3 px-1">Tipo</p>
                <div class="flex flex-col gap-1">
                    <button v-for="tipo in ORDEM_TIPOS" :key="tipo"
                        v-show="(armadurasPorTipo[tipo] || []).length > 0"
                        @click="tipoAtivo = tipo"
                        :class="[
                            'text-left px-4 py-2.5 rounded-lg font-cinzel text-sm font-bold transition-all duration-200 border',
                            tipoAtivo === tipo
                                ? 'bg-blood-700 text-parchment-100 border-blood-800 shadow-md'
                                : 'bg-parchment-200/60 text-parchment-800 border-parchment-300 hover:bg-parchment-300 hover:border-parchment-400'
                        ]">
                        {{ LABEL_TIPOS[tipo] }}
                        <span :class="['ml-1 text-[10px] font-normal', tipoAtivo === tipo ? 'text-parchment-200' : 'text-parchment-600']">
                            ({{ (armadurasPorTipo[tipo] || []).length }})
                        </span>
                    </button>
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <v-card class="glass-parchment border border-parchment-400" elevation="2">
                    <v-table class="bg-transparent" density="compact">
                        <thead class="bg-parchment-300/80 font-cinzel">
                            <tr>
                                <th class="text-left text-xs">Nome</th>
                                <th class="text-center text-xs">Bônus CA</th>
                                <th class="text-center text-xs">DES máx</th>
                                <th class="text-center text-xs">Penal</th>
                                <th class="text-center text-xs">Falha</th>
                                <th class="text-left text-xs">Desl 9/6</th>
                                <th class="text-left text-xs">Peso</th>
                                <th class="text-left text-xs">Preço</th>
                                <th class="text-center text-xs">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="font-lora">
                            <tr v-for="armadura in armadurasPorTipo[tipoAtivo] || []" :key="armadura.id" class="hover:bg-parchment-200/60 transition-colors">
                                <td class="font-bold font-cinzel text-sm">{{ armadura.nome }}</td>
                                <td class="text-center text-xs">+{{ armadura.bonus_ca }}</td>
                                <td class="text-center text-xs">{{ armadura.destreza_max !== null ? '+' + armadura.destreza_max : '—' }}</td>
                                <td class="text-center text-xs">{{ armadura.penalidade_armadura }}</td>
                                <td class="text-center text-xs">{{ armadura.falha_arcana }}%</td>
                                <td class="text-xs">{{ armadura.deslocamento_9m }} / {{ armadura.deslocamento_6m }}</td>
                                <td class="text-xs">{{ armadura.peso }} kg</td>
                                <td class="text-xs text-blood-700 font-bold">{{ armadura.preco }}</td>
                                <td class="text-center">
                                    <div class="flex justify-center space-x-2">
                                        <Link :href="route('armaduras.edit', armadura.id)" class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </Link>
                                        <button @click="destroy(armadura.id)" class="text-blood-700 hover:text-blood-900 transition">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </v-card>
            </div>
        </div>
    </AppLayout>
</template>
