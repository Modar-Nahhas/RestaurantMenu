<template>
    <v-text-field
        v-model="data"
        :label="label"
        :rules="rules"
        :error-messages="errorMessages"
        :placeholder="placeholder"
        :type="type"
        :append-icon="appendIcon"
        :clearable="clearable"
        dense
    ></v-text-field>
</template>

<script>
export default {
    name: "text-input",
    props: {
        rules: Array,
        errorMessages: Array,
        label: String,
        type: String,
        placeholder: String,
        value: '',
        appendIcon: String,
        clearable: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            data: '',
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
        }
    }
}
</script>

<style scoped>

</style>
