<script setup>

import {useLogoutApi} from "@/Pages/ApiHandlers/AuthApiHandler.js";
import {onMounted, ref} from "vue";
import store from "@/Plugins/Store.js";
import {setAxiosToken} from "@/Pages/ApiHandlers/Helpers/AxiosHandler.js";
import NavigationDrawer from "@/Pages/Shared/NavigationDrawer.vue";
import MyBtn from "@/Pages/Shared/Components/MyBtn.vue";
import MainLayout from "@/Pages/Shared/MainLayout.vue";

const appName = import.meta.env.VITE_APP_NAME;
let pageHeader = ref(localStorage.getItem('pageHeader') ?? 'Home');

const setPageHeader = (header) => {
    pageHeader.value = header;
    localStorage.setItem('pageHeader', header)
}

onMounted(() => {
    store.commit('resetUserInfoFromStorage');
    if (store.getters.isLoggedin) {
        setAxiosToken(store.getters.getUserToken);
    }
})
</script>

<template>
    <v-app class="rounded rounded-md">
        <Notifications group="public" position="center"/>
        <template v-if="store.getters.isLoggedin">
            <v-app-bar :title="appName">
                <div class="me-5">Welcome, {{ store.getters.getUser.name }}...</div>
                <my-btn @click="useLogoutApi" color="primary">Logout</my-btn>
            </v-app-bar>

            <navigation-drawer app @linkChanged="setPageHeader"></navigation-drawer>
        </template>
        <v-main app>
            <v-container class="d-flex flex-column">
                <div id="header-title" v-if="store.getters.isLoggedin">
                    <h2>{{ pageHeader }}</h2>
                </div>
                <div id="main-content">
                    <router-view></router-view>
                </div>
            </v-container>
        </v-main>
    </v-app>
</template>

<style scoped>

</style>
