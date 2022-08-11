<script setup>

</script>

<template>

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img alt="Workflow" class="mx-auto h-12 w-auto"
                     src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Feel free to register</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    <router-link class="font-medium text-indigo-600 hover:text-indigo-500" to="/login"> login to your
                        account
                    </router-link>
                </p>
            </div>
            <form action="#" class="mt-8 space-y-6" method="POST">
                <input name="remember" type="hidden" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label class="sr-only" for="full-name">Full name</label>
                        <input id="full-name" autocomplete=""
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900  focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               name="full_name" placeholder="Full name"
                               required
                               type="text">
                    </div>
                    <div>
                        <label class="sr-only" for="email-address">Email address</label>
                        <input id="email-address" autocomplete="email"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               name="email" placeholder="Email address"
                               required
                               type="email">
                    </div>
                    <div>
                        <label class="sr-only" for="password">Password</label>
                        <input id="password" autocomplete="current-password"
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               name="password" placeholder="Password"
                               required
                               type="password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <!--                    <div class="text-sm">-->
                    <!--                        <router-link class="font-medium text-indigo-600 hover:text-indigo-500" to="/login"> login to your account </router-link>-->
                    <!--                    </div>-->
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
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

<style scoped>

</style>
