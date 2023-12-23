import Index from "@/Pages/Menus/Index.vue";


const menusRoutes = [
    {
        path: '/menus',
        component: Index,
        name: 'menus_index',
        meta: {
            requireAuth: true
        }
    }
]

export default  menusRoutes;
