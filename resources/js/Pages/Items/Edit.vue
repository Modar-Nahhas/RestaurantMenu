<script setup>

import {onMounted, ref} from "vue";
import StoreCard from "@/Pages/Shared/Components/StoreCard.vue";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import {useDiscountIndexApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";
import store from "@/Plugins/Store.js";
import MyAutocomplete from "@/Pages/Shared/Components/MyAutocomplete.vue";
import {useGetValidCategoryItemsApi} from "@/Pages/ApiHandlers/CategoriesApiHandler.js";
import {useItemStoreApi} from "@/Pages/ApiHandlers/ItemsApiHandler.js";
import MyTextArea from "@/Pages/Shared/Components/MyTextArea.vue";


let item = ref({
    name: null,
    description: null,
    price: null,
    category_id: null,
    discount_id: null
})
let errors = ref({})
let discounts = ref([]);
let categories = ref([]);

const setErrors = (err) => {
    errors.value = err;
}

onMounted(async () => {
    let {data} = await useDiscountIndexApi({
        where_type: store.state.discountTypes.category,
        list: true
    });
    discounts.value = data.value;

    data = await useGetValidCategoryItemsApi();
    categories.value = data;
})
</script>

<template>
    <store-card
        title="Edit Item"
        :submission-data="item"
        :submission-function="useItemStoreApi"
        index-link-name="items_index"
        @validationError="setErrors"
    >
        <v-row>
            <v-col cols="12">
                <text-input
                    v-model="item.name"
                    label="Name"
                    :error-messages="errors.name"
                ></text-input>
            </v-col>
            <v-col>
                <my-text-area
                    v-model="item.description"
                    label="Description"
                    :error-messages="errors.description"
                ></my-text-area>
            </v-col>
            <v-col cols="12">
                <text-input
                    v-model="item.price"
                    label="Price"
                    :error-messages="errors.price"
                    type="number"
                    min="0"
                ></text-input>
            </v-col>

            <v-col cols="12">
                <my-autocomplete
                    v-model="item.category_id"
                    label="Category"
                    :items="categories"
                    :item-value="'id'"
                    :item-text="'name'"
                    :error-messages="errors.category_id"
                ></my-autocomplete>
            </v-col>
            <v-col cols="12">
                <my-autocomplete
                    v-model="item.discount_id"
                    label="Discount"
                    :items="discounts"
                    :item-value="'id'"
                    :item-text="'name'"
                    :error-messages="errors.discount_id"
                ></my-autocomplete>
            </v-col>
        </v-row>

    </store-card>
</template>

<style scoped>

</style>
