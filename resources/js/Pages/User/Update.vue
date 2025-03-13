<script setup>
import { ref } from "vue";
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import api from "@/Plugins/axios";
import { useLoadingStore } from "@/Stores/loadingStore";
import Alert from "@/Components/Alert.vue";
import { useAlertStore } from "@/Stores/alertStore";
import DangerButton from "@/Components/DangerButton.vue";
import ModalConfirm from "@/Components/ModalConfirm.vue";  // Já está importado, mas preciso ajustar o evento

const props = defineProps({
    user: Object
});

const alert = useAlertStore();
const form = ref({
    name: props.user.data.name,
    email: props.user.data.email,
    password: "",
    password_confirmation: "",
    status: props.user.data.status,
});

const errors = ref({});
const showModal = ref(false);  // Controle de visibilidade do modal

// Abrir modal
const openModal = () => {

    showModal.value = true;
};

// Fechar modal
const closeModal = () => {
    showModal.value = false;
};

// Submissão do formulário
const submit = async () => {
    try {
        useLoadingStore().$state.message = "Processando...";
        useLoadingStore().startLoading();
        const url = route("users.update", { id: props.user.data.id });
        const response = await api.put(url, form.value);

        if (response.data && response.status === 200) {
            setTimeout(() => {
                alert.setShowAlert("Registro salvo com sucesso", "success");
            }, 2000);
        }
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        }
        if (error.response.data.message) {
            setTimeout(() => {
                alert.setShowAlert(error.response.data.message, "error");
            }, 2000);
        }
    } finally {
        useLoadingStore().stopLoading();
    }
};

// Função de exclusão do usuário
const deleteUser = async () => {
    try {
        useLoadingStore().$state.message = "Processando...";
        useLoadingStore().startLoading();
        const url = route("users.destroy", { id: props.user.data.id });
        const response = await api.delete(url);
        if (response.status === 200) {

            alert.setShowAlert(response.data.message, "success");
            setTimeout(() => {
                alert.setHideAlert();
                router.get(route("users.index"));

            }, 3000);

        }
    } catch (error) {
        alert.setShowAlert("Erro ao deletar usuário!", "error");
    } finally {
        useLoadingStore().stopLoading();

        closeModal();
    }
};
</script>

<template>
    <Head title="Atualizar de Usuário" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
                <i class="fas fa-users mr-3"></i> Atualizar de Usuário
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <Alert />
            </div>
            <!-- Modal de confirmação de exclusão -->
            <ModalConfirm v-if="showModal" @confirm="deleteUser" @cancel="closeModal" />

            <!-- Formulário -->
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-100 text-gray-800 overflow-hidden sm:rounded-lg shadow-md p-6">
                    <form @submit.prevent="submit">
                        <!-- Nome -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Nome</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="w-full p-2 border rounded"
                                :class="{'border-red-500': errors.name}"
                                autocomplete="off"
                            />
                            <p v-if="errors.name" class="error text-red-700">{{ errors.name[0] }}</p>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-gray-700">E-mail</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="w-full p-2 border rounded"
                                :class="{'border-red-500': errors.email}"
                                autocomplete="off"
                            />
                            <p v-if="errors.email" class="error text-red-700">{{ errors.email[0] }}</p>
                        </div>

                        <!-- Senha -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Senha</label>
                            <input
                                v-model="form.password"
                                type="password"
                                class="w-full p-2 border rounded"
                                :class="{'border-red-500': errors.password}"
                                autocomplete="off"
                            />
                            <p v-if="errors.password" class="error text-red-700">{{ errors.password[0] }}</p>
                        </div>

                        <!-- Confirmação de Senha -->
                        <div class="mb-4">
                            <label class="block text-gray-700">Confirme a Senha</label>
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                class="w-full p-2 border rounded"
                                autocomplete="off"
                            />
                            <p v-if="errors.password_confirmation" class="error text-red-700">{{ errors.password_confirmation[0] }}</p>
                        </div>

                        <!-- Status Toggle -->
                        <div class="mb-4 flex items-center">
                            <label class="block text-gray-700 mr-3">Status</label>
                            <input
                                type="checkbox"
                                v-model="form.status"
                                true-value="active"
                                false-value="inactive"
                                class="h-6 w-11 rounded-full border-2 border-gray-300 transition-colors cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="form.status === 'active' ? 'bg-blue-500' : 'bg-gray-100'"
                            />
                        </div>

                        <!-- Botões -->
                        <div class="mt-6">
                            <PrimaryButton type="submit" class="mr-2">
                                <i class="fas fa-save mr-3"></i> Salvar
                            </PrimaryButton>
                            <DangerButton type="button" @click="openModal">
                                <i class="fas fa-trash mr-3"></i> Deletar
                            </DangerButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
input {
    border: 1px solid #ccc;
}
</style>
