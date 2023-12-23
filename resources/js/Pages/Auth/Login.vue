<script setup>
import {useLoginApi} from "@/Pages/ApiHandlers/AuthApiHandler.js";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import MyBtn from "@/Pages/Shared/Components/MyBtn.vue";
import {ref} from "vue";

let credentials = ref({
    email: null,
    password: null
});

let loading = ref(false)
let validationErrors = ref([])
const login = async () => {
    loading.value = true;
    const res = await useLoginApi(credentials.value);
    if (!res.status) {
        loading.value = false;
        if (res.code == 422) {
            validationErrors.value = res.data;
        }
    }
}

</script>

<template>
    <v-layout class="d-flex flex-column align-center justify-center  pt-10">

        <v-card class="w-75 d-flex align-center justify-center flex-column">
            <v-card-title>Please login...</v-card-title>
            <v-card-text class="w-50 px-5">
                <v-row no-gutters>
                    <v-col cols="12">
                        <text-input
                            v-model="credentials.email"
                            label="Email"
                            :error-messages="validationErrors.email"
                        ></text-input>
                    </v-col>
                    <v-col cols="12">
                        <text-input
                            v-model="credentials.password"
                            label="Password"
                            type="password"
                            :error-messages="validationErrors.password"
                        ></text-input>
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <my-btn @click="login"
                        :disabled="loading"
                >Login
                </my-btn>
            </v-card-actions>
        </v-card>


    </v-layout>
</template>

<style scoped>

</style>
