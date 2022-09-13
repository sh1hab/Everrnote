<template>
    <PageComponent title="Contacts">
        <div class="flex justify-between items-center">
            <div v-if="loading" class="flex justify-center">Loading...</div>
            <div v-else class="">
                <div class="grid">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Email</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(contact, index) in contacts.data" :key="contact.id">
                                <td>{{ index }}</td>
                                <td>{{ contact.email_or_phone }}</td>
                                <td>{{ contact.password }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>

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
            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import { useStore } from "vuex";
import { computed } from "vue";

const store = useStore();

const loading = computed(() => store.state.loading);

// onMounted()

store.dispatch('fetchContacts')
    .then(response => {
        console.log('line 35');
        console.log(response);
    })
    .catch(error => {
        console.log(error);
    })

let contacts = computed(() => {
    return store.state.contacts.data
});

</script>
