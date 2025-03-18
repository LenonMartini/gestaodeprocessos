<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import api from '@/Plugins/axios';
import { useLoadingStore } from "@/Stores/loadingStore";

const isSidebarOpen = ref(true); // Estado do menu lateral
const isUsersSubMenuOpen = ref(false);
const isReportsSubMenuOpen = ref(false);
const loadingStore = useLoadingStore();

// Criando um ref para armazenar a largura da tela
const windowWidth = ref(window.innerWidth);

// Função para atualizar a largura da tela
const updateWindowWidth = () => {
    windowWidth.value = window.innerWidth;
};

// Criando um watch para reagir às mudanças na largura da tela
watch(windowWidth, (newWidth) => {
    console.log("Largura da tela:", newWidth);


    // Define a visibilidade do menu com base no tamanho da tela
    if (newWidth < 1023) {
        isSidebarOpen.value = false; // Fecha o menu em telas pequenas
        console.log(isSidebarOpen.value);
    } else {
        isSidebarOpen.value = true; // Mantém aberto em telas maiores
        console.log(isSidebarOpen.value);
    }
});

// Adicionando e removendo o event listener corretamente
onMounted(() => {
    window.addEventListener("resize", updateWindowWidth);
});

onUnmounted(() => {
    window.removeEventListener("resize", updateWindowWidth);
});

// Função de logout
const logout = async () => {
    try {
        loadingStore.$state.message = 'Aguarde encerrando a sessão...';
        loadingStore.startLoading(true);
        await api.post(route('logout'));
        setTimeout(() => {
            loadingStore.stopLoading(false);
            window.location.href = route('login');
        }, 3000);
    } catch (error) {
        console.log(error);
    }
};

// Alternar sidebar manualmente
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
    isUsersSubMenuOpen.value = false;
    isReportsSubMenuOpen.value = false;
};
</script>



<template>

        <div class="min-h-screen bg-gray-100 dark:bg-gray-300 ">
            <!-- Menu Lateral -->
            <aside
                class="fixed inset-y-0 left-0 bg-gray-800 dark:bg-gray-800 text-white shadow-lg transition-all duration-300"
                :class="{
                    'lg:w-64': isSidebarOpen,
                    'lg:w-16': !isSidebarOpen,
                   /*'md:w-16': isSidebarOpen,
                    'md:w-64': !isSidebarOpen*/


                }"
            >
                <div class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="flex items-center justify-center h-16 bg-gray-900 dark:bg-blue-950">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-white"
                                v-if="isSidebarOpen || !isSidebarOpen"
                            />
                            <ApplicationLogo
                                v-else
                                class="block h-5 w-36 fill-current text-white"

                            />
                            <!--<span v-else class="text-white text-xl font-bold">GO</span>-->
                        </Link>
                    </div>

                    <!-- Links do Menu Lateral -->
                    <nav class="flex-1 px-4 py-8">
                        <ul class="space-y-2">
                            <!-- Dashboard -->
                            <li>
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="menu-item">
                                    <i class="fas fa-tachometer-alt mr-3"></i>
                                    <span v-if="isSidebarOpen">Dashboard</span>
                                </NavLink>
                            </li>

                            <li>
                                <button
                                    class="w-full text-left menu-item"
                                    @click="isUsersSubMenuOpen = !isUsersSubMenuOpen"
                                >
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-list mr-3"></i>
                                            <span v-if="isSidebarOpen">Cadastros</span>
                                        </div>
                                        <!-- Ícone alinhado à direita -->
                                        <i
                                            v-if="isSidebarOpen"
                                            :class="isUsersSubMenuOpen ? 'fas fa-chevron-down' : 'fas fa-chevron-right'"
                                            class="icon-link"
                                        ></i>
                                    </div>
                                </button>
                                <ul v-if="isUsersSubMenuOpen" class="submenu pl-8 mt-2 space-y-2">
                                    <li>
                                        <NavLink :href="route('users.index')" :active="route().current('users.index')" class="submenu-item">
                                            <i class="fas fa-users mr-3"></i>
                                            <span v-if="isSidebarOpen">Usuários</span>
                                        </NavLink>
                                    </li>
                                    <li>
                                        <NavLink :href="route('dashboard')" :active="route().current('users.create')" class="submenu-item">
                                            <i class="fas fa-user-plus mr-3"></i>
                                            <span v-if="isSidebarOpen">Criar Usuário</span>
                                        </NavLink>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <button
                                    class="w-full text-left menu-item"
                                    @click="isReportsSubMenuOpen = !isReportsSubMenuOpen"
                                >
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-chart-bar mr-3"></i>
                                            <span v-if="isSidebarOpen">Relatórios</span>
                                        </div>
                                        <!-- Ícone alinhado à direita -->
                                        <i
                                            v-if="isSidebarOpen"
                                            :class="isReportsSubMenuOpen ? 'fas fa-chevron-down' : 'fas fa-chevron-right'"
                                            class="icon-link"
                                        ></i>
                                    </div>
                                </button>
                                <ul v-if="isReportsSubMenuOpen" class="submenu pl-8 mt-2 space-y-2">
                                    <li>
                                        <NavLink :href="route('dashboard')" :active="route().current('reports.monthly')" class="submenu-item">
                                            <i class="fas fa-calendar-day mr-3"></i>
                                            <span v-if="isSidebarOpen">Relatórios Mensais</span>
                                        </NavLink>
                                    </li>
                                    <li>
                                        <NavLink :href="route('dashboard')" :active="route().current('reports.yearly')" class="submenu-item">
                                            <i class="fas fa-calendar-year mr-3"></i>
                                            <span v-if="isSidebarOpen">Relatórios Anuais</span>
                                        </NavLink>
                                    </li>
                                </ul>
                            </li>

                            <!-- Configurações -->
                            <li>
                                <NavLink :href="route('dashboard')" :active="route().current('settings')" class="menu-item">
                                    <i class="fas fa-cogs mr-3"></i>
                                    <span v-if="isSidebarOpen">Configurações</span>
                                </NavLink>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Menu Inferior (Mobile) -->
            <div class="fixed bottom-0 left-0 right-0 bg-gray-800 text-white shadow-lg md:hidden sm:block">
                <nav class="flex justify-around py-3">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-white"><i class="fas fa-tachometer-alt"></i></NavLink>
                    <NavLink :href="route('dashboard')" :active="route().current('users.index')" class="text-white"><i class="fas fa-users"></i></NavLink>
                    <NavLink :href="route('dashboard')" :active="route().current('settings')" class="text-white"><i class="fas fa-cogs"></i></NavLink>
                    <NavLink :href="route('dashboard')" :active="route().current('reports')" class="text-white"><i class="fas fa-chart-bar"></i></NavLink>
                </nav>
            </div>

            <!-- Conteúdo Principal -->
            <div
                class="transition-all duration-300 lg:ml-45 md:ml-17"
                :class="{
                    'lg:ml-64': isSidebarOpen,
                    'lg:ml-16': !isSidebarOpen,
                    'md:ml-64': !isSidebarOpen,
                    'md:ml-16': isSidebarOpen
                }"
            >
                <nav class="navbar bg-white dark:bg-blue-950 border-b border-gray-100 dark:border-gray-700 duration-300"
                     :class="{'w-full': isSidebarOpen }"
                >
                    <div class="max-w-8xl px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16 items-center">
                            <div class="flex justify-start items-center">
                                <button
                                    @click="toggleSidebar()"
                                    class="toogle p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none hidden sm:block duration-300"
                                    :class="{ 'ml-2': !isSidebarOpen }"
                                >
                                    <svg
                                        class="h-6 w-6"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                    </svg>
                                </button>

                                <h1 class="text-lg font-semibold text-gray-900 dark:text-white ml-2">
                                    {{ $page.props.title }}
                                </h1>
                            </div>

                            <!-- Botão de Logout -->
                            <div class="">
                                <button
                                    @click="logout"
                                    class="py-2 text-white transition"
                                >
                                    <i class="fas fa-power-off"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>


                <header class="bg-gray-100 dark:bg-gray-300  shadow" v-if="$slots.header">
                    <div class="max-w-8xl mx-auto py-4 px-6 sm:px-8 lg:px-10">
                        <slot name="header" />
                    </div>
                </header>



                <main
                    class="p-6"
                    :class="{
                        'lg:ml-auto': isSidebarOpen,
                        'lg:ml-auto': !isSidebarOpen,
                        'md:ml-auto': isSidebarOpen,
                        'md:ml-auto': !isSidebarOpen,

                    }"
                >
                    <Loading  />
                    <slot />
                </main>
            </div>
        </div>

