import Index from "@/Pages/Items/Index.vue";
import Store from "@/Pages/Items/Store.vue";

const itemsRoutes = [
    {
        path: '/items',
        component: Index,
        name: 'items_index',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/items/store',
        component: Store,
        name: 'items_store',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/items/edit/:id',
        component: Store,
        name: 'items_edit',
        meta: {
            requireAuth: true
        }
    },
]

export default  itemsRoutes;
