<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    divindades: Array
});

const busca = ref('');

const divindadesFiltradas = computed(() => filtrarPorNome(props.divindades, busca.value));

const destroy = (id) => {
    if (confirm('Remover esta divindade do Panteão?')) {
        router.delete(route('divindades.destroy', id));
    }
};
</script>

<template>
    <Head title="Divindades" />

    <AppLayout>
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-widest">
                Panteão
            </h1>
            <p class="font-lora italic text-parchment-800 opacity-75">
                "Os deuses observam os mortais com interesse, concedendo dons àqueles que os servem fielmente."
            </p>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar divindade pelo nome..."
            :resultados="divindadesFiltradas.length"
            :total="divindades.length"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-if="divindades.length > 0 && divindadesFiltradas.length === 0"
                class="col-span-full text-center py-16 font-lora italic text-parchment-600">
                Nenhuma divindade encontrada para "{{ busca }}".
            </div>

            <div v-for="divindade in divindadesFiltradas" :key="divindade.id"
                class="glass-parchment rounded-xl shadow-xl overflow-hidden group hover:scale-105 transition-all duration-300 border border-parchment-400">

                <div class="p-6 bg-parchment-300/30 border-b border-parchment-400">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-cinzel font-bold text-parchment-900 uppercase tracking-wide group-hover:text-blood-700 transition">
                                {{ divindade.nome }}
                            </h2>
                            <p v-if="divindade.titulo" class="font-lora italic text-parchment-700 text-sm mt-0.5">{{ divindade.titulo }}</p>
                        </div>
                        <span v-if="divindade.tendencia" class="bg-magic-600/20 border border-magic-600/40 text-magic-700 px-2 py-1 rounded text-xs font-bold font-cinzel uppercase">
                            {{ divindade.tendencia }}
                        </span>
                    </div>
                </div>

                <div class="p-6 space-y-3">
                    <div v-if="divindade.dominios" class="text-xs font-cinzel text-parchment-700">
                        <i class="fa-solid fa-sun text-magic-600 mr-1"></i>
                        <span class="font-bold uppercase">Domínios:</span>
                        <span class="font-lora italic ml-1">{{ divindade.dominios }}</span>
                    </div>

                    <div v-if="divindade.arma_preferida" class="text-xs font-cinzel text-parchment-700">
                        <i class="fa-solid fa-khanda text-blood-700 mr-1"></i>
                        <span class="font-bold uppercase">Arma:</span>
                        <span class="font-lora italic ml-1">{{ divindade.arma_preferida }}</span>
                    </div>

                    <p v-if="divindade.descricao" class="text-sm font-lora text-parchment-800 line-clamp-3 leading-relaxed italic">
                        {{ divindade.descricao }}
                    </p>

                    <div class="flex justify-between items-center pt-4 border-t border-parchment-400/30">
                        <Link :href="route('divindades.edit', divindade.id)"
                            class="text-xs font-cinzel font-bold text-blood-700 hover:text-blood-800 transition flex items-center group/link">
                            Editar
                            <i class="fa-solid fa-pen-to-square ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </Link>
                        <button @click="destroy(divindade.id)" class="text-parchment-800 opacity-40 hover:opacity-100 hover:text-blood-700 transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <Link :href="route('divindades.create')"
                class="border-4 border-dashed border-parchment-400 rounded-xl flex flex-col items-center justify-center p-12 text-parchment-800 hover:bg-parchment-300/30 hover:border-blood-700 hover:text-blood-700 transition group min-h-[200px]">
                <i class="fa-solid fa-plus-circle text-5xl mb-4 group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-cinzel font-bold uppercase tracking-widest">Nova Divindade</span>
            </Link>
        </div>
    </AppLayout>
</template>
