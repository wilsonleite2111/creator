<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    equipamentos: Array
});

const busca = ref('');

const equipamentosFiltrados = computed(() => filtrarPorNome(props.equipamentos, busca.value));

const destroy = (id) => {
    if (confirm('Remover este item do inventário?')) {
        router.delete(route('equipamentos.destroy', id));
    }
};
</script>

<template>
    <Head title="Itens" />

    <AppLayout>
        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-sack-xmark text-blood-700 mr-3"></i>Inventário de Itens
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"Um aventureiro bem equipado está sempre preparado para o inesperado."</p>
            </div>
            <Link :href="route('equipamentos.create')" class="bg-blood-700 text-parchment-100 px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-blood-800 transition">
                <i class="fa-solid fa-plus mr-2"></i> Novo Item
            </Link>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar item pelo nome..."
            :resultados="equipamentosFiltrados.length"
            :total="equipamentos.length"
        />

        <v-card class="glass-parchment border border-parchment-400" elevation="4">
            <v-table class="bg-transparent">
                <thead class="bg-parchment-300 font-cinzel">
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Preço</th>
                        <th class="text-left">Peso</th>
                        <th class="text-left">Descrição</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="font-lora">
                    <tr v-for="equipamento in equipamentosFiltrados" :key="equipamento.id" class="hover:bg-parchment-200 transition-colors">
                        <td class="font-bold font-cinzel">{{ equipamento.nome }}</td>
                        <td>{{ equipamento.preco ?? '—' }}</td>
                        <td>{{ equipamento.peso != null ? equipamento.peso + ' kg' : '—' }}</td>
                        <td class="max-w-xs truncate italic text-sm">{{ equipamento.descricao ?? '—' }}</td>
                        <td class="text-center">
                            <div class="flex justify-center space-x-3">
                                <Link :href="route('equipamentos.edit', equipamento.id)" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button @click="destroy(equipamento.id)" class="text-blood-700 hover:text-blood-900 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="equipamentosFiltrados.length === 0">
                        <td colspan="5" class="text-center py-12 italic text-parchment-600">
                            <template v-if="equipamentos.length === 0">Nenhum item registrado no inventário.</template>
                            <template v-else>Nenhum item encontrado para "{{ busca }}".</template>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </AppLayout>
</template>
