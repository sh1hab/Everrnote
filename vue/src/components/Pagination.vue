<template>
    <div v-if="items.meta && items.meta.total" class="flex justify-center mt-5">
        <nav class="inline-flex justify-center rounded-md shadow-sm">
            <a v-for="(link, index) of items.meta.links" :key="index" :disabled="!link.url" href="#"
               @click="emits('getForPage', $event, link)" v-html="link.label"
               class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
               :class="[
                              link.active
                                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                              index === 0 ? 'rounded-l-md bg-gray-100 text-gray-700' : '',
                              index === items.links.length - 1 ? 'rounded-r-md' : '',
                            ]">
            </a>
        </nav>
    </div>
</template>

<script setup>
import {defineProps, defineEmits} from "vue";

const props = defineProps({
    items: {}
});

const emits = defineEmits(['getForPage'])


</script>
