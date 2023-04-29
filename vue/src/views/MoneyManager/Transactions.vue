<template>
    <PageComponent title="Contacts">
            <template v-slot:header>
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Transactions</h1>
                    <router-link
                        :to="{ name: 'TransactionCreate' }"
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
                         New Transaction
                    </router-link>
                </div>
            </template>

        <div class="">
            <div v-if="loading" class="flex justify-center">Loading...</div>
            <div v-else class="overflow-auto">
<!--                    table -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="p-3 text-sm font-semibold">NO.</th>
                                <th class="p-3 text-sm font-semibold">Amount</th>
                                <th class="p-3 text-sm font-semibold">Currency</th>
                                <th class="p-3 text-sm font-semibold">Debit/Credit</th>
                                <th class="p-3 text-sm font-semibold">Date Time</th>
                                <th class="p-3 text-sm font-semibold">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(transaction, index) in transactions.data" :key="transaction.id" class="bg-white border-b  dark:border-gray-700">
                                <td class="p-3"><router-link :to="{ name: 'TransactionView', params: {id: transaction.id}}"  class="font-bold text-blue-500 hover:underline">{{ index + 1 }}</router-link></td>
                                <td class="p-3 text-gray-700">{{ transaction.amount }}</td>
                                <td class="p-3 text-gray-700">{{ transaction.currency }}</td>
                                <td class="p-3 text-gray-700">{{ transaction.type }}</td>
                                <td class="p-3 text-gray-700">{{ transaction.created_at }}</td>
                                <td class="p-3 text-gray-700">{{ transaction.notes }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>
                    <div>
                    Total  {{ transactions.total }}
                        
                    </div>
                    <hr>
<!--                    end table -->

<!--                pagination-->
                <Pagination :items="transactions"></Pagination>
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

// onMounted()

store.dispatch('getTransactions');

let transactions = computed(() => {
    return store.state.transactions
});

function getForPage(event, link){
    event.preventDefault();

    if (!link.url || link.active) {
        return;
    }
    store.dispatch('getTransactions', {url: link.url});

}

</script>


