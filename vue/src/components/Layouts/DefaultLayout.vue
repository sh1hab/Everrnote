<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-gray-100">
      <body class="h-full">
      ```
    -->
    <div class="min-h-full">
        <Disclosure v-slot="{ open }" as="nav" class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img alt="Workflow" class="h-8 w-8"
                                 src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"/>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <router-link v-for="item in navigation" :key="item.name"
                                             :class="[item.current ? '' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'px-3 py-2 rounded-md text-sm font-medium']"
                                             :to="item.to"
                                             active-class="bg-gray-900 text-white">{{ item.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!--                            <button-->
                            <!--                                class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"-->
                            <!--                                type="button">-->
                            <!--                                <span class="sr-only">View notifications</span>-->
                            <!--                                <BellIcon aria-hidden="true" class="h-6 w-6"/>-->
                            <!--                            </button>-->

                            <!-- Profile dropdown -->
                            <Menu as="div" class="ml-3 relative">
                                <div>
                                    <MenuButton
                                        class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                        <span class="sr-only">Open user menu</span>
                                        <img :alt="user.name"
                                             :src="(user.upload && user.upload.image_url) || 'https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg'"
                                             class="h-8 w-8 rounded-full"/>
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100"
                                            enter-from-class="transform opacity-0 scale-95"
                                            enter-to-class="transform opacity-100 scale-100"
                                            leave-active-class="transition ease-in duration-75"
                                            leave-from-class="transform opacity-100 scale-100"
                                            leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                            <button  @click.prevent="action(item.name)"
                                                     :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']"
                                                     :to="item.to.name">{{
                                                    item.name
                                                }}</button>

                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <!-- Mobile menu button -->
                        <DisclosureButton
                            class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">Open main menu</span>
                            <MenuIcon v-if="!open" aria-hidden="true" class="block h-6 w-6"/>
                            <XIcon v-else aria-hidden="true" class="block h-6 w-6"/>
                        </DisclosureButton>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <router-link v-for="item in navigation"
                                 :key="item.name"
                                 :class="[this.$route.name === item.to.name ? '' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium']"
                                 :to="item.to.name"
                                 active-class="bg-gray-900 text-white"
                    >{{ item.name }}
                    </router-link>
                </div>

                <div class="pt-4 pb-3 border-t border-gray-700">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img
                                :src="(user.upload && user.upload.image_url) || 'https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg'"
                                alt="{{ user.name }}" class="h-10 w-10 rounded-full"/>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white">{{ user.name }}</div>
                            <div class="text-s  m font-medium leading-none text-gray-400">{{ user.email }}</div>
                        </div>
                        <button
                            class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                            type="button">
                            <span class="sr-only">View notifications</span>
                            <BellIcon aria-hidden="true" class="h-6 w-6"/>
                        </button>
                    </div>

                    <div class="mt-3 px-2 space-y-1">
                        <DisclosureButton v-for="item in userNavigation" :key="item.name" :href="item.href" as="a" @click.prevent="action(item.name)"
                                          class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">
                            {{ item.name }}
                        </DisclosureButton>
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>


        <router-view></router-view>

        <Notification/>
    </div>
</template>

<script setup>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {BellIcon, MenuIcon, XIcon} from '@heroicons/vue/outline'
import {useStore} from "vuex";
import {computed} from "vue";
import {useRouter} from "vue-router";
import Notification from "../Notification.vue";

const store = useStore();
const router = useRouter();


store.dispatch("getUser");

const user = computed(() => {
    return store.state.user.data
});

// const user = store.state.user.data;

const navigation = [
    {name: 'Dashboard', to: {name: 'Dashboard'}},
    {name: 'Accounts', to: {name: 'Accounts'}},
    {name: 'Contacts', to: {name: 'Contacts'}},
    {name: 'Notes', to: {name: 'Notes'}},
    // {name: 'Journal', to: {name: 'Journal'}},
    // {name: 'MoneyManager', to: {name: 'MoneyManager'}},
    {name: 'Surveys', to: {name: "Surveys"}},
]

const userNavigation = [
    {name: 'Your Profile', to: {name: 'profile'}},
    {name: 'Settings', to: {name: 'settings'}},
    {name: 'Sign out', to: {name: 'logout'}},
]

function logout() {
    store.dispatch('logout')
        .then(()=>{
            router.push({
                name: 'Login'
            })
        });

}

function action(name){
    if (name.toLowerCase() === 'sign out'){
        logout();
    }
}

</script>
