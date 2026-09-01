<script setup>
import { computed } from 'vue';

const termo = defineModel({ type: String, default: '' });

const props = defineProps({
    placeholder: { type: String, default: 'Buscar pelo nome...' },
    resultados: { type: Number, default: null },
    total: { type: Number, default: null },
});

const temBusca = computed(() => termo.value.trim().length > 0);

const mostrarContador = computed(
    () => temBusca.value && props.resultados !== null && props.total !== null
);
</script>

<template>
    <div class="mb-8">
        <div class="relative max-w-md mx-auto">
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-parchment-600 text-sm pointer-events-none"></i>

            <input
                v-model="termo"
                type="text"
                :placeholder="placeholder"
                class="w-full glass-parchment border border-parchment-400 rounded-lg py-3 pl-11 pr-11 font-lora text-parchment-900 placeholder:text-parchment-600 placeholder:italic shadow-inner focus:outline-none focus:border-blood-700 focus:ring-1 focus:ring-blood-700 transition"
            />

            <button
                v-if="temBusca"
                type="button"
                aria-label="Limpar busca"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-parchment-600 hover:text-blood-700 transition"
                @click="termo = ''"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <p
            v-if="mostrarContador"
            class="text-center mt-2 text-xs font-cinzel uppercase tracking-widest text-parchment-700"
        >
            {{ resultados }} de {{ total }}
        </p>
    </div>
</template>
