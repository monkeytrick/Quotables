<script setup>

import { defineProps, watch } from 'vue';

const emit = defineEmits(['getQuote', 'removeSelected']);

const props = defineProps({
    persons: Array,
})

// Function to scroll to name display area when person is selected
const scrollToDisplay = ()=> {
    document.getElementById('persons-container').scrollIntoView({behaviour: 'smooth'})
}

// 'watch' monitors changes in props and triggers the function passed to it when a change occurs.
// Here, '{deep:true} ensures that when something is added or removed from the prop, the function is 
// triggered. Before adding this, that was not the case - the function was not fired.
watch(()=> props.persons, scrollToDisplay, { deep: true });

</script>

<template>
    <div id="persons-container" class="mt-5">
        
        <div class="container">   
            <div class="row p-3">              
                <div v-for="person in persons" key="person.name"
                            class="col-6 col-md-6 col-mb-3 p-3 d-flex justify-content-center align-items-center">
                            <p class="d-flex align-items-center mb-0 selected-name">
                                {{ person.name }}
                            </p>
                            <span>
                                <button @click="$emit('removeSelected', person.name)"
                                        type="button" id="dismiss" class="btn-close btn-close-white ms-2" 
                                        aria-label="Close">
                                </button>
                            </span>
                </div>
            </div>   
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div>
                    <button v-if="persons.length == 2"
                                    @click="emit('getQuote')"
                                    class="btn btn-dark justify-content-center w-100 w-lg-40">Get Quote</button>
                </div>
            </div>
        </div>
</div>

</template>

<style scoped>

body {
    background-color: cornsilk;
}

#persons-container {
    width: 100%;
    margin-left: 0rem;
    margin-right: 0rem;
    background-color: white;
}

.selected-name {
    font-family: 'Courier New', Courier, monospace;
    font-size: 2rem;
    font-weight: 600;
}

#dismiss {
    width: 10px; 
    height: 10px; 
    border-radius: 50%;
    background-color: white;    
}

</style>