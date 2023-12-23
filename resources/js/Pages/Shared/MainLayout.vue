<script setup>

</script>

<template>
    <v-app-bar :title="appName">
        <div class="me-5">Welcome, {{ store.getters.getUser.name }}...</div>
        <my-btn @click="useLogoutApi" color="primary">Logout</my-btn>
    </v-app-bar>

    <navigation-drawer app @linkChanged="setPageHeader"></navigation-drawer>

    <v-main app>
        <v-container class="d-flex flex-column">
            <div id="header-title">
                <h2>{{ pageHeader }}</h2>
            </div>
            <div id="main-content">
                <router-view></router-view>
            </div>
        </v-container>
    </v-main>
</template>

<style scoped>

</style>
