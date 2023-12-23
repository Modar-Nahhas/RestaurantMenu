import Index from "@/Pages/Items/Index.vue";

const itemsRoutes = [
    {
        path: '/items',
        component: Index,
        name: 'items_index',
        meta: {
            requireAuth: true
        }
    }
]

export default  itemsRoutes;
