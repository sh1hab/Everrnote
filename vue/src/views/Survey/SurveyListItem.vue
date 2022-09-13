<template>
    <div class="flex flex-col py-4 px-6 shadow-md bg-white hover:bg-gray-50 h-[470px]">
        <router-link class=" flex  border border-transparent text-sm rounded-md"
                     :to="{name: 'SurveyView', params: {id: survey.id}}">
            <img :src="(survey.upload && survey.upload.image_url) || 'https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg'" :alt="survey.title" class="w-full h-48 object-cover">
        </router-link>
        <h4 class="mt-4 text-lg font-bold">{{ survey.title }}</h4>
        <div class="overflow-hidden flex-1" v-html="survey.description"></div>

        <div class="flex justify-between items-center mt-3">
            <router-link class="py-2 flex px-4 border border-transparent text-sm rounded-md"
                         :to="{name: 'SurveyView', params: {id: survey.id}}">
                Edit
            </router-link>

            <button v-if="survey.id"  class="object-cover border border-transparent" type="button" @click="emits('delete', survey.id)">Delete</button>

        </div>
    </div>
</template>

<script setup>

import {defineProps, defineEmits} from "vue";

const props = defineProps({
   survey: {},
});

const emits = defineEmits(['delete']);

</script>

