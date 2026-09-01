<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    armas: Array
});

const busca = ref('');

const armasFiltradas = computed(() => filtrarPorNome(props.armas, busca.value));

const destroy = (id) => {
    if (confirm('Remover esta arma do arsenal?')) {
        router.delete(route('armas.destroy', id));
    }
};
</script>

<template>
    <Head title="Armas" />

    <AppLayout>
        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-sword text-blood-700 mr-3"></i>Arsenal de Armas
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"Cada lâmina conta sua própria história de batalha."</p>
            </div>
            <Link :href="route('armas.create')" class="bg-blood-700 text-parchment-100 px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-blood-800 transition">
                <i class="fa-solid fa-plus mr-2"></i> Nova Arma
            </Link>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar arma pelo nome..."
            :resultados="armasFiltradas.length"
            :total="armas.length"
        />

        <v-card class="glass-parchment border border-parchment-400" elevation="4">
            <v-table class="bg-transparent">
                <thead class="bg-parchment-300 font-cinzel">
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Dano (P)</th>
                        <th class="text-left">Dano (M)</th>
                        <th class="text-left">Crítico</th>
                        <th class="text-left">Alcance</th>
                        <th class="text-left">Tipo</th>
                        <th class="text-left">Categoria</th>
                        <th class="text-left">Preço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="font-lora">
                    <tr v-for="arma in armasFiltradas" :key="arma.id" class="hover:bg-parchment-200 transition-colors">
                        <td class="font-bold font-cinzel">{{ arma.nome }}</td>
                        <td>{{ arma.dano_p ?? '—' }}</td>
                        <td>{{ arma.dano_m ?? '—' }}</td>
                        <td>{{ arma.critico ?? '—' }}</td>
                        <td>{{ arma.alcance ?? '—' }}</td>
                        <td>{{ arma.tipo ?? '—' }}</td>
                        <td>{{ arma.categoria ?? '—' }}</td>
                        <td>{{ arma.preco ?? '—' }}</td>
                        <td class="text-center">
                            <div class="flex justify-center space-x-3">
                                <Link :href="route('armas.edit', arma.id)" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button @click="destroy(arma.id)" class="text-blood-700 hover:text-blood-900 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="armasFiltradas.length === 0">
                        <td colspan="9" class="text-center py-12 italic text-parchment-600">
                            <template v-if="armas.length === 0">Nenhuma arma registrada no arsenal.</template>
                            <template v-else>Nenhuma arma encontrada para "{{ busca }}".</template>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </AppLayout>
</template>
