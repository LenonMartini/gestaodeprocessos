<script setup>
import { onMounted, ref } from 'vue';

// Define o modelo (v-model)
const model = defineModel({
    type: String,
    required: true,
});

// Define as props
const props = defineProps({
    placeholder: {
        type: String,
        default: '',
    },
});

// Referência para o elemento input
const input = ref(null);

// Lógica para autofocus
onMounted(() => {
    if (input.value && input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

// Expõe a função focus para uso externo
defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <div class="p-inputgroup">
        <!-- Ícone de busca -->
        <span class="p-inputgroup-addon">
            <i class="fas fa-search"></i>
        </span>

        <!-- Campo de entrada -->
        <input
            class="w-full border-gray-300 dark:border-gray-200 dark:bg-gray-100 dark:text-gray-900 focus:outline-none focus:border-0 focus:shadow-none rounded-0 shadow-sm"
            v-model="model"
            :placeholder="placeholder"
            ref="input"
        />
    </div>
</template>

<style scoped>
input:focus {
    outline: none !important;
    border: none !important;
    box-shadow: none !important;

}
</style>
