<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Surveys</h1>
                <router-link
                    :to="{ name: 'SurveyCreate' }"
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
                    Add new Survey
                </router-link>
            </div>
        </template>

        <div v-if="surveys.loading" class="flex justify-center">Loading...</div>
        <div>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3" :class="[surveys.loading ? 'animate-pulse': '']">
                <SurveyListItem v-for="(survey,index) in surveys.data"
                                :key="survey.id"
                                :style="{animationDelay: `${index * 0.1}s`}"
                                :survey="survey"
                                class="animate-fade-in-down"
                                @delete="deleteSurvey"
                />
            </div>

            <div v-if="surveys.meta && surveys.meta.total" class="flex justify-center mt-5">
                <nav class="inline-flex justify-center rounded-md shadow-sm">
                    <a v-for="(link, index) of surveys.links"
                       :key="index"
                       :disabled="!link.url"
                       href="#"
                       @click="getForPage($event, link)"
                       v-html="link.label"
                       class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                       :class="[
              link.active
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
              index === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
              index === surveys.links.length - 1 ? 'rounded-r-md' : '',
            ]"
                    >

                    </a>
                </nav>
            </div>
        </div>
    </PageComponent>
</template>

<script setup>
import {computed} from "vue";
import store from "../../store";
import router from "../../router/index.js";
import PageComponent from "../../components/PageComponent.vue";
import SurveyListItem from "../Survey/SurveyListItem.vue"

const surveys = computed(() => store.state.surveys);

store.dispatch("getSurveys");

function deleteSurvey(id) {
    if (confirm(`Are you sure you want to delete this survey? Operation can't be undone!!`)) {
        store.dispatch("deleteSurvey", id).then(() => {
            store.dispatch('getSurveys');

            store.commit('notify', {
                type: 'success',
                message: 'Successfully Deleted Survey'
            })

            router.push({
                name: "Surveys",
            });
        });
    }
}

function getForPage(event, link){
    event.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    store.dispatch('getSurveys', {url: link.url});
}

</script>

