<script setup>
import {onMounted, ref} from "vue";
import {dateFormatter} from "../../ApiHandlers/Helpers/Helpers.js";
import MyBtn from "@/Pages/Shared/Components/MyBtn.vue";
import MyProgress from "@/Pages/Shared/Components/MyProgress.vue";
import {useRedirect} from "@/Pages/Composable/RoutingHelpers.js";

const props = defineProps({
    headers: Array,
    apiFunction: Function,
    apiParams: Object,
    showActions: {
        default: true,
        type: Boolean
    },
    showAdd: {
        default: true,
        type: Boolean
    },
    showEdit: {
        default: true,
        type: Boolean
    },
    addLinkName: String,
    editLinkName: String,
})

let itemsPerPageOptions = [1, 5, 10, 20, 100, -1];


let loadingData = ref(false)
let items = ref([])
let tableParameters = ref({
    page: 1,
    itemsPerPage: 5,
    total: 10,
});
let tableHeaders = ref([])

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
    tableHeaders.value = props.headers
    if (props.showActions) {
        tableHeaders.value.push({
            title: 'Action',
            align: 'center',
            sortable: false,
            key: 'actions'

        })
    }
    loadItems(tableParameters);
})
</script>

<template>
    <v-layout>
        <my-btn v-if="showAdd" @click="useRedirect({name:addLinkName})">Add</my-btn>
        <slot name="customIndexActions"></slot>
        <v-spacer></v-spacer>
        <div @click="loadItems(tableParameters)" style="cursor: pointer;">
            <v-icon color="primary">mdi-reload</v-icon>
        </div>
    </v-layout>
    <v-data-table-server
        v-model:items-per-page="tableParameters.itemsPerPage"
        :headers="tableHeaders"
        :page="tableParameters.page"
        :items-length="tableParameters.total"
        :items="items"
        :loading="loadingData"
        loading-text="Loading... Please wait"
        :items-per-page-options="itemsPerPageOptions"
        @update:options="loadItems"
    >
        <template
            v-for="(_, scopedSlotName) in $slots"
            v-slot:[scopedSlotName]="slotData"
        >
            <slot :name="scopedSlotName" v-bind="slotData" />
        </template>
        <template v-slot:item.created_at="{item}">
            {{ dateFormatter(item.created_at) }}
        </template>
        <template v-slot:item.actions="{item}">
            <my-btn v-if="showEdit" :size="'small'" color="warning"
                    @click="useRedirect({name:editLinkName,params:{id:item.id}})">Edit
            </my-btn>
        </template>
        <template v-slot:loader="{color,isActive}">
            <my-progress v-if="isActive" :spinner="false" text=""></my-progress>
        </template>
<!--        <slot name=""-->
    </v-data-table-server>
</template>

<style scoped>

</style>
