<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    armaduras: Array
});

const busca = ref('');

const armadurasFiltradas = computed(() => filtrarPorNome(props.armaduras, busca.value));

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
                <p class="text-parchment-800 mt-2 italic font-lora">"A melhor proteção é aquela forjada pelo melhor ferreiro."</p>
            </div>
            <Link :href="route('armaduras.create')" class="bg-blood-700 text-parchment-100 px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-blood-800 transition">
                <i class="fa-solid fa-plus mr-2"></i> Nova Armadura
            </Link>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar armadura pelo nome..."
            :resultados="armadurasFiltradas.length"
            :total="armaduras.length"
        />

        <v-card class="glass-parchment border border-parchment-400" elevation="4">
            <v-table class="bg-transparent">
                <thead class="bg-parchment-300 font-cinzel">
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Tipo</th>
                        <th class="text-center">Bônus CA</th>
                        <th class="text-center">Máx. DES</th>
                        <th class="text-center">Pen. Arm.</th>
                        <th class="text-center">Falha Arc.</th>
                        <th class="text-left">Peso</th>
                        <th class="text-left">Preço</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="font-lora">
                    <tr v-for="armadura in armadurasFiltradas" :key="armadura.id" class="hover:bg-parchment-200 transition-colors">
                        <td class="font-bold font-cinzel">{{ armadura.nome }}</td>
                        <td>{{ armadura.tipo ?? '—' }}</td>
                        <td class="text-center font-bold text-magic-700">+{{ armadura.bonus_ca }}</td>
                        <td class="text-center">{{ armadura.destreza_max ?? '—' }}</td>
                        <td class="text-center">{{ armadura.penalidade_armadura ?? '0' }}</td>
                        <td class="text-center">{{ armadura.falha_arcana != null ? armadura.falha_arcana + '%' : '—' }}</td>
                        <td>{{ armadura.peso != null ? armadura.peso + ' kg' : '—' }}</td>
                        <td>{{ armadura.preco ?? '—' }}</td>
                        <td class="text-center">
                            <div class="flex justify-center space-x-3">
                                <Link :href="route('armaduras.edit', armadura.id)" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button @click="destroy(armadura.id)" class="text-blood-700 hover:text-blood-900 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="armadurasFiltradas.length === 0">
                        <td colspan="9" class="text-center py-12 italic text-parchment-600">
                            <template v-if="armaduras.length === 0">Nenhuma armadura registrada no arsenal.</template>
                            <template v-else>Nenhuma armadura encontrada para "{{ busca }}".</template>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </AppLayout>
</template>
