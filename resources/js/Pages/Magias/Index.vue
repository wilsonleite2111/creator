<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    magias: Array,
    versao: String
});

const deleteMagia = (id) => {
    if (confirm('Deseja dissipar esta magia para sempre?')) {
        router.delete(route('magias.destroy', id));
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Grimório" />

        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-wand-sparkles text-magic-600 mr-3"></i>Grimório de Magias
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"O conhecimento arcano e divino registrado para a eternidade."</p>
            </div>
            <Link :href="route('magias.create')" class="bg-magic-600 text-white px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-magic-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Nova Magia
            </Link>
        </div>

        <v-card class="glass-parchment border border-parchment-400" elevation="4">
            <v-table class="bg-transparent">
                <thead class="bg-parchment-300 font-cinzel">
                    <tr>
                        <th class="text-left">Nome</th>
                        <th class="text-left">Escola</th>
                        <th class="text-left">Classes / Nível</th>
                        <th class="text-left">Componentes</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody class="font-lora">
                    <tr v-for="magia in magias" :key="magia.id" class="hover:bg-parchment-200 transition-colors">
                        <td class="font-bold">{{ magia.nome }}</td>
                        <td>{{ magia.escola }}</td>
                        <td>
                            <div class="flex flex-wrap gap-1">
                                <span v-for="classe in magia.classes" :key="classe.id" class="bg-parchment-400/30 px-2 py-0.5 rounded-full text-[10px]">
                                    {{ classe.nome }} ({{ classe.pivot.nivel }})
                                </span>
                            </div>
                        </td>
                        <td>{{ magia.componentes }}</td>
                        <td class="text-center">
                            <div class="flex justify-center space-x-3">
                                <Link :href="route('magias.show', magia.id)" class="text-magic-600 hover:text-magic-800 transition">
                                    <i class="fa-solid fa-scroll"></i>
                                </Link>
                                <Link :href="route('magias.edit', magia.id)" class="text-blue-600 hover:text-blue-800 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </Link>
                                <button @click="deleteMagia(magia.id)" class="text-blood-700 hover:text-blood-900 transition">
                                    <i class="fa-solid fa-fire-burner"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="magias.length === 0">
                        <td colspan="5" class="text-center py-12 italic text-parchment-600">
                            Nenhuma magia registrada neste grimório.
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </AppLayout>
</template>
