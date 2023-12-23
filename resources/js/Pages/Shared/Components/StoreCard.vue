<script setup>
import {ref} from "vue";
import MyBtn from "@/Pages/Shared/Components/MyBtn.vue";
import {useCategoryStoreApi} from "@/Pages/ApiHandlers/CategoriesApiHandler.js";
import {useRedirect} from "@/Pages/Composable/RoutingHelpers.js";

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    indexLinkName: {
        type: String,
        required: true
    },
    submissionFunction: {
        type: Function,
        required: true
    },
    submissionData: {
        type: Object,
        required: true
    }
})

const emit = defineEmits({
    validationError: (errors) => {
        return errors != undefined;
    }
})


let loading = ref(false);
const submitForm = async () => {
    loading.value = true;
    const {res} = await props.submissionFunction(props.submissionData);
    loading.value = false;
    if (res.status && res.code == 200) {
        useRedirect({name: props.indexLinkName})
    } else if (res.code == 422) {
        emit('validationError', res.data)
    }

}
</script>

<template>
    <v-card class="w-100">
        <v-card-title>{{ title }}</v-card-title>
        <v-card-text>
            <slot></slot>
        </v-card-text>
        <v-card-actions>
            <my-btn
                @click="submitForm"
                :disabled="loading"
            >
                Submit
            </my-btn>


        </v-card-actions>
    </v-card>
</template>

<style scoped>

</style>
