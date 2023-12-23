import Index from "@/Pages/Discounts/Index.vue";

const discountsRoutes = [
    {
        path: '/discounts',
        component: Index,
        name: 'discounts_index',
        meta: {
            requireAuth: true
        }
    }
]

export default  discountsRoutes;
