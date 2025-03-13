import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createPinia } from "pinia";
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@fortawesome/fontawesome-free/css/all.min.css';

// Importe o PrimeVue e os estilos
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/saga-blue/theme.css'; // Tema do PrimeVue
import 'primevue/resources/primevue.min.css'; // Estilos do PrimeVue

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';




const pinia = createPinia();

const appName = import.meta.env.VITE_APP_NAME || 'Gestor de Operação';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(PrimeVue)
            .component('DataTable', DataTable)
            .component('Column', Column)



            .use(ZiggyVue)


            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
