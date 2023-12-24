<script setup>

import {onMounted, ref} from "vue";
import StoreCard from "@/Pages/Shared/Components/StoreCard.vue";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import {useDiscountIndexApi, useDiscountStoreApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";
import store from "@/Plugins/Store.js";
import MyAutocomplete from "@/Pages/Shared/Components/MyAutocomplete.vue";
import MySelect from "@/Pages/Shared/Components/MySelect.vue";


let discount = ref({
    name: null,
    type: null,
    amount: null
})
let errors = ref({})
let types = ref([]);

const setErrors = (err) => {
    errors.value = err;
}

onMounted(async () => {
    Object.values(store.state.discountTypes).forEach((value) => {
        types.value.push({
            id: value,
            name: value.replace('_',' ')
        });
    });
})
</script>

<template>
    <store-card
        title="Add Discount"
        :submission-data="discount"
        :submission-function="useDiscountStoreApi"
        index-link-name="discounts_index"
        @validationError="setErrors"
    >
        <v-row>
            <v-col cols="12">
                <text-input
                    v-model="discount.name"
                    label="Name"
                    :error-messages="errors.name"
                ></text-input>
            </v-col>
            <v-col cols="12">
                <my-select
                    v-model="discount.type"
                    label="Type"
                    :items="types"
                    :item-value="'id'"
                    :item-text="'name'"
                    :error-messages="errors.type"
                ></my-select>
            </v-col>
            <v-col cols="12">
                <text-input
                    v-model="discount.amount"
                    label="Amount"
                    :error-messages="errors.amount"
                    :min="1"
                    :max="100"
                    type="number"
                ></text-input>
            </v-col>
        </v-row>

    </store-card>
</template>

<style scoped>

</style>
