<script setup>

import MyDataTable from "@/Pages/Shared/Components/MyDataTable.vue";
import {useItemIndexApi} from "@/Pages/ApiHandlers/ItemsApiHandler.js";

const headers = [
    {
        title: 'Name',
        align: 'center',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Description',
        align: 'center',
        sortable: false,
        key: 'description',
    },
    {
        title: 'Price',
        align: 'center',
        sortable: false,
        key: 'price',
    },
    {
        title: 'Category',
        align: 'center',
        sortable: false,
        key: 'category.name',
    },
    {
        title: 'Discount',
        align: 'center',
        sortable: false,
        key: 'discount.amount',
    },
    {
        title: 'Creation date',
        align: 'center',
        sortable: false,
        key: 'created_at',
    },

]
</script>

<template>
    <v-container>
        <my-data-table
            :headers="headers"
            :api-function="useItemIndexApi"
            :api-params="{
                with_category:true
            }"
        ></my-data-table>
    </v-container>
</template>

<style scoped>

</style>
