<script setup>

import MyDataTable from "@/Pages/Shared/Components/MyDataTable.vue";
import {useMenuIndexApi} from "@/Pages/ApiHandlers/MenusApiHandler.js";

const headers = [
    {
        title: 'Name',
        align: 'center',
        sortable: false,
        key: 'name',
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
            :api-function="useMenuIndexApi"
            :api-params="{
                with_discount:true
            }"
            :show-actions="false"
            add-link-name="menus_store"
            edit-link-name="menus_edit"
        ></my-data-table>
    </v-container>
</template>

<style scoped>

</style>
