<script setup>
import { ref } from 'vue';

const emit = defineEmits(['confirm', 'cancel']);

// Controle de visibilidade do modal
const isModalVisible = ref(false);

const openModal = () => {
    isModalVisible.value = true;
};

const closeModal = () => {
    isModalVisible.value = false;
};

// Confirmar ação
const confirmAction = () => {
    emit('confirm');  // Emite o evento de confirmação
    closeModal();
};

// Cancelar ação
const cancelAction = () => {
    emit('cancel');  // Emite o evento de cancelamento
    closeModal();
};
</script>

<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-96">
            <h3 class="text-lg font-semibold text-center">Tem certeza?</h3>
            <p class="text-center text-sm my-4">Você está prestes a excluir este item. Essa ação não pode ser
                desfeita.</p>
            <div class="flex justify-around">
                <button @click="confirmAction" class="bg-red-600 text-white px-4 py-2 rounded-md">
                    Confirmar
                </button>
                <button @click="cancelAction" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</template>
