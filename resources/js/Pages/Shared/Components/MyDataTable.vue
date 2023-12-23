<script setup>
import {onMounted, ref} from "vue";
import {dateFormatter} from "../../ApiHandlers/Helpers/Helpers.js";
import MyBtn from "@/Pages/Shared/Components/MyBtn.vue";

const props = defineProps({
    headers: Array,
    apiFunction: Function,
    apiParams:Object,
    showAdd:{
        default:true,
        type:Boolean
    }
})

let itemsPerPageOptions = [1, 5, 10, 20, 100,-1];


let loadingData = ref(false)
let items = ref([])
let tableParameters = ref({
    page: 1,
    itemsPerPage: 5,
    total: 10,
});

const loadItems = async (options) => {
    if (loadingData.value) return;
    loadingData.value = true;
    const {data, tableParams} = await props.apiFunction({
        page: options.page,
        number: options.itemsPerPage,
        ...props.apiParams
    });
    loadingData.value = false;
    items.value = data.value;
    tableParameters.value = tableParams.value
}

onMounted(() => {
    loadItems(tableParameters);
})
</script>

<template>
    <v-layout>
        <my-btn v-if="showAdd">Add</my-btn>
    </v-layout>
    <v-data-table-server
        v-model:items-per-page="tableParameters.itemsPerPage"
        :headers="headers"
        :page="tableParameters.page"
        :items-length="tableParameters.total"
        :items="items"
        :loading="loadingData"
        loading-text="Loading... Please wait"
        :items-per-page-options="itemsPerPageOptions"
        @update:options="loadItems"
    >
        <template v-slot:item.created_at="{item}" >
            {{dateFormatter(item.created_at)}}
        </template>
    </v-data-table-server>
</template>

<style scoped>

</style>
