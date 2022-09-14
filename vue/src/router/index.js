import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Notes from "../views/Notes.vue";
import Login from "../views/Login.vue";
import Contacts from "../views/Contacts.vue";
import Register from "../views/Register.vue";
import store from "../store/index.js";
import AuthLayout from "../components/Layouts/AuthLayout.vue";
import DefaultLayout from "../components/Layouts/DefaultLayout.vue";
import SurveyView from "../views/Survey/SurveyView.vue";
import Surveys from "../views/Survey/Surveys.vue";
import NotFound from "../views/NotFound.vue"

const routes = [
    {
        path: '/',
        name: 'Index',
        redirect: '/dashboard',
        component: DefaultLayout,
        children: [
            {
                path: '/dashboard', name: 'Dashboard', component: Dashboard,
            },
            {
                path: '/notes', name: 'Notes', component: Notes
            },
            {
                path: '/contacts', name: 'Contacts', component: Contacts
            },
            {
                path: '/surveys', name: 'Surveys', component: Surveys,
            },
            {
                path: '/surveys/create', name: 'SurveyCreate', component: SurveyView,
            },
            {
                path: '/surveys/:id', name: 'SurveyView', component: SurveyView,
            },
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
        meta: {requiresAuth: true},

    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: NotFound
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (!store.state.user.token && to.meta.requiresAuth) {
        next({name: 'Login'});
    } else if (store.state.user.token && to.meta.isGuest) {
        // console.clear();
        // console.log(store.state.user.token);
        next({path: 'Dashboard', 'message': 'You are already logged in'});
    } else {
        next();
    }
})

export default router


