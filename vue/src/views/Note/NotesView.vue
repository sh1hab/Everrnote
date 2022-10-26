<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ route.params.id ? model.title : "Create a Note" }}
                </h1>

                <div class="flex">
                    <a
                        v-if="model.slug"
                        :href="`/view/survey/${model.slug}`"
                        class="flex py-2 px-4 border border-transparent text-sm rounded-md text-indigo-500 hover:bg-indigo-700 hover:text-white transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2"
                        target="_blank"
                    >
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                        View Public link
                    </a>

                    <button
                        v-if="route.params.id"
                        class="py-2 px-3 text-white bg-red-500 rounded-md hover:bg-red-600"
                        type="button"
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
                        Delete This!
                    </button>

                    <!--        modal-->
                    <div id="popup-modal"
                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full"
                         tabindex="-1">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button
                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                    data-modal-toggle="popup-modal"
                                    type="button">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                              fill-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <div class="p-6 text-center">
                                    <svg aria-hidden="true"
                                         class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                              stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"></path>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure
                                        you want to
                                        delete this Content?</h3>
                                    <button
                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                                        data-modal-toggle="popup-modal"
                                        type="button">
                                        Yes, I'm sure
                                    </button>
                                    <button
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                        data-modal-toggle="popup-modal"
                                        type="button">
                                        No, cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </template>


        <!--        form-->
        <form class="animate-fade-in-down" @submit.prevent="saveNote">
            <!-- title -->
            <div class="">
                <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                <input
                    id="title"
                    v-model="model.title"
                    autocomplete=""
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    name="title"
                    type="text"
                />
            </div>
            <!--/ Title -->

            <div class="" style="padding-top: 5vw">
                <editor v-model="model.description" :init="{plugins: 'lists link table code help wordcount'}" class=""/>
            </div>

            <!--            button-->
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    type="submit"
                >
                    Save
                </button>
            </div>
        </form>
        <!--        form end -->


    </PageComponent>
</template>


<script setup>
import store from "../../store";
import {computed, ref, watch} from "vue";
import Editor from '@tinymce/tinymce-vue'
import router from "../../router/index.js";
import {useRoute} from "vue-router";
import PageComponent from "../../components/PageComponent.vue";

const title = "View or Create a Note"
const route = useRoute();

let loading = computed(() => store.state.loading);

let model = ref({
    title: '',
    description: null,
});

// Watch to current note data change and when this happens we update local model
watch(
    () => store.state.currentNote.data,
    (newVal) => {
        model.value = {
            ...JSON.parse(JSON.stringify(newVal))
        };
    }
);

if (route.params.id) {
    if (route.params.id) {
        store.dispatch("getNote", route.params.id);
    }
}

function saveNote() {
    store.dispatch('saveNote', model.value)
        .then(({data}) => {
            store.commit('notify', {
                type: 'success',
                message: 'Success!'
            })

            router.push({
                name: 'NotesView',
                params: {id: data.data.id}
            })
        })
}

function deleteNote() {
    // if (confirm(`Are you sure you want to delete this ? Operation can't be undone!!`)) {
    store.dispatch("deleteNote", model.value._id).then(() => {

        store.commit('notify', {
            type: 'success',
            message: 'Successfully deleted'
        })

        router.push({
            name: "Notes",
        });
    });
    // }
}


</script>
