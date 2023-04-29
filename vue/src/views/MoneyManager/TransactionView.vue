<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ route.params.id ? model.name : "Create a Transaction" }}
                </h1>

                <div class="flex">

                    <button
                        v-if="route.params.id"
                        class="py-2 px-3 text-white bg-red-500 rounded-md hover:bg-red-600"
                        type="button"
                        @click="deleteTransaction()"
                    >
                        <svg
                            class="h-5 w-5 -mt-1 inline-block"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                clip-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                fill-rule="evenodd"
                            />
                        </svg>
                        Delete Transaction
                    </button>
                </div>
            </div>
        </template>


        <form class="" @submit.prevent="saveTransaction">
            <div class="relative z-0 mb-6 w-full group">
                <input v-model="model.amount" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="floating_email"
                       placeholder=" "
                       required type="number" step="0.01" min="1"/>
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="floating_email">Amount</label>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <input v-model="model.notes" id="" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="floating_email"
                       placeholder=" "
                       required type="text" />
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="floating_email">Notes</label>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <input v-model="model.currency" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="floating_email"
                       placeholder="BDT"
                       required type="text" />
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="floating_email">Currency</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <select v-model="model.type" name="type" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                    </select>

                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                           for="floating_first_name">Type</label>
                </div>
            </div>

            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="submit">
                Submit
            </button>
        </form>
    </PageComponent>
</template>


<script setup>
import {computed, ref, watch} from "vue";
import store from "../../store";
import router from "../../router/index.js";
import {useRoute} from "vue-router";
import PageComponent from "../../components/PageComponent.vue";

const title = "View or Create a Contact"
const route = useRoute();


let model = ref({
    amount: '',
    type: '',
    to: null,
    from: null,
    notes: '',
    currency: 'BDT',
});

// Watch to current survey data change and when this happens we update local model
watch(
    () => store.state.currentTransaction.data.data,
    (newVal) => {
        model.value = {
            ...JSON.parse(JSON.stringify(newVal)),
            status: !!newVal.status,
        };
    }
);

if (route.params.id) {
    store.dispatch("getTransaction", route.params.id);
}

/*
   Create or Update survey
*/
function saveTransaction() {
    store.dispatch('saveTransaction', model.value).then(({data}) => {
        store.commit('notify', {
            type: 'success',
            message: 'Success'
        })

        router.push({
            name: 'TransactionView',
            params: {id: data.data.id}
        })
    })
}

function deleteTransaction() {
    if (confirm(`Are you sure you want to delete this survey? Operation can't be undone!!`)) {
        store.dispatch("deleteTransaction", model.value.id).then(() => {

            store.commit('notify', {
                type: 'success',
                message: 'Success'
            })

            router.push({
                name: "Transactions",
            });
        });
    }
}

</script>
