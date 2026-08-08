<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ divindade: Object });

const form = useForm({
    nome: props.divindade.nome,
    titulo: props.divindade.titulo ?? '',
    versao: props.divindade.versao ?? '3.5',
    tendencia: props.divindade.tendencia ?? '',
    dominios: props.divindade.dominios ?? '',
    arma_preferida: props.divindade.arma_preferida ?? '',
    descricao: props.divindade.descricao ?? '',
});

const submit = () => form.put(route('divindades.update', props.divindade.id));
</script>

<template>
    <Head title="Editar Divindade" />

    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">Editar Divindade</h1>
                <p class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ divindade.nome }}</p>
            </div>

            <form @submit.prevent="submit" class="glass-parchment rounded-xl p-8 space-y-6 border border-parchment-400 shadow-xl">
                <div>
                    <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Nome *</label>
                    <input v-model="form.nome" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    <p v-if="form.errors.nome" class="text-blood-700 text-sm mt-1">{{ form.errors.nome }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Título</label>
                        <input v-model="form.titulo" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Tendência</label>
                        <input v-model="form.tendencia" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Domínios</label>
                        <input v-model="form.dominios" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Arma Preferida</label>
                        <input v-model="form.arma_preferida" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    </div>
                </div>

                <div>
                    <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Descrição</label>
                    <textarea v-model="form.descricao" rows="4" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700 resize-none"></textarea>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-parchment-400/30">
                    <Link :href="route('divindades.index')" class="px-6 py-2 font-cinzel border border-parchment-400 rounded-lg hover:bg-parchment-300 transition">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-6 py-2 font-cinzel font-bold bg-blood-700 text-parchment-100 rounded-lg hover:bg-blood-800 transition disabled:opacity-50">Salvar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
