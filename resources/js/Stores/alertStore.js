import { defineStore } from "pinia";
import { usePage } from "@inertiajs/vue3";

export const useAlertStore = defineStore("alert", {
    state: () => ({
        show: false,
        message: '',
        type:''
    }),
    actions: {
      setShowAlert(message, type) {

              this.show = true;
              this.message = message;
              this.type = type;


      },
      setHideAlert() {

             this.show = false;
             this.message = '';
             this.type = '';

      },

    },
});
