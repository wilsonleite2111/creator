<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SearchInput from '@/Components/SearchInput.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { filtrarPorNome } from '@/utils/busca';

const props = defineProps({
    talentos: Array
});

const busca = ref('');

const talentosFiltrados = computed(() => filtrarPorNome(props.talentos, busca.value));

const destroy = (id) => {
    if (confirm('Remover este talento dos tomos?')) {
        router.delete(route('talentos.destroy', id));
    }
};
</script>

<template>
    <Head title="Talentos" />

    <AppLayout>
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-cinzel font-bold text-parchment-900 mb-2 uppercase tracking-widest">
                Talentos
            </h1>
            <p class="font-lora italic text-parchment-800 opacity-75">
                "Cada talento é um dom forjado pelo destino e aperfeiçoado pela dedicação."
            </p>
        </div>

        <SearchInput
            v-model="busca"
            placeholder="Buscar talento pelo nome..."
            :resultados="talentosFiltrados.length"
            :total="talentos.length"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-if="talentos.length > 0 && talentosFiltrados.length === 0"
                class="col-span-full text-center py-16 font-lora italic text-parchment-600">
                Nenhum talento encontrado para "{{ busca }}".
            </div>

            <div v-for="talento in talentosFiltrados" :key="talento.id"
                class="glass-parchment rounded-xl shadow-xl overflow-hidden group hover:scale-105 transition-all duration-300 border border-parchment-400">

                <div class="p-6 bg-parchment-300/30 border-b border-parchment-400 flex justify-between items-center">
                    <h2 class="text-xl font-cinzel font-bold text-parchment-900 uppercase tracking-wide group-hover:text-blood-700 transition">
                        {{ talento.nome }}
                    </h2>
                    <span v-if="talento.tipo" class="bg-parchment-700 text-parchment-100 px-3 py-1 rounded-full text-xs font-bold font-cinzel shadow-inner uppercase">
                        {{ talento.tipo }}
                    </span>
                </div>

                <div class="p-6 space-y-3">
                    <div v-if="talento.pre_requisitos" class="text-xs font-cinzel text-parchment-700">
                        <span class="font-bold uppercase">Pré-requisitos:</span>
                        <span class="font-lora italic ml-1">{{ talento.pre_requisitos }}</span>
                    </div>

                    <p v-if="talento.beneficio" class="text-sm font-lora text-parchment-800 leading-relaxed">
                        <span class="font-cinzel font-bold text-xs uppercase">Benefício: </span>{{ talento.beneficio }}
                    </p>

                    <p v-else-if="talento.descricao" class="text-sm font-lora text-parchment-800 line-clamp-3 leading-relaxed italic">
                        {{ talento.descricao }}
                    </p>

                    <div class="flex justify-between items-center pt-4 border-t border-parchment-400/30">
                        <Link :href="route('talentos.edit', talento.id)"
                            class="text-xs font-cinzel font-bold text-blood-700 hover:text-blood-800 transition flex items-center group/link">
                            Editar
                            <i class="fa-solid fa-pen-to-square ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </Link>
                        <button @click="destroy(talento.id)" class="text-parchment-800 opacity-40 hover:opacity-100 hover:text-blood-700 transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <Link :href="route('talentos.create')"
                class="border-4 border-dashed border-parchment-400 rounded-xl flex flex-col items-center justify-center p-12 text-parchment-800 hover:bg-parchment-300/30 hover:border-blood-700 hover:text-blood-700 transition group min-h-[200px]">
                <i class="fa-solid fa-plus-circle text-5xl mb-4 group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-cinzel font-bold uppercase tracking-widest">Novo Talento</span>
            </Link>
        </div>
    </AppLayout>
</template>
