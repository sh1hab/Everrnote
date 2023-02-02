<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ route.params.id ? model.name : "Create a Contact" }}
                </h1>

                <div class="flex">

                    <button
                        v-if="route.params.id"
                        class="py-2 px-3 text-white bg-red-500 rounded-md hover:bg-red-600"
                        type="button"
                        @click="deleteContact()"
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
                        Delete Contact
                    </button>
                </div>
            </div>
        </template>

        <form @submit="saveContact">
            <div class="relative z-0 mb-6 w-full group">
                <input id="name" v-model="model.name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="name"
                       placeholder=" "
                       required type="text"/>
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="name">Name</label>
            </div>

<!--            <div class="grid md:grid-cols-2 md:gap-6">-->
<!--                <div class="relative z-0 mb-6 w-full group">-->
<!--                    <input id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="floating_first_name"-->
<!--                           placeholder=" "-->
<!--                            type="text"/>-->
<!--                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"-->
<!--                           for="floating_first_name">First-->
<!--                        name</label>-->
<!--                </div>-->
<!--                <div class="relative z-0 mb-6 w-full group">-->
<!--                    <input id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="floating_last_name"-->
<!--                           placeholder=" "-->
<!--                            type="text"/>-->
<!--                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"-->
<!--                           for="floating_last_name">Last-->
<!--                        name</label>-->
<!--                </div>-->
<!--            </div>-->

            <div class="relative z-0 mb-6 w-full group">
                <input id="email" v-model="model.email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="email"
                       placeholder=" "
                        type="email"/>
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="email">Email
                    address</label>
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <input id="floating_password" v-model="model.password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                       placeholder=" "
                        type="text"/>
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="floating_password">Password</label>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <input id="address" v-model="model.address" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="address"
                       placeholder=" "
                        type="text"/>
                <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                       for="address">Address</label>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input id="floating_phone" v-model="model.phone_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           name="phone_number" pattern="+[0-9]{2-3}-[0-9]{4}-[0-9]{4}"
                           placeholder=" "
                            type="tel"/>
                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                           for="phone_number">Phone
                        number (123-0456-7890)</label>
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input id="work_or_education_institute" v-model="model.work_or_education_institute" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none   dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           name="work_or_education_institute"
                           placeholder=" "
                            type="text"/>
                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                           for="work_or_education_institute">Institution
                        (Ex. Google)</label>
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

let surveyLoading = computed(() => store.state.currentSurvey.loading);


let model = ref({
    name: '',
    email: '',
    phone_number: '',
    is_password_active: false,
    details: null,
    nationality: '',
    address: '',
    work_or_education_institute: '',
    image: null,
    image_url: null,
    uploads: {}
});

// Watch to current survey data change and when this happens we update local model
watch(
    () => store.state.currentContact.data,
    (newVal) => {
        model.value = {
            ...JSON.parse(JSON.stringify(newVal))
        };
    }
);

if (route.params.id) {
    if (route.params.id) {
        store.dispatch("getContact", route.params.id);
    }
}

/*
   Create or Update survey
*/
function saveContact(event) {
    event.preventDefault();
    console.log(model.value);
    store.dispatch('saveContact', model.value).then(({data}) => {
        store.commit('notify', {
            type: 'success',
            message: 'Success'
        })

        router.push({
            name: 'Contacts',
        })
    })
}

function deleteContact() {
    if (confirm(`Are you sure you want to delete this ? Operation can't be undone!!`)) {
        store.dispatch("deleteContact", model.value.id).then(() => {
            store.commit('notify', {
                type: 'success',
                message: 'Success'
            })

            router.push({
                name: "Contacts",
            });
        });
    }
}

</script>
