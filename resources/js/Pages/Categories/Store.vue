<script setup>

import {onMounted, ref} from "vue";
import StoreCard from "@/Pages/Shared/Components/StoreCard.vue";
import {useCategoryStoreApi} from "@/Pages/ApiHandlers/CategoriesApiHandler.js";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import {useDiscountIndexApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";
import store from "@/Plugins/Store.js";
import MyAutocomplete from "@/Pages/Shared/Components/MyAutocomplete.vue";


let category = ref({
    name: null,
    discount_id: null
})
let errors = ref({})
let discounts = ref([]);

const setErrors = (err) =>{
    errors.value = err;
}

onMounted(async () => {
    let {data} = await useDiscountIndexApi({
        where_type: store.state.discountTypes.category,
        list: true
    });
    discounts.value = data.value;
})
</script>

<template>
    <store-card
        title="Add Category"
        :submission-data="category"
        :submission-function="useCategoryStoreApi"
        index-link-name="categories_index"
        @validationError="setErrors"
    >
        <v-row>
            <v-col cols="12">
                <text-input
                    v-model="category.name"
                    label="Name"
                    :error-messages="errors.name"
                ></text-input>
            </v-col>
            <v-col cols="12">

                <my-autocomplete
                    v-model="category.discount_id"
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
