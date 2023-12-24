<script setup>

import {onMounted, ref} from "vue";
import StoreCard from "@/Pages/Shared/Components/StoreCard.vue";
import TextInput from "@/Pages/Shared/Components/TextInput.vue";
import store from "@/Plugins/Store.js";
import MyAutocomplete from "@/Pages/Shared/Components/MyAutocomplete.vue";
import {useDiscountIndexApi} from "@/Pages/ApiHandlers/DiscountApiHandler.js";
import {useMenuShowApi, useMenuUpdateApi} from "@/Pages/ApiHandlers/MenusApiHandler.js";
import {useItemIndexApi} from "@/Pages/ApiHandlers/ItemsApiHandler.js";
import {useRoute} from "vue-router";

const route = useRoute();
let menuId = route.params.id;

let menu = ref({
    name: null,
    discount_id: null,
    items: []
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
    discounts.value.unshift({
        id: null,
        name: 'None',
    })

    data = await useItemIndexApi({
        list: true
    })
    items.value = data.data.value;

    data = await useMenuShowApi(menuId, {});
    menu.value = {
        name: data.data.value.name,
        discount_id: data.data.value.discount_id,
        items: data.data.value.items.map((item)=>{
            return item.id
        }),
    }


})
</script>

<template>
    <store-card
        title="Edit Menu"
        :submission-data="menu"
        :submission-function="useMenuUpdateApi"
        index-link-name="menus_index"
        @validationError="setErrors"
        :is-edit="true"
        :item-id="menuId"
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
