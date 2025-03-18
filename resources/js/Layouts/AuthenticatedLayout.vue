<script setup>
import { ref } from "vue";
import { useSideBarStore } from "@/Stores/sideBarStore";



const sideBarStore = useSideBarStore();

import NavBar from "@/Layouts/Components/NavBar.vue";
import Sidebar from "@/Layouts/Components/SideBar.vue";
import Loading from "@/Components/Loading.vue";
const items = ref([
    {
        label: 'Home',
        icon: 'pi pi-home'
    },
    {
        label: 'Projects',
        icon: 'pi pi-search',
        badge: 3,
        items: [
            {
                label: 'Core',
                icon: 'pi pi-bolt',
                shortcut: '⌘+S'
            },
            {
                label: 'Blocks',
                icon: 'pi pi-server',
                shortcut: '⌘+B'
            },
            {
                separator: true
            },
            {
                label: 'UI Kit',
                icon: 'pi pi-pencil',
                shortcut: '⌘+U'
            }
        ]
    },
    {
        label: 'Logout',
        icon: 'pi pi-power-off'
    },
]);


</script>



<template>
    <div class="layout-wrapper layout-static">
        <div class="Layout-topbar">
            <NavBar />
            <Sidebar />
            <div class="main-content" :class="{ 'drawer-open': sideBarStore.$state.visible }">
                <Loading  />
               <slot/>
            </div>
        </div>
    </div>

</template>

<style scoped>


</style>
