<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Card from 'primevue/card';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Home"/>

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Button
                v-if="$page.props.auth.user"
                :label="'Dashboard'"
                :icon="'pi pi-cog'"
                class="p-button-text text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                :to="route('dashboard')"
            />
            <template v-else>
                <Link
                    :href="route('login')"
                    class="p-button-text text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >
                    <Button
                        :label="'Acessar'"
                        :icon="'pi pi-sign-in'"
                        class="p-button-text text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-white "
                        :to="route('login')"
                    />
                </Link>

            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8 flex flex-col justify-between flex-1">
            <!-- Título de boas-vindas -->
            <div class="text-center">
                <h1 class="text-6xl font-bold text-gray-900 dark:text-white mb-4">
                    Bem-vindo à <span class="text-blue-800">Gestão de Operações</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Gerencie suas operações de forma eficiente e simplificada.
                </p>
            </div>

            <!-- Cards de funcionalidades -->
            <div class="mt-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 justify-center ">
                    <Card
                        class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none"
                    >
                        <template #header>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white text-center">Avalie nosso Atendimento</h2>
                        </template>
                        <template #content>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                Clique em acessar e avalie nosso atendimento.
                            </p>
                            <Button
                                label="Acessar"
                                class="p-button-text text-blue-600 hover:text-blue-900 mt-4"
                                icon="pi pi-arrow-right"
                                :href="'https://laravel.com/docs'"
                            />
                        </template>
                    </Card>


                </div>
            </div>

            <!-- Rodapé -->
            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between ">
                <div class="text-center text-sm sm:text-start">&nbsp;</div>

                <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0">
                    Versão do Sistema: Beta
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
