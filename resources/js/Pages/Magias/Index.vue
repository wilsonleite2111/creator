<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    classes: Array,
    versao: String,
});

const classeAtiva = ref(props.classes[0]?.id ?? null);

const classeAtual = computed(() =>
    props.classes.find(c => c.id === classeAtiva.value)
);

const magiasPorCirculo = computed(() => {
    if (!classeAtual.value) return {};
    const grupos = {};
    for (const magia of classeAtual.value.magias) {
        const nivel = magia.pivot.nivel;
        if (!grupos[nivel]) grupos[nivel] = [];
        grupos[nivel].push(magia);
    }
    return grupos;
});

const circulos = computed(() =>
    Object.keys(magiasPorCirculo.value).map(Number).sort((a, b) => a - b)
);

const nomeCirculo = (n) => n === 0 ? 'Truques / Orações' : `${n}º Círculo`;

const deleteMagia = (id) => {
    if (confirm('Deseja dissipar esta magia para sempre?')) {
        router.delete(route('magias.destroy', id));
    }
};
</script>

<template>
    <AppLayout>
        <Head title="Grimório" />

        <!-- Cabeçalho -->
        <div class="mb-8 border-b-2 border-parchment-800 pb-4 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-cinzel font-bold text-parchment-900 drop-shadow-sm">
                    <i class="fa-solid fa-wand-sparkles text-magic-600 mr-3"></i>Grimório de Magias
                </h1>
                <p class="text-parchment-800 mt-2 italic font-lora">"O conhecimento arcano e divino registrado para a eternidade."</p>
            </div>
            <Link :href="route('magias.create')"
                class="bg-magic-600 text-white px-6 py-3 rounded-lg font-cinzel font-bold shadow-lg flex items-center hover:bg-magic-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Nova Magia
            </Link>
        </div>

        <div v-if="classes.length === 0" class="text-center py-24 italic text-parchment-600 font-lora text-lg">
            Nenhuma magia registrada neste grimório.
        </div>

        <div v-else class="flex gap-6">
            <!-- Abas de classe (coluna esquerda) -->
            <div class="flex-shrink-0 w-44">
                <p class="font-cinzel text-xs font-bold uppercase tracking-widest text-parchment-700 mb-3 px-1">Classes</p>
                <div class="flex flex-col gap-1">
                    <button
                        v-for="classe in classes"
                        :key="classe.id"
                        @click="classeAtiva = classe.id"
                        :class="[
                            'text-left px-4 py-2.5 rounded-lg font-cinzel text-sm font-bold transition-all duration-200 border',
                            classeAtiva === classe.id
                                ? 'bg-magic-600 text-white border-magic-700 shadow-md'
                                : 'bg-parchment-200/60 text-parchment-800 border-parchment-300 hover:bg-parchment-300 hover:border-parchment-400'
                        ]">
                        {{ classe.nome }}
                        <span :class="[
                            'ml-1 text-[10px] font-normal',
                            classeAtiva === classe.id ? 'text-magic-100' : 'text-parchment-600'
                        ]">({{ classe.magias.length }})</span>
                    </button>
                </div>
            </div>

            <!-- Conteúdo das magias -->
            <div class="flex-1 min-w-0">
                <div v-if="classeAtual" class="space-y-8">
                    <div v-for="nivel in circulos" :key="nivel">
                        <!-- Cabeçalho do círculo -->
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-full bg-magic-600 flex items-center justify-center flex-shrink-0 shadow">
                                <span class="text-white font-cinzel font-bold text-xs">{{ nivel }}</span>
                            </div>
                            <h2 class="font-cinzel font-bold text-parchment-900 uppercase tracking-wide text-sm">
                                {{ nomeCirculo(nivel) }}
                            </h2>
                            <div class="flex-1 h-px bg-parchment-400/50"></div>
                            <span class="text-xs font-cinzel text-parchment-600">
                                {{ magiasPorCirculo[nivel].length }} magia{{ magiasPorCirculo[nivel].length !== 1 ? 's' : '' }}
                            </span>
                        </div>

                        <!-- Tabela de magias do círculo -->
                        <v-card class="glass-parchment border border-parchment-400" elevation="2">
                            <v-table class="bg-transparent" density="compact">
                                <thead class="bg-parchment-300/80 font-cinzel">
                                    <tr>
                                        <th class="text-left text-xs">Nome</th>
                                        <th class="text-left text-xs">Escola</th>
                                        <th class="text-left text-xs">Tempo</th>
                                        <th class="text-left text-xs">Alcance</th>
                                        <th class="text-left text-xs">Duração</th>
                                        <th class="text-left text-xs">TR</th>
                                        <th class="text-center text-xs">RM</th>
                                        <th class="text-center text-xs">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="font-lora">
                                    <tr v-for="magia in magiasPorCirculo[nivel]" :key="magia.id"
                                        class="hover:bg-parchment-200/60 transition-colors">
                                        <td class="font-bold font-cinzel text-sm">{{ magia.nome }}</td>
                                        <td class="text-xs italic text-parchment-700">{{ magia.escola }}</td>
                                        <td class="text-xs">{{ magia.tempo_execucao ?? '—' }}</td>
                                        <td class="text-xs">{{ magia.alcance ?? '—' }}</td>
                                        <td class="text-xs">{{ magia.duracao ?? '—' }}</td>
                                        <td class="text-xs">{{ magia.teste_resistencia ?? '—' }}</td>
                                        <td class="text-center text-xs">
                                            <span :class="magia.resistencia_magia === 'Sim' ? 'text-magic-700 font-bold' : 'text-parchment-500'">
                                                {{ magia.resistencia_magia === 'Sim' ? 'Sim' : 'Não' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="flex justify-center space-x-3">
                                                <Link :href="route('magias.show', magia.id)" class="text-magic-600 hover:text-magic-800 transition">
                                                    <i class="fa-solid fa-scroll text-xs"></i>
                                                </Link>
                                                <Link :href="route('magias.edit', magia.id)" class="text-blue-600 hover:text-blue-800 transition">
                                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                </Link>
                                                <button @click="deleteMagia(magia.id)" class="text-blood-700 hover:text-blood-900 transition">
                                                    <i class="fa-solid fa-fire-burner text-xs"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </v-table>
                        </v-card>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
