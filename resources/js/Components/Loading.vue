<script setup>
import {useLoadingStore} from "@/Stores/loadingStore";
const loadingStore = useLoadingStore();
defineProps({
    size: {
        type: String,
        default: "20", // Tamanho do spinner
    }
});
</script>

<template>
    <div v-if="loadingStore.$state.start" class="fixed inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center transition-opacity opacity-0 animate-fade-in z-50">
        <div class="animate-spin rounded-full border-8 border-t-transparent border-blue-900" :class="`w-${size} h-${size}`"></div>
        <span class="text-white mt-4 text-lg">{{loadingStore.$state.message}}</span>
    </div>
</template>

<style scoped>
/* Animação de fade-in */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out forwards;
}
</style>
