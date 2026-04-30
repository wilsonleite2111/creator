import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import { aliases, fa } from 'vuetify/iconsets/fa';
import { ZiggyVue } from 'ziggy-js';

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'medievalTheme',
        themes: {
            medievalTheme: {
                dark: false,
                colors: {
                    background: '#fdf6e3',
                    surface: '#f4e8c1',
                    primary: '#5a4624',
                    secondary: '#d1b882',
                    error: '#b91c1c',
                },
            },
        },
    },
    icons: {
        defaultSet: 'fa',
        aliases,
        sets: { fa },
    },
});

// Captura manual dos dados da página para evitar o erro de "null" no componente
const el = document.getElementById('app');
let initialPage = null;
if (el && el.dataset.page) {
    try {
        initialPage = JSON.parse(el.dataset.page);
    } catch (e) {
        console.error('Erro ao processar dados da página:', e);
    }
}

createInertiaApp({
    page: initialPage,
    title: (title) => `${title} - Creator RPG`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#b91c1c',
    },
});
