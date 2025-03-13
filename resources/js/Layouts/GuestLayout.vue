<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="text-center">
            <Link href="/" class="flex flex-col items-center">
                <!--<ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />-->
                <h1 class="text-4xl font-bold text-blue-900 dark:text-blue-900 mb-2">
                    Gestão de Operações
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">
                    Simplificando a gestão para melhorar a eficiência.
                </p>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
