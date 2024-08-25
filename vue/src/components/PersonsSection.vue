<script setup>

import { onMounted, reactive } from 'vue';

const state = reactive({
        persons: [],
        isLoading: true
    }); 

onMounted(() => {

    const resp = fetch('http://localhost:5000', {mode: 'cors'})
    .then((res) => {
        if(!res.ok) {
            throw Error('Could not retrieve persons data')
        }
        return res.json()
    })
    .then((data) => {
        state.persons = data
        console.log("persons is ", state.persons)})
    .catch((e) => console.log(e))
})

</script>

<template>
    <h1>Persons!</h1>
    
    <!-- pass in persons name and link as props -->
    <div>
        <button v-for="person in state.persons" :key="person.name">{{ person.name }}</button>
    </div>

</template>
