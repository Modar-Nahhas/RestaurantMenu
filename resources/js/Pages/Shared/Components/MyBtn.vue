<template>
    <v-btn
        class="my-btn"
        depressed
        variant="elevated"
        @click="submit"
        :disabled="disable"
        :color="color"
        :small="small"
        :x-small="xSmall"
        v-bind:attrs="$attrs"
    >
        <slot></slot>
    </v-btn>
</template>

<script>
export default {
    name: "MyBtn",
    props: {
        small: {
            default: false,
            type: Boolean
        },
        xSmall: {
            default: false,
            type: Boolean
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
        }
    }
}
</script>

<style scoped>

</style>
