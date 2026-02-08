import { createRouter, createWebHashHistory } from "vue-router";
import store from '@/store'

import Login from '../components/auth/Login.vue';
import App from '../views/App.vue';
import Home from '../components/layout/Home.vue';
import PageNotFound from '../components/layout/PageNotFound.vue';
import material from '../components/material/form.vue';


const routes = [
    {
        path: '/:pathMatch(.*)*',
        name: 'page-not-found',
        component: PageNotFound
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            middleware: "guest"
        }
    },
        {
        path: '/home',
        name: 'app',
        component: App,
        children: [
            {
                path: '/',
                name: 'home',
                component: Home
            },
           
        ]
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            return next({ name: "home" })
        }
        return next()
    } else {
        if (store.state.auth.authenticated) {
            return next()
        } else {
            return next({ name: "login" })
        }
    }
})

export default router;