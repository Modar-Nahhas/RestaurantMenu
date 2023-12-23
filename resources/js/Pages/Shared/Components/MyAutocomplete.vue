<template>
    <v-autocomplete
        v-model="data"
        :label="label"
        :items="options"
        :item-title="itemText"
        :item-value="itemValue"
        :rules="rules"
        :error-messages="errorMessages"
        :placeholder="placeholder != undefined?placeholder:label"
        :type="type"
        :loading="loading"
        :no-data-text="noDataText"
        :multiple="multiple"
        :no-filter="noFilter"
        :search-input.sync="search"
        :chips="chips"
        :clearable="clearable"
        :deletable-chips="deletableChips"
        :return-object="returnObject"
        :disabled="disabled"
        outlined
        dense
    >
        <template v-slot:selection="data" v-if="customSelection">
            <slot name="selection" v-bind:data="data"></slot>
        </template>
        <template v-slot:item="data" v-if="customItem">
            <slot name="item" v-bind:data="data"></slot>
        </template>
    </v-autocomplete>
</template>

<script>
export default {
    name: "MyAutocomplete",
    props: {
        rules: Array,
        errorMessages: String,
        label: String,
        type: String,
        placeholder: String,
        items: Array,
        itemValue: String,
        itemText: String,
        loading: Boolean,
        multiple: Boolean,
        noDataText: String,
        customSelection: Boolean,
        customItem: Boolean,
        noFilter: Boolean,
        searchInput: String,
        chips: Boolean,
        clearable: Boolean,
        deletableChips:Boolean,
        returnObject:Boolean,
        disabled:Boolean,
        value: ''
    },
    data() {
        return {
            data: '',
            search: '',
            // options: [],
        }
    },
    computed: {
        options() {
            return this.items;
        }
    },
    watch: {
        data: {
            handler(newValue, oldValue) {
                if (newValue != oldValue) {
                    this.$emit('input', newValue);
                }
            },
            deep: true,
        },
        value: {
            handler(newValue) {
                if (newValue != this.data) {
                    this.data = newValue;
                }
            },
            deep: true
        },
        search: {
            handler(newValue) {
                this.$emit('update:searchInput', newValue)
            }
        },
    }
}
</script>

<style scoped>

</style>
