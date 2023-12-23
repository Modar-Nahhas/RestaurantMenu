import {createRouter, createWebHistory} from "vue-router";
import store from "@/Plugins/Store.js";

import Home from "@/Pages/Dashboard/Home.vue";
import Login from "@/Pages/Auth/Login.vue";
import categoriesRoutes from "@/Pages/Categories/CategoriesRoutes.js";
import itemsRoutes from "@/Pages/Items/ItemsRoutes.js";
import discountsRoutes from "@/Pages/Discounts/DiscountsRoutes.js";
import menusRoutes from "@/Pages/Menus/MenusRoutes.js";


const routes = [
    {
        path: '/',
        component: Home,
        name: 'main',
        meta: {
            requireAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            requireAuth: false
        }
    },
    ...categoriesRoutes,
    ...itemsRoutes,
    ...discountsRoutes,
    ...menusRoutes,

    {
        path: '/:pathMatch(.*)*', redirect: {name: 'login'}
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (!store.getters.isLoggedin && to.meta.requireAuth) {
        return next('/login');
    } else if (store.getters.isLoggedin && (to.name == 'home' || to.name == 'login')) {
        return next('/');
    } else {
        return next();
    }
})
;

export default router;
