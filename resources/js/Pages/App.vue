<script setup>

import { useNotifyUser} from "@/Pages/Composable/Notification.js";

const appName = import.meta.env.VITE_APP_NAME;

</script>

<template>
    <v-layout class="rounded rounded-md">
        <Notifications group="public" position="center"/>
        <v-app-bar :title="appName"></v-app-bar>

        <v-navigation-drawer>
            <v-list>
                <v-list-item title="Navigation drawer"></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <router-view></router-view>
        </v-main>
    </v-layout>
</template>

<style scoped>

</style>
