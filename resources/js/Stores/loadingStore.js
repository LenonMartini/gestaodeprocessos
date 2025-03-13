import { defineStore } from "pinia";
import { usePage } from "@inertiajs/vue3";

export const useLoadingStore = defineStore("loading", {
    state: () => ({
        start: false,
        message: 'Carregando...',
    }),
    actions: {
        startLoading() {
                this.start = true;
        },
        stopLoading() {
            setTimeout(() => {
                this.start = false;
            }, 3000);
        },
    },
});
