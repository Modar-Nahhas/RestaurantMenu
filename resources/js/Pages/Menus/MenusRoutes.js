import Index from "@/Pages/Menus/Index.vue";
import Store from "@/Pages/Menus/Store.vue";
import Edit from "@/Pages/Menus/Edit.vue";


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
    {
        path: '/menus/edit/:id',
        component: Edit,
        name: 'menus_edit',
        meta: {
            requireAuth: true
        }
    },
]

export default  menusRoutes;
