<script setup>
import { useLoadingStore } from "@/Stores/loadingStore";

const loadingStore = useLoadingStore();
defineProps({
    size: {
        type: String,
        default: "100", // Tamanho do spinner
    }
});
</script>

<template>
    <div v-if="loadingStore.$state.start" class="fixed inset-0 bg-dark bg-opacity-50 flex flex-col justify-center items-center z-50">
        <!-- Spinner Customizado -->
        <div :style="`width: ${size}px; height: ${size}px;`" class="spinner"></div>
        <!-- Mensagem de carregamento -->
        <span class="text-white mt-4 text-lg">{{ loadingStore.$state.message }}</span>
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

/* Estilo do Spinner Customizado */
.spinner {
    border: 6px solid #f3f3f3; /* Cor do fundo do spinner */
    border-top: 6px solid #3498db; /* Cor da parte superior do spinner */
    border-radius: 50%;
    animation: spin 2s linear infinite;
}

/* Animação de rotação do spinner */
@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
