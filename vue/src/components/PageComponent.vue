<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <slot name="header"></slot>
        </div>
    </header>

    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <slot>Content goes here</slot>

            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
                <!--                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"/>-->
            </div>
        </div>
    </main>

</template>

<script setup>

const props = defineProps({
    title: String
});

</script>
