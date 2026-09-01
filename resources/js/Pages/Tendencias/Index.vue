<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    tendencias: Array
});

const busca = ref('');

const tendenciasFiltradas = computed(() => filtrarPorNome(props.tendencias, busca.value));

const destroy = (id) => {
    if (confirm('Remover esta tendência?')) {
        router.delete(route('tendencias.destroy', id));
    }
};
</script>

<template>
    <Head title="Tendências" />

    <AppLayout>
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-widest">
                Tendências
            </h1>
            <p class="font-lora italic text-parchment-800 opacity-75">
                "A moral e a ética de um ser definem não apenas suas ações, mas também seu destino."
            </p>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar tendência pelo nome..."
            :resultados="tendenciasFiltradas.length"
            :total="tendencias.length"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-if="tendencias.length > 0 && tendenciasFiltradas.length === 0"
                class="col-span-full text-center py-16 font-lora italic text-parchment-600">
                Nenhuma tendência encontrada para "{{ busca }}".
            </div>

            <div v-for="tendencia in tendenciasFiltradas" :key="tendencia.id"
                class="glass-parchment rounded-xl shadow-xl overflow-hidden group hover:scale-105 transition-all duration-300 border border-parchment-400">

                <div class="p-6 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-cinzel font-bold text-parchment-900 uppercase tracking-wide group-hover:text-blood-700 transition">
                            {{ tendencia.nome }}
                        </h2>
                        <p v-if="tendencia.apelido" class="font-lora italic text-parchment-700 text-sm">{{ tendencia.apelido }}</p>
                    </div>
                    <span class="bg-blood-700/80 text-parchment-100 w-12 h-12 flex items-center justify-center rounded-full text-sm font-bold font-cinzel shadow-inner uppercase flex-shrink-0">
                        {{ tendencia.iniciais }}
                    </span>
                </div>

                <div class="p-6 space-y-4">
                    <p class="text-sm font-lora text-parchment-800 line-clamp-4 leading-relaxed italic">
                        {{ tendencia.descricao }}
                    </p>

                    <div class="flex justify-between items-center pt-4 border-t border-parchment-400/30">
                        <Link :href="route('tendencias.edit', tendencia.id)"
                            class="text-xs font-cinzel font-bold text-blood-700 hover:text-blood-800 transition flex items-center group/link">
                            Editar
                            <i class="fa-solid fa-pen-to-square ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </Link>
                        <button @click="destroy(tendencia.id)" class="text-parchment-800 opacity-40 hover:opacity-100 hover:text-blood-700 transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <Link :href="route('tendencias.create')"
                class="border-4 border-dashed border-parchment-400 rounded-xl flex flex-col items-center justify-center p-12 text-parchment-800 hover:bg-parchment-300/30 hover:border-blood-700 hover:text-blood-700 transition group min-h-[200px]">
                <i class="fa-solid fa-plus-circle text-5xl mb-4 group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-cinzel font-bold uppercase tracking-widest">Nova Tendência</span>
            </Link>
        </div>
    </AppLayout>
</template>