</template>

<style scoped>
/* Estilo do Menu Lateral */
aside {
    z-index: 50;
    transition: width 0.3s ease-in-out;
}

.menu-item {
    padding: 12px 16px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
    color: white;
}

.menu-item:hover {
    background-color: #4A90E2; /* Cor de hover */
    color: white;
    transform: translateX(8px); /* Efeito de deslizar */
}

.menu-item.active {
    background-color: #4A90E2;
    color: white;
    font-weight: bold;
}

/* Estilo do Submenu */
.submenu {
    padding-left: 20px;
    list-style-type: none;
    margin-top: 8px;
}

.submenu-item {
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
    color: white;
}

.submenu-item:hover {
    background-color: #4A90E2; /* Cor de hover */
    color: white;
    transform: translateX(8px); /* Efeito de deslizar */
}

/* Estilo do Menu Inferior */
.fixed-bottom-nav {
    display: flex;
    justify-content: space-around;
    padding: 12px 0;
    background-color: #333;
    box-shadow: 0px -2px 6px rgba(0, 0, 0, 0.1);
}

.fixed-bottom-nav a {
    color: white;
    font-size: 20px;
}
.icon-link{
    position: absolute;
    margin-left: 180px !important;
}
/*@media (max-width: 1024px) {
    .icon-link{
        margin-left: 170px !important;
    }
}*/
/*@media (max-width: 1023px) {
    .navbar{
        margin-left: 94px !important;
        max-width: 100% !important;
    }
    aside{



        nav ul li a span{
            display: none;
        }
        nav button span{
            display: none;
        }
        nav button .icon-link{
            display: none;
        }
    }
    header{
        margin-left: 94px !important;
    }
    main{
        margin-left: 100px !important;
    }

    .icon-link{
        margin-left: 100px !important;
    }
}
@media (max-width: 768px) {
    .navbar{
        margin-left: 0px !important;
        max-width: 100% !important;
    }
    aside{
       display: none;
    }
    header{
        margin-left: 0px !important;
    }
    main{
        margin-left: 0px !important;
    }

    .icon-link{
        margin-left: 100px !important;
    }
}*/
</style>
