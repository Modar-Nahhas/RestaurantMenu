<script setup>

import MyDataTable from "@/Pages/Shared/Components/MyDataTable.vue";
import {useCategoryIndexApi} from "@/Pages/ApiHandlers/CategoriesApiHandler.js";

const headers = [
    {
        title: 'Name',
        align: 'center',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Level',
        align: 'center',
        sortable: false,
        key: 'level',
    },
    {
        title: 'Parent',
        align: 'center',
        sortable: false,
        key: 'parent.name',
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
            :api-function="useCategoryIndexApi"
            :api-params="{
                with_parent:true,
                with_discount:true,
            }"
            add-link-name="categories_store"
        ></my-data-table>
    </v-container>
</template>

<style scoped>

</style>
