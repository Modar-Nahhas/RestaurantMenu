<template>
    <v-select
        v-model="selected"
        :items="items"
        :item-title="itemText"
        :item-value="itemValue"
        :label="label"
        :multiple="multiple"
        :error-messages="errorMessages"
        outlined
        dense
    >

    </v-select>
</template>

<script>
export default {
    name: "MySelect",
    props: {
        value: '',
        items: Array,
        itemText: {
            type: String,
            default: ''
        },
        itemValue: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        },
        errorMessages:Array
    },
    data() {
        return {
            selected: this.multiple ? [] : '',
        }
    },
    watch: {
        value: {
            handler(newValue) {
                this.selected = newValue;
            },
            deep: true
        },
        selected: {
            handler(newValue) {
                if (this.value != newValue)
                    this.$emit('input', newValue);
            }
        }
    }
}
</script>

<style scoped>

</style>
