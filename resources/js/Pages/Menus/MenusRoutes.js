import Index from "@/Pages/Menus/Index.vue";
import Store from "@/Pages/Menus/Store.vue";


const menusRoutes = [
    {
        path: '/menus',
        component: Index,
        name: 'menus_index',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/menus/store',
        component: Store,
        name: 'menus_store',
        meta: {
            requireAuth: true
        }
    },
]

export default  menusRoutes;
