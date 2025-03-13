<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="dark:bg-gray-200 text-gray-800 overflow-hidden  sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-800">
                        <span class="text-blue-900 dark:text-blue-900 font-bold">Seja bem-vindo,</span> {{ $page.props.auth.user.name }}!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
