<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ classe: Object });

const form = useForm({
    nome: props.classe.nome,
    versao: props.classe.versao ?? '3.5',
    descricao: props.classe.descricao ?? '',
    dado_vida: props.classe.dado_vida ?? null,
    bba_progressao: props.classe.bba_progressao ?? '',
    resistencia_fortitude: props.classe.resistencia_fortitude ?? '',
    resistencia_reflexos: props.classe.resistencia_reflexos ?? '',
    resistencia_vontade: props.classe.resistencia_vontade ?? '',
    pontos_pericia: props.classe.pontos_pericia ?? null,
});

const submit = () => form.put(route('classes.update', props.classe.id));
</script>

<template>
    <Head title="Editar Classe" />

    <AppLayout>
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">Editar Classe</h1>
                <p class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ classe.nome }}</p>
            </div>

            <form @submit.prevent="submit" class="glass-parchment rounded-xl p-8 space-y-6 border border-parchment-400 shadow-xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Nome *</label>
                        <input v-model="form.nome" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                        <p v-if="form.errors.nome" class="text-blood-700 text-sm mt-1">{{ form.errors.nome }}</p>
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Versão</label>
                        <input v-model="form.versao" type="text" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                        <p v-if="form.errors.versao" class="text-blood-700 text-sm mt-1">{{ form.errors.versao }}</p>
                    </div>
                </div>

                <div>
                    <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Descrição</label>
                    <textarea v-model="form.descricao" rows="4" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700 resize-none"></textarea>
                    <p v-if="form.errors.descricao" class="text-blood-700 text-sm mt-1">{{ form.errors.descricao }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Dado de Vida</label>
                        <select v-model.number="form.dado_vida" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                            <option :value="null">— d? —</option>
                            <option :value="4">d4</option>
                            <option :value="6">d6</option>
                            <option :value="8">d8</option>
                            <option :value="10">d10</option>
                            <option :value="12">d12</option>
                        </select>
                        <p v-if="form.errors.dado_vida" class="text-blood-700 text-sm mt-1">{{ form.errors.dado_vida }}</p>
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">BBA</label>
                        <select v-model="form.bba_progressao" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                            <option value="">— Nenhum —</option>
                            <option value="boa">Boa</option>
                            <option value="media">Média</option>
                            <option value="ruim">Ruim</option>
                        </select>
                        <p v-if="form.errors.bba_progressao" class="text-blood-700 text-sm mt-1">{{ form.errors.bba_progressao }}</p>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Pontos de Perícia</label>
                        <input v-model.number="form.pontos_pericia" type="number" min="0" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                        <p v-if="form.errors.pontos_pericia" class="text-blood-700 text-sm mt-1">{{ form.errors.pontos_pericia }}</p>
                    </div>
                </div>

                <div class="pt-4 border-t border-parchment-400/30">
                    <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-4">Resistências</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Fortitude</label>
                            <select v-model="form.resistencia_fortitude" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                                <option value="">— Nenhuma —</option>
                                <option value="boa">Boa</option>
                                <option value="ruim">Ruim</option>
                            </select>
                            <p v-if="form.errors.resistencia_fortitude" class="text-blood-700 text-sm mt-1">{{ form.errors.resistencia_fortitude }}</p>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Reflexos</label>
                            <select v-model="form.resistencia_reflexos" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                                <option value="">— Nenhuma —</option>
                                <option value="boa">Boa</option>
                                <option value="ruim">Ruim</option>
                            </select>
                            <p v-if="form.errors.resistencia_reflexos" class="text-blood-700 text-sm mt-1">{{ form.errors.resistencia_reflexos }}</p>
                        </div>
                        <div>
                            <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Vontade</label>
                            <select v-model="form.resistencia_vontade" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                                <option value="">— Nenhuma —</option>
                                <option value="boa">Boa</option>
                                <option value="ruim">Ruim</option>
                            </select>
                            <p v-if="form.errors.resistencia_vontade" class="text-blood-700 text-sm mt-1">{{ form.errors.resistencia_vontade }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-parchment-400/30">
                    <Link :href="route('classes.index')" class="px-6 py-2 font-cinzel border border-parchment-400 rounded-lg hover:bg-parchment-300 transition">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-6 py-2 font-cinzel font-bold bg-blood-700 text-parchment-100 rounded-lg hover:bg-blood-800 transition disabled:opacity-50">Salvar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
