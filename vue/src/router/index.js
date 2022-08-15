import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import store from "../store/index.js";
import AuthLayout from "../components/Layouts/AuthLayout.vue";
import DefaultLayout from "../components/Layouts/DefaultLayout.vue";


const routes = [
    {
        path: '/',
        redirect: '/dashboard',
        component: DefaultLayout,
        children: [
            {
                path: '/dashboard', name: Dashboard, component: Dashboard
            }
        ],
        meta: {requiresAuth: true}
    },
    {
        path: '/auth',
        redirect: '/login',
        name: 'Auth',
        component: AuthLayout,
        meta: {requiresAuth: false, isGuest: true},
        children: [
            {
                path: '/login',
                name: 'Login',
                component: Login,
            },
            {
                path: '/register',
                name: 'Register',
                component: Register,
            }
        ]
    },
    {
        path: '/logout',
        name: 'Logout',
        meta: {requiresAuth: true}
    },

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (!store.state.user.token && to.meta.requiresAuth) {
        next({name: 'Login'});
    } else if (store.state.user.token && to.meta.isGuest) {
        next({path: 'Dashboard', 'message': 'You are already logged in'});
    } else {
        next();
    }
})

export default router


