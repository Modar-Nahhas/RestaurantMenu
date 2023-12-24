import Index from "@/Pages/Categories/Index.vue";
import Store from "@/Pages/Categories/Store.vue";
import SubcategoryStore from "@/Pages/Categories/SubcategoryStore.vue";
import Edit from "@/Pages/Categories/Edit.vue";

const categoriesRoutes = [
    {
        path: '/categories',
        component: Index,
        name: 'categories_index',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/categories/store',
        component: Store,
        name: 'categories_store',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/categories/edit/:id',
        component: Edit,
        name: 'categories_edit',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/sub-categories/store',
        component: SubcategoryStore,
        name: 'sub_category_store',
        meta: {
            requireAuth: true
        }
    },
]

export default categoriesRoutes;
