<template>
    <div class="my-progress d-flex flex-column justify-content-center w-100">
        <div class="d-flex justify-content-center align-items-center">
            <v-progress-circular v-if="spinner" :indeterminate="indeterminate" :color="color"></v-progress-circular>
            <v-progress-linear v-else :indeterminate="indeterminate" :color="color"></v-progress-linear>
        </div>
        <div class="d-flex justify-content-center">
            <p>{{ text }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyProgress",
    props: {
        indeterminate: {
            type: Boolean,
            default: true
        },
        spinner: {
            type: Boolean,
            default: true,
        },
        color: {
            type: String,
            default: 'primary'
        },
        text: {
            type: String,
            default: "Loading"
        }
    }
}
</script>

<style scoped>

</style>
