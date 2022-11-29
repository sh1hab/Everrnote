<template>
    <PageComponent title="Contacts">
            <template v-slot:header>
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Accounts</h1>
                    <router-link
                        :to="{ name: 'AccountCreate' }"
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
                         New Account
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
                                <th class="p-3 text-sm font-semibold">Account No</th>
                                <th class="p-3 text-sm font-semibold">Bank/MoneyTransfer</th>
                                <th class="p-3 text-sm font-semibold">PIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(account, index) in accounts.data" :key="account.id" class="bg-white border-b  dark:border-gray-700">
                                <td class="p-3"><router-link :to="{ name: 'ContactView', params: {id: account.id}}"  class="font-bold text-blue-500 hover:underline">{{ index + 1 }}</router-link></td>
                                <td class="p-3 text-gray-700">{{ account.no }}</td>
                                <td class="p-3 text-gray-700">{{ account.institution }}</td>
                                <td class="p-3 text-gray-700">{{ account.pin }}</td>
                            </tr>
                        </tbody>
                    </table>
<!--                    end table -->
<!--                </div>-->

<!--                pagination-->
                <Pagination :items="accounts" ></Pagination>
                <!--                pagination end-->

            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import { useStore } from "vuex";
import { computed } from "vue";
import Pagination from "../../components/Pagination.vue";
import PageComponent from "../../components/PageComponent.vue";

const store = useStore();
const loading = computed(() => store.state.loading);


store.dispatch('getAccounts');

let accounts = computed(() => {
    return store.state.accounts.data
});

function getForPage(event, link){
    event.preventDefault();

    if (!link.url || link.active) {
        return;
    }
    store.dispatch('getAccounts', {url: link.url});

}

</script>


