<script setup>

import MyDataTable from "@/Pages/Shared/Components/MyDataTable.vue";
import {useDiscountIndexApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";

const headers = [
    {
        title: 'Name',
        align: 'center',
        sortable: false,
        key: 'name',
    },
    {
        title: 'Type',
        align: 'center',
        sortable: false,
        key: 'formatted_type',
    },
    {
        title: 'Amount',
        align: 'center',
        sortable: false,
        key: 'amount',
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
            :api-function="useDiscountIndexApi"
            add-link-name="discounts_store"
            edit-link-name="discounts_edit"
            :show-actions="false"
        ></my-data-table>
    </v-container>
</template>

<style scoped>

</style>
