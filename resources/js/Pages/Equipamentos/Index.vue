<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    equipamentos: Array
});

const ORDEM_CATEGORIAS = [
    'Equipamentos de aventura',
    'Itens e substâncias especiais',
    'Instrumentos de classe e kits de perícia',
    'Indumentária',
    'Comida, bebida e hospedagem',
    'Montarias e equipamentos relacionados',
    'Transporte',
    'Conjuração e serviços',
];

const busca = ref('');
const categoriaAtiva = ref(ORDEM_CATEGORIAS[0]);

const equipamentosFiltrados = computed(() => filtrarPorNome(props.equipamentos, busca.value));

const equipamentosPorCategoria = computed(() => {
    const grupos = {};
    for (const eq of equipamentosFiltrados.value) {
        const cat = eq.categoria || 'Outros';
        (grupos[cat] = grupos[cat] || []).push(eq);
    }
    return grupos;
});

watch(busca, () => {
    if ((equipamentosPorCategoria.value[categoriaAtiva.value] || []).length) return;
    const comResultado = ORDEM_CATEGORIAS.find(c => (equipamentosPorCategoria.value[c] || []).length > 0);
    if (comResultado) categoriaAtiva.value = comResultado;
});

const totalEncontrado = computed(() => equipamentosFiltrados.value.length);

const destroy = (id) => {
    if (confirm('Remover este equipamento?')) {
        router.delete(route('equipamentos.destroy', id));
    }
};
</script>

<template>
    <Head title="Equipamentos" />

    <AppLayout>
        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-bag-shopping text-blood-700 mr-3"></i>Equipamentos
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"Um bom aventureiro é aquele que carrega o certo — e apenas o certo."</p>
            </div>
            <Link :href="route('equipamentos.create')" class="bg-blood-700 text-parchment-100 px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-blood-800 transition">
                <i class="fa-solid fa-plus mr-2"></i> Novo Equipamento
            </Link>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar equipamento pelo nome..."
            :resultados="totalEncontrado"
            :total="equipamentos.length"
        />

        <div v-if="equipamentos.length === 0" class="text-center py-24 italic text-parchment-600 font-lora text-lg">
            Nenhum equipamento registrado.
        </div>

        <div v-else-if="totalEncontrado === 0" class="text-center py-24 italic text-parchment-600 font-lora text-lg">
            Nenhum equipamento encontrado para "{{ busca }}".
        </div>

        <div v-else class="flex gap-6">
            <div class="flex-shrink-0 w-56">
                <p class="font-cinzel text-xs font-bold uppercase tracking-widest text-parchment-700 mb-3 px-1">Categorias</p>
                <div class="flex flex-col gap-1">
                    <button v-for="cat in ORDEM_CATEGORIAS" :key="cat"
                        v-show="(equipamentosPorCategoria[cat] || []).length > 0"
                        @click="categoriaAtiva = cat"
                        :class="[
                            'text-left px-3 py-2 rounded-lg font-cinzel text-xs font-bold transition-all duration-200 border leading-tight',
                            categoriaAtiva === cat
                                ? 'bg-blood-700 text-parchment-100 border-blood-800 shadow-md'
                                : 'bg-parchment-200/60 text-parchment-800 border-parchment-300 hover:bg-parchment-300 hover:border-parchment-400'
                        ]">
                        {{ cat }}
                        <span :class="['ml-1 text-[10px] font-normal', categoriaAtiva === cat ? 'text-parchment-200' : 'text-parchment-600']">
                            ({{ (equipamentosPorCategoria[cat] || []).length }})
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
                                <th class="text-left text-xs">Descrição</th>
                                <th class="text-left text-xs">Peso</th>
                                <th class="text-left text-xs">Preço</th>
                                <th class="text-center text-xs">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="font-lora">
                            <tr v-for="eq in equipamentosPorCategoria[categoriaAtiva] || []" :key="eq.id" class="hover:bg-parchment-200/60 transition-colors">
                                <td class="font-bold font-cinzel text-sm">{{ eq.nome }}</td>
                                <td class="text-xs italic text-parchment-700 max-w-xl">
                                    <span class="line-clamp-2">{{ eq.descricao }}</span>
                                </td>
                                <td class="text-xs">{{ eq.peso }} kg</td>
                                <td class="text-xs text-blood-700 font-bold">{{ eq.preco }}</td>
                                <td class="text-center">
                                    <div class="flex justify-center space-x-2">
                                        <Link :href="route('equipamentos.edit', eq.id)" class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </Link>
                                        <button @click="destroy(eq.id)" class="text-blood-700 hover:text-blood-900 transition">
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
