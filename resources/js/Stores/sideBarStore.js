import { defineStore } from "pinia";
import { usePage } from "@inertiajs/vue3";

export const useSideBarStore = defineStore("sideBar", {
    state: () => ({
        visible:false ,

    }),
    actions: {
      setOpenDrawer() {
              this.visible = !this.visible;
      },

    },
});
