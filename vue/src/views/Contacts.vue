<template>
    <PageComponent title="Contacts">
        <table class="table-auto border-spacing-3">
            <thead>
            <tr>
                <th>NO</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in contacts" :key="contact.id">
                <td>{{ contact.id }}</td>
                <td>{{ contact.email }}</td>
                <td>{{ contact.password }}</td>
            </tr>

            </tbody>
        </table>
    </PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue";
import {useStore} from "vuex";
import {computed} from "vue";
import {onMounted} from "vue";

const store = useStore();

// onMounted()

store.dispatch('fetchContacts')
    .then(response => {
        console.log('line 35');
        console.log(response);
    })
    .catch(error => {
        console.log(error);
    })

let contacts = computed(() => {
    return store.state.contacts.data
});

</script>
