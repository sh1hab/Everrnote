<template>

    <div>
        <img alt="Workflow" class="mx-auto h-12 w-auto"
             src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in NOW! </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <router-link :to="{name: 'Register'}" class="font-medium text-indigo-600 hover:text-indigo-500">
                Register
            </router-link>
        </p>
    </div>

    <form class="mt-8 space-y-6" method="POST" @submit.prevent="login">

        <span class="accent-red-500">{{ errorMsg }}</span>

        <input name="remember" type="hidden" value="true">

        <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label class="sr-only" for="email-address">Email address</label>
                <input id="email-address" v-model="user.email" autocomplete="email"
                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                       name="email" placeholder="Email address"
                       required
                       type="email">
            </div>
            <div>
                <label class="sr-only" for="password">Password</label>
                <input id="password" v-model="user.password" autocomplete="current-password"
                       class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                       name="password" placeholder="Password"
                       required
                       type="password">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me"
                       v-model="user.remember"
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                       name="remember-me" type="checkbox">
                <label class="ml-2 block text-sm text-gray-900" for="remember-me"> Remember me </label>
            </div>
        </div>

        <div>
            <button
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                type="submit">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <!-- Heroicon name: solid/lock-closed -->
              <svg aria-hidden="true" class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                   fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      fill-rule="evenodd"/>
              </svg>
            </span>
                Login
            </button>
        </div>
    </form>

</template>

<script setup>
import store from "../store";
import {useRouter} from "vue-router";
import {ref} from "vue";

const router = useRouter();

const user = {
    email: '',
    password: '',
    remember: false
}

let errorMsg = ref('');

function login() {
    store.dispatch('login', user)
        .then(response => {
            console.clear();
            console.log(router.getRoutes());

            router.push({
                name: 'Dashboard'
            });
        })
        // .catch(error => {
        //     // console.clear();
        //     console.log(error.response.data.errors);
        //
        //     errorMsg.value = error.response.data.errors
        // });
}

</script>
