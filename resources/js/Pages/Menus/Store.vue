<script setup>

import {onMounted, ref} from "vue";
import StoreCard from "@/Pages/Shared/Components/StoreCard.vue";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import store from "@/Plugins/Store.js";
import MyAutocomplete from "@/Pages/Shared/Components/MyAutocomplete.vue";
import {useDiscountIndexApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";
import {useMenuStoreApi} from "@/Pages/ApiHandlers/MenusApiHandler.js";
import {useItemIndexApi} from "@/Pages/ApiHandlers/ItemsApiHandler.js";


let menu = ref({
    name: null,
    discount_id: null
})
let errors = ref({})
let discounts = ref([]);
let items = ref([]);

const setErrors = (err) => {
    errors.value = err;
}

onMounted(async () => {
    let {data} = await useDiscountIndexApi({
        where_type: store.state.discountTypes.allMenu,
        list: true
    });
    discounts.value = data.value;

    let res = await useItemIndexApi({
        list: true
    })
    items.value = res.data.value;

})
</script>

<template>
    <store-card
        title="Add Menu"
        :submission-data="menu"
        :submission-function="useMenuStoreApi"
        index-link-name="menus_index"
        @validationError="setErrors"
    >
        <v-row>
            <v-col cols="12">
                <text-input
                    v-model="menu.name"
                    label="Name"
                    :error-messages="errors.name"
                ></text-input>
            </v-col>

            <v-col cols="12">
                <my-autocomplete
                    v-model="menu.items"
                    label="Items"
                    :items="items"
                    :item-value="'id'"
                    :item-text="'name'"
                    :error-messages="errors.items"
                    :multiple="true"
                    :chips="true"
                    :deletable-chips="true"
                ></my-autocomplete>
            </v-col>
            <v-col cols="12">
                <my-autocomplete
                    v-model="menu.discount_id"
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
