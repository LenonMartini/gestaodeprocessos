<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router} from '@inertiajs/vue3';
import { ref } from 'vue';
import { FilterMatchMode } from "primevue/api";
import TextInputSearch from "@/Components/TextInputSearch.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useLoadingStore} from "@/Stores/loadingStore";

const props = defineProps({
    users: Array,
});

const filters = ref();

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },

    };
};
initFilters();



const onRowUnselect = (event) => {
    console.log('Linha desmarcada:', event.data);
};
const onRowSelect = (event) => {
    console.log('Linha selecionada:', event.data);
    const routeName = 'users.edit'; // Nome da rota
    const routeParams = { id: event.data.id }; // Parâmetros da rota (no caso, o ID)
    navigateTo(routeName, routeParams); // Passa os parâmetros para a navegação
};


const navigateTo = async (routeName, routeParams = {}) => { // Default para um objeto vazio
    const loadingStore = useLoadingStore();

    try {
        // Inicia o loading
        loadingStore.$state.message = 'Redirecionando...';
        loadingStore.startLoading();

        // Simula um processo assíncrono (opcional)
        await new Promise((resolve) => setTimeout(resolve, 1000)); // 1 segundo de delay

        // Navega para a rota usando Ziggy
        if (Object.keys(routeParams).length > 0) {
            router.get(route(routeName, routeParams)); // Passa o parâmetro corretamente
        } else {
            router.get(route(routeName)); // Redireciona para a URL sem parâmetros
        }
    } catch (error) {
        console.error('Erro ao redirecionar:', error);
    } finally {
        // Para o loading
        loadingStore.stopLoading();
    }
};




</script>

<template>
    <Head title="Usuários" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
                <i class="fas fa-users mr-3"></i> Gerenciamento de Usuários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="text-gray-800 overflow-hidden sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-800">

                        <!-- Filtro global -->
                        <div class="flex justify-between mb-3">
                            <!-- Botão à esquerda -->

                            <PrimaryButton @click="navigateTo('users.create')">
                                <i class="fas fa-plus mr-3"></i> Novo
                            </PrimaryButton>



                            <!-- Campo de filtro à direita -->
                            <div class="w-80">
                                <TextInputSearch
                                    class="w-full"
                                    :placeholder="'Buscar em todos os campos'"
                                    v-model="filters['global'].value"
                                />
                            </div>
                        </div>

                        <!-- DataTable com filtro global -->
                        <DataTable
                            class="border-1 border-gray-300 dark:border-gray-200"
                            v-model:filters="filters"
                            :value="users"
                            paginator
                            showGridlines
                            :rows="10"
                            dataKey="id"
                            filterDisplay="menu"
                            selectionMode="single"
                            :responsive="true"
                            @row-select="onRowSelect"
                            @row-unselect="onRowUnselect"
                        >
                        <template #empty> Não há registros encontrados. </template>
                        <template #loading> Carregando dados dos usuários. Aguarde. </template>

                        <Column field="name" header="Nome" style="min-width: 12rem"></Column>
                        <Column field="email" header="Email" style="min-width: 12rem"></Column>
                        <Column field="status" header="Status" style="min-width: 3rem;">
                            <template #body="{ data }" class="text-center" style="text-align: center">
                                <i v-if="data.status === 'active'" class="fas fa-check text-green-500"></i>
                                <i v-else class="fas fa-times text-red-500"></i>
                            </template>
                        </Column>

                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Estilos personalizados, se necessário */
</style>
