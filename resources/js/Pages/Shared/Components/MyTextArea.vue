<template>
    <v-textarea
        v-model="data"
        :label="label"
        :rules="rules"
        :error-messages="errorMessages"
        :placeholder="placeholder ?? ''"
        :rows="rows != undefined ? rows : '1'"
        outlined
        dense
    ></v-textarea>
</template>

<script>
export default {
    name: "MyTextArea",
    props: {
        rules: Array,
        errorMessages: String | Array,
        label: String,
        placeholder: String,
        value: '',
        appendIcon: String,
        rows: {
            type: [Number, String],
            default: 2
        }
    },
    data() {
        return {
            data: '',
        }
    },
    watch: {
        data: {
            handler(newValue) {
                if (newValue != this.value) {
                    this.$emit('input', newValue);
                }
            },
            deep: true,
        },
        value: {
            handler(newValue) {
                this.data = newValue;
            },
            deep: true
        }
    }
}
</script>

<style scoped>
/deep/ .v-input__control {

}
</style>
