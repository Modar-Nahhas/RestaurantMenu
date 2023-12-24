import Index from "@/Pages/Items/Index.vue";
import Store from "@/Pages/Items/Store.vue";
import Edit from "@/Pages/Items/Edit.vue";

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
        component: Edit,
        name: 'items_edit',
        meta: {
            requireAuth: true
        }
    },
]

export default  itemsRoutes;
