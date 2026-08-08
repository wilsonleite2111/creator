<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ tendencia: Object });

const form = useForm({
    nome: props.tendencia.nome,
    apelido: props.tendencia.apelido,
    iniciais: props.tendencia.iniciais,
    descricao: props.tendencia.descricao,
});

const submit = () => form.put(route('tendencias.update', props.tendencia.id));
</script>

<template>
    <Head title="Editar Tendência" />

    <AppLayout>
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">Editar Tendência</h1>
                <p class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ tendencia.nome }}</p>
            </div>

            <form @submit.prevent="submit" class="glass-parchment rounded-xl p-8 space-y-6 border border-parchment-400 shadow-xl">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Nome *</label>
                        <input v-model="form.nome" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                        <p v-if="form.errors.nome" class="text-blood-700 text-sm mt-1">{{ form.errors.nome }}</p>
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Iniciais *</label>
                        <input v-model="form.iniciais" type="text" maxlength="10" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700 uppercase" />
                    </div>
                </div>

                <div>
                    <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Apelido *</label>
                    <input v-model="form.apelido" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                    <p v-if="form.errors.apelido" class="text-blood-700 text-sm mt-1">{{ form.errors.apelido }}</p>
                </div>

                <div>
                    <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Descrição *</label>
                    <textarea v-model="form.descricao" rows="5" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700 resize-none"></textarea>
                    <p v-if="form.errors.descricao" class="text-blood-700 text-sm mt-1">{{ form.errors.descricao }}</p>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-parchment-400/30">
                    <Link :href="route('tendencias.index')" class="px-6 py-2 font-cinzel border border-parchment-400 rounded-lg hover:bg-parchment-300 transition">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-6 py-2 font-cinzel font-bold bg-blood-700 text-parchment-100 rounded-lg hover:bg-blood-800 transition disabled:opacity-50">Salvar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
