import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Accounts from "../views/Account/Accounts.vue";
import AccountView from "../views/Account/AccountView.vue";
import Notes from "../views/Note/Notes.vue";
import NotesView from "../views/Note/NotesView.vue";
import Login from "../views/Login.vue";
import Contacts from "../views/Contact/Contacts.vue";
import ContactView from "../views/Contact/ContactView.vue";
import Register from "../views/Register.vue";
import AuthLayout from "../components/Layouts/AuthLayout.vue";
import DefaultLayout from "../components/Layouts/DefaultLayout.vue";
import SurveyView from "../views/Survey/SurveyView.vue";
import Surveys from "../views/Survey/Surveys.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store/index.js";

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
                path: '/accounts', name: 'Accounts', component: Accounts
            },
            {
                path: '/accounts/create', name: 'AccountCreate', component: AccountView
            },
            {
                path: '/accounts/:id', name: 'AccountView', component: AccountView,
            },
            {
                path: '/notes', name: 'Notes', component: Notes, children: []
            },
            {
                path: '/notes/create', name: 'NoteCreate', component: NotesView
            },
            {
                path: '/notes/:id', name: 'NotesView', component: NotesView
            },
            {
                path: '/contacts', name: 'Contacts', component: Contacts
            },
            {
                path: '/contacts/create', name: 'ContactCreate', component: ContactView
            },
            {
                path: '/contacts/:id', name: 'ContactView', component: ContactView,
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
        next({path: 'Dashboard', 'message': 'You are already logged in'});
    } else {
        next();
    }
})

export default router


