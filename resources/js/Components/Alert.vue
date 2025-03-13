<script setup>
import { defineProps } from 'vue';
import {useAlertStore} from "@/Stores/alertStore";

// Definindo as propriedades para o componente
const props = defineProps({
    message: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'success', // O tipo padrão é 'success'
        validator: value => ['success', 'error'].includes(value), // Garante que o tipo seja success ou error
    },
});
const alertStore = useAlertStore();
</script>

<template>
    <!-- Alerta com o tipo dinâmico -->
    <div v-if="alertStore.$state.show" :class="['alert', `alert-${alertStore.$state.type}`]" role="alert">
        {{ alertStore.$state.message }}
    </div>
</template>

<style scoped>
/* Estilos gerais do alerta */
.alert {
    padding: 1rem;
    margin: 1rem 0;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: bold;
}

.alert-success {
    background-color: #17b43f;
    color: #ffffff;
    border: 1px solid #17b43f;
}

.alert-error {
    background-color: rgba(200, 22, 39, 0.69);
    color: #FFFFFF;
    border: 1px solid rgba(200, 22, 39, 0.69);
}
</style>
