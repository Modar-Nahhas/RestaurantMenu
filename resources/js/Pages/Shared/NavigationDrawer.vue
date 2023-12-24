<script setup>

const links = [
    {
        title: 'Home',
        linkName: 'main',
        icon: 'mdi-home',
    },
    {
        title: 'Categories',
        linkName: 'categories_index',
        icon: 'mdi-shape',
    },
    {
        title: 'Items',
        linkName: 'items_index',
        icon: 'mdi-format-list-bulleted'
    },
    {
        title: 'Menu',
        linkName: 'menus_index',
        icon: 'mdi-clipboard-list-outline'
    },
    {
        title: 'Discounts',
        linkName: 'discounts_index',
        icon: 'mdi-percent'
    },
]
</script>

<template>
    <v-navigation-drawer
        :expand-on-hover="true"
        :rail="true"
    >
        <v-list>
            <template v-for="link in links">
                <v-list-item link :title="link.title"
                             :to="{name:link.linkName}"
                             :prepend-icon="link.icon"
                             @click="$emit('linkChanged',link.title)"
                ></v-list-item>

            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<style scoped>

</style>
