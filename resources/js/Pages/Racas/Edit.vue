<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ raca: Object });

const form = useForm({
    nome: props.raca.nome,
    versao: props.raca.versao ?? '3.5',
    descricao: props.raca.descricao ?? '',
    mod_forca: props.raca.mod_forca ?? 0,
    mod_destreza: props.raca.mod_destreza ?? 0,
    mod_constituicao: props.raca.mod_constituicao ?? 0,
    mod_inteligencia: props.raca.mod_inteligencia ?? 0,
    mod_sabedoria: props.raca.mod_sabedoria ?? 0,
    mod_carisma: props.raca.mod_carisma ?? 0,
    tamanho: props.raca.tamanho ?? '',
    deslocamento: props.raca.deslocamento ?? null,
});

const atributos = [
    { key: 'mod_forca', label: 'Força' },
    { key: 'mod_destreza', label: 'Destreza' },
    { key: 'mod_constituicao', label: 'Constituição' },
    { key: 'mod_inteligencia', label: 'Inteligência' },
    { key: 'mod_sabedoria', label: 'Sabedoria' },
    { key: 'mod_carisma', label: 'Carisma' },
];

const submit = () => form.put(route('racas.update', props.raca.id));
</script>

<template>
    <Head title="Editar Raça" />

    <AppLayout>
        <div class="max-w-3xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-cinzel font-bold text-parchment-900 uppercase tracking-widest">Editar Raça</h1>
                <p class="font-lora italic text-parchment-800 opacity-75 mt-1">{{ raca.nome }}</p>
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

                <div class="pt-4 border-t border-parchment-400/30">
                    <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-widest text-sm mb-4">Modificadores de Atributo</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div v-for="attr in atributos" :key="attr.key">
                            <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">{{ attr.label }}</label>
                            <input v-model.number="form[attr.key]" type="number" step="1" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora text-center focus:outline-none focus:border-blood-700" />
                            <p v-if="form.errors[attr.key]" class="text-blood-700 text-sm mt-1">{{ form.errors[attr.key] }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-parchment-400/30">
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Tamanho</label>
                        <select v-model="form.tamanho" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700">
                            <option value="">— Nenhum —</option>
                            <option value="Minúsculo">Minúsculo</option>
                            <option value="Diminuto">Diminuto</option>
                            <option value="Miúdo">Miúdo</option>
                            <option value="Pequeno">Pequeno</option>
                            <option value="Médio">Médio</option>
                            <option value="Grande">Grande</option>
                            <option value="Enorme">Enorme</option>
                            <option value="Imenso">Imenso</option>
                            <option value="Colossal">Colossal</option>
                        </select>
                        <p v-if="form.errors.tamanho" class="text-blood-700 text-sm mt-1">{{ form.errors.tamanho }}</p>
                    </div>
                    <div>
                        <label class="block font-cinzel font-bold text-parchment-900 text-sm uppercase tracking-wide mb-2">Deslocamento (m)</label>
                        <input v-model.number="form.deslocamento" type="number" min="0" step="1" class="w-full bg-parchment-100 border border-parchment-400 rounded-lg px-4 py-2 font-lora focus:outline-none focus:border-blood-700" />
                        <p v-if="form.errors.deslocamento" class="text-blood-700 text-sm mt-1">{{ form.errors.deslocamento }}</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-parchment-400/30">
                    <Link :href="route('racas.index')" class="px-6 py-2 font-cinzel border border-parchment-400 rounded-lg hover:bg-parchment-300 transition">Cancelar</Link>
                    <button type="submit" :disabled="form.processing" class="px-6 py-2 font-cinzel font-bold bg-blood-700 text-parchment-100 rounded-lg hover:bg-blood-800 transition disabled:opacity-50">Salvar</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
