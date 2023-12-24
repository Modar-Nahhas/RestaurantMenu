<template>
    <v-btn
        class="my-btn"
        depressed
        variant="elevated"
        @click="submit"
        :disabled="disable"
        :color="color"
        :size="size"
        v-bind:attrs="$attrs"
    >
        <slot></slot>
        <my-progress v-if="disable"
                     style="width: 13% !important;height: 13%;"
                     class="" text=""
        ></my-progress>
    </v-btn>
</template>

<script>
import MyProgress from "@/Pages/Shared/Components/MyProgress.vue";

export default {
    name: "MyBtn",
    components: {MyProgress},
    props: {
        size: {
            default: undefined,
            type: String
        },
        color: {
            default: 'primary',
            type: String
        },
        disabled: {
            default: false,
            type: Boolean
        },
        disableOnClick: {
            default: false,
            type: Boolean
        }
    },
    data() {
        return {
            disable: false
        }
    },
    watch: {
        disabled: {
            handler(newValue) {
                this.disable = newValue;
            }
        },
    },
    methods: {
        submit() {
            if (this.disableOnClick)
                this.disable = true;
            // this.$emit()
        }
    }
}
</script>

<style scoped>

</style>
