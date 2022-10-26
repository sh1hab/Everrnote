<template>
    <PageComponent>
        <template v-slot:header>
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-900">Notes</h1>
                <router-link
                    :to="{ name: 'NoteCreate' }"
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
                    Add New Note
                </router-link>
            </div>
        </template>


        <template v-slot:default>
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
                <div v-for="note in notes.data"
                     class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                    <router-link href="#" :to="{ name: 'NotesView', params: {id: note._id}}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ note.title }}</h5>
                    </router-link>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400" v-html="shortenedString(note.description)"></p>
                </div>

                <div v-if="notes.data.length === 0" class="justify-center">
                    <h1>No notes</h1>
                </div>
            </div>
        </template>

    </PageComponent>
</template>

<script setup>
import {computed, onMounted} from "vue";
import store from "../../store";
import PageComponent from "../../components/PageComponent.vue";

const notes = computed(() => store.state.notes);

onMounted(() => {
    store.dispatch('getNotes');
})

function shortenedString(text){
    const maxLength =  50;
    let trimmedString = text.substring(0, maxLength);

    trimmedString =  trimmedString.substring(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))

    if (trimmedString.length < text.length ){
        trimmedString+=" \n\n .......";
    }

    return trimmedString
}

function dom(text) {
    const parser = new DOMParser();
    const elem = parser.parseFromString(text, 'text/html');
    return elem.body.innerText;
}

</script>
