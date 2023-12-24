import Index from "@/Pages/Discounts/Index.vue";
import Store from "@/Pages/Discounts/Store.vue";

const discountsRoutes = [
    {
        path: '/discounts',
        component: Index,
        name: 'discounts_index',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/discounts/store',
        component: Store,
        name: 'discounts_store',
        meta: {
            requireAuth: true
        }
    },
]

export default  discountsRoutes;
