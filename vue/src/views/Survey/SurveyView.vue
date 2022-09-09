<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ route.params.id ? model.title : "Create a Survey" }}
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
                        @click="deleteSurvey()"
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
                        Delete Survey
                    </button>
                </div>
            </div>
        </template>

        <div v-if="surveyLoading" class="flex justify-center">Loading...</div>
        <form v-else class="animate-fade-in-down" @submit.prevent="saveSurvey">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <!-- Survey Fields -->
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Image
                        </label>
                        <div class="mt-1 flex items-center">
                            <img
                                v-if="model.upload && model.upload.image_url"
                                :alt="model.title"
                                :src="model.upload.image_url"
                                class="w-64 h-48 object-cover"
                            />
                            <span
                                v-else
                                class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100"
                            >
                <svg
                    class="h-[80%] w-[80%] text-gray-300"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      clip-rule="evenodd"
                      d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                      fill-rule="evenodd"
                  />
                </svg>
              </span>
                            <button
                                class="relative overflow-hidden ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                type="button"
                            >
                                <input
                                    class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                                    type="file"
                                    @change="onImageChoose"
                                />
                                Change
                            </button>
                        </div>
                    </div>
                    <!--/ Image -->

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="title"
                        >Title</label
                        >
                        <input
                            id="title"
                            v-model="model.title"
                            autocomplete="survey_title"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            name="title"
                            type="text"
                        />
                    </div>
                    <!--/ Title -->

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700" for="about">
                            Description
                        </label>
                        <div class="mt-1">
              <textarea
                  id="description"
                  v-model="model.description"
                  autocomplete="survey_description"
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                  name="description"
                  placeholder="Describe your survey"
                  rows="3"
              />
                        </div>
                    </div>
                    <!-- Description -->

                    <!-- Expire Date -->
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700"
                            for="expire_date"
                        >Expire Date</label
                        >
                        <input
                            id="expire_date"
                            v-model="model.expire_date"
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            name="expire_date"
                            type="date"
                        />
                    </div>
                    <!--/ Expire Date -->

                    <!-- Status -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input
                                id="status"
                                v-model="model.status"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                name="status"
                                type="checkbox"
                            />
                        </div>
                        <div class="ml-3 text-sm">
                            <label class="font-medium text-gray-700" for="status"
                            >Active</label
                            >
                        </div>
                    </div>
                    <!--/ Status -->
                </div>
                <!--/ Survey Fields -->

                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <h3 class="text-2xl font-semibold flex items-center justify-between">
                        Questions

                        <!-- Add new question -->
                        <button
                            class="flex items-center text-sm py-1 px-4 rounded-sm text-white bg-gray-600 hover:bg-gray-700"
                            type="button"
                            @click="addQuestion()"
                        >
                            <svg
                                class="h-4 w-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    clip-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    fill-rule="evenodd"
                                />
                            </svg>
                            Add Question
                        </button>
                        <!--/ Add new question -->
                    </h3>
                    <div v-if="model.questions && !model.questions.length" class="text-center text-gray-600">
                        You don't have any questions created
                    </div>
                    <div v-for="(question, index) in model.questions" :key="question.id">
                        <QuestionEditor
                            :index="index"
                            :question="question"
                            @addQuestion="addQuestion"
                            @change="changeQuestion"
                            @deleteQuestion="deleteQuestion"
                        />
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        type="submit"
                    >
                        Save
                    </button>
                </div>
            </div>
        </form>
    </PageComponent>
</template>


<script setup>
import store from "../../store";
import {ref, watchEffect, watch, computed} from "vue";
import {useRoute} from "vue-router";
import {v4 as uuidv4} from "uuid";

import PageComponent from "../../components/PageComponent.vue";
import QuestionEditor from "../../components/Editor/QuestionEditor.vue"
import router from "../../router/index.js";
// Advanced Use - Hook into Quill's API for Custom Functionality

const title = "View or Create a survey"
const route = useRoute();

let surveyLoading = computed(()=> store.state.currentSurvey.loading);

let model = ref({
    title: '',
    status: false,
    description: null,
    image: null,
    image_url: null,
    expire_date: null,
    questions: [],
    upload: {}
});

// Watch to current survey data change and when this happens we update local model
watch(
    () => store.state.currentSurvey.data,
    (newVal) => {
        // console.clear();
        // console.log(newVal);
        model.value = {
            ...JSON.parse(JSON.stringify(newVal)),
            status: !!newVal.status,
        };
    }
);

if (route.params.id) {
    // why comment out
    // model.value = store.state.surveys.find(
    //     (s) => {
    //         return s.id === parseInt(route.params.id)
    //     }
    // )

    if (route.params.id) {
        store.dispatch("getSurvey", route.params.id);
    }
}

/*
   Create or Update survey
*/
function saveSurvey() {
    store.dispatch('saveSurvey', model.value).then(({data}) => {
        store.commit('notify', {
            type: 'success',
            message: 'Success'
        })

        router.push({
            name: 'SurveyView',
            params: {id: data.data.id}
        })
    })
}

function deleteSurvey() {
    if (confirm(`Are you sure you want to delete this survey? Operation can't be undone!!`)) {
        store.dispatch("deleteSurvey", model.value.id).then(() => {

            store.commit('notify', {
                type: 'success',
                message: 'Success'
            })

            router.push({
                name: "Surveys",
            });
        });
    }
}

function addQuestion(index) {
    const newQuestion = {
        id: uuidv4(),
        type: "text",
        question: '',
        description: null,
        data: {}
    }

    console.log(model.value);

    model.value.questions.splice(index, 0, newQuestion);
}

function deleteQuestion(question) {
    model.value.questions = model.value.questions.filter(
        (q) => {
            return q !== question
        }
    )
}

function changeQuestion(question) {
    model.value.questions = model.value.questions.map(
        (q) => {
            if (q.id === question.id) {
                return JSON.parse(JSON.stringify(question))
            }
            return q;
        }
    )
}

function onImageChoose(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    // console.log(typeof reader.onload);
    reader.onload = () => {
        model.value.image = reader.result;
        model.value.upload.image_url = reader.result;
    }
    // console.log(typeof reader.onload);

    reader.readAsDataURL(file);
}


</script>
