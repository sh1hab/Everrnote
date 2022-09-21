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

        <div class="">
            <div v-if="loading" class="flex justify-center">Loading...</div>
            <div v-else class="overflow-auto">
<!--                <div class="grid">-->
<!--                    table -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="p-3 text-sm font-semibold">NO.</th>
                                <th class="p-3 text-sm font-semibold">Email/Phone Number</th>
                                <th class="p-3 text-sm font-semibold">Password</th>
                                <th class="p-3 text-sm font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(contact, index) in contacts.data" :key="contact.id" class="bg-white border-b  dark:border-gray-700">
                                <td class="p-3"><router-link :to="{ name: 'ContactView', params: {id: contact.id}}"  class="font-bold text-blue-500 hover:underline">{{ index + 1 }}</router-link></td>
                                <td class="p-3 text-gray-700">{{ contact.email_or_phone }}</td>
                                <td class="p-3 text-gray-700">{{ contact.password }}</td>
                                <td class="p-3 text-gray-700">{{ contact.status }}</td>
                            </tr>
                        </tbody>
                    </table>
<!--                    end table -->
<!--                </div>-->

<!--                pagination-->
                <div v-if="contacts.meta.total" class="flex justify-center mt-5">
                    <nav class="inline-flex justify-center rounded-md shadow-sm">
                        <a v-for="(link, index) of contacts.meta.links" :key="index" :disabled="!link.url" href="#"
                            @click="getForPage($event, link)" v-html="link.label"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                            :class="[
                              link.active
                                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                              index === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                              index === contacts.links.length - 1 ? 'rounded-r-md' : '',
                            ]">

                        </a>
                    </nav>
                </div>
                <!--                pagination end-->

            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../../components/PageComponent.vue";
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();
const loading = computed(() => store.state.loading);

// onMounted()

store.dispatch('fetchContacts');

let contacts = computed(() => {
    return store.state.contacts.data
});

function getForPage(event, link){
    event.preventDefault();

    if (!link.url || link.active) {
        return;
    }
    store.dispatch('fetchContacts', {url: link.url});

}

</script>


