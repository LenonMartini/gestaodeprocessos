import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@fortawesome/fontawesome-free/css/all.min.css';

// Importe o PrimeVue e os estilos
import PrimeVue from 'primevue/config';

import 'primeicons/primeicons.css'; // Ícones do PrimeVue
import 'primeflex/primeflex.css'; // Flexbox utilities do PrimeVue

import Aura from '@primeuix/themes/aura';
// Componentes do PrimeVue
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Menubar from 'primevue/menubar';
import Button from 'primevue/button';
import Drawer from 'primevue/drawer';


// Diretivas do PrimeVue
import StyleClass from 'primevue/styleclass';
import Ripple from 'primevue/ripple';

const pinia = createPinia();

const appName = import.meta.env.VITE_APP_NAME || 'Gestor de Operação';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        darkModeSelector: false || 'none',
                    }

                }
            }) // Registra o PrimeVue
            .component('DataTable', DataTable) // Registra o componente DataTable
            .component('Column', Column) // Registra o componente Column
            .component('Menubar', Menubar) // Registra o componente Menubar
            .component('Button', Button) // Registra o componente Button
            .component('Drawer', Drawer) // Registra o componente Drawer
            .directive('styleclass', StyleClass) // Registra a diretiva StyleClass
            .directive('ripple', Ripple) // Registra a diretiva Ripple
            .use(ZiggyVue) // Registra o Ziggy para rotas
            .mount(el); // Monta o aplicativo no elemento

        return app;
    },
    progress: {
        color: '#4B5563',
    },
});
