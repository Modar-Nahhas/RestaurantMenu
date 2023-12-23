import Index from "@/Pages/Categories/Index.vue";

const categoriesRoutes = [
    {
        path: '/categories',
        component: Index,
        name: 'categories_index',
        meta: {
            requireAuth: true
        }
    }
]

export default  categoriesRoutes;
