<template>
    <PageComponent title="Contacts">
            <template v-slot:header>
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Contacts</h1>
                    <router-link
                        :to="{ name: 'ContactCreate' }"
                        class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-600"
                    >
                        <svg
                            class="h-4 w-4 -mt-1 inline-block"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 4v16m8-8H4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                        Add new Contact
                    </router-link>
                </div>
            </template>


        <form class="flex items-center" >
            <label for="voice-search" class="sr-only"> </label>
<!--            search field-->
            <div class="relative w-full" v-show="showSearchMenu">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search ..." required>
                <button type="button" class="flex absolute inset-y-0 right-0 items-center pr-3">
                    <svg aria-hidden="true" class="w-4 h-4 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
<!--            button-->
            <button @click.prevent="toggleSearchMenu" type="submit" style=""
                    class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>

        <hr>

        <br>

        <div class="">
            <div v-if="loading" class="flex justify-center">Loading...</div>
            <div v-else class="overflow-auto">
<!--                    table -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="p-3 text-sm font-semibold">NO.</th>
                                <th class="p-3 text-sm font-semibold">Name</th>
                                <th class="p-3 text-sm font-semibold">Email</th>
                                <th class="p-3 text-sm font-semibold">Phone No</th>
                                <th class="p-3 text-sm font-semibold">Password</th>
                                <th class="p-3 text-sm font-semibold">Is Password Active</th>
                                <th class="p-3 text-sm font-semibold">Work/University</th>
                                <th class="p-3 text-sm font-semibold">Nationality</th>
                                <th class="p-3 text-sm font-semibold">Address</th>
                                <th class="p-3 text-sm font-semibold">Facebook</th>
                                <th class="p-3 text-sm font-semibold">Starred</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(contact, index) in contacts.data" :key="contact.id" class="bg-white border-b  dark:border-gray-700">
                                <td class="p-3"><router-link :to="{ name: 'ContactView', params: {id: contact.id}}"  class="font-bold text-blue-500 hover:underline">{{ index + 1 }}</router-link></td>
                                <td class="p-3 text-gray-700">{{ contact.name }}</td>
                                <td class="p-3 text-gray-700">{{ contact.email }}</td>
                                <td class="p-3 text-gray-700">{{ contact.phone_number }}</td>
                                <td class="p-3 text-gray-700">{{ contact.password }}</td>
                                <td class="p-3 text-gray-700">{{ contact.is_password_active }}</td>
                                <td class="p-3 text-gray-700">{{ contact.work_or_education_institute }}</td>
                                <td class="p-3 text-gray-700">{{ contact.nationality }}</td>
                                <td class="p-3 text-gray-700">{{ contact.address }}</td>
                                <td class="p-3 text-gray-700">{{ contact.facebook }}</td>
                                <td class="p-3 text-gray-700">{{ contact.starred }}</td>
                            </tr>
                        </tbody>
                    </table>
<!--                    end table -->

                <!--                pagination-->
                <Pagination :items="contacts" @getForPage="getForPage"></Pagination>
                <!--                pagination end-->

            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import { useStore } from "vuex";
import { computed, ref } from "vue";
import PageComponent from "../../components/PageComponent.vue";
import Pagination from "../../components/Pagination.vue";

const store = useStore();
const loading = computed(() => store.state.loading);

let showSearchMenu = ref(false);

store.dispatch('getContacts');

let contacts = computed(() => {
    return store.state.contacts.data
});

function toggleSearchMenu(){
    showSearchMenu.value = !showSearchMenu.value;
}

function getForPage(event, link){
    console.clear();
    console.log(link);
    event.preventDefault();

    if (!link.url || link.active) {
        return;
    }
    store.dispatch('getContacts', {url: link.url});

}

</script>


