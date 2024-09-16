<script setup>

import { onMounted, reactive, provide } from 'vue';
import PersonButton from './PersonButton.vue';
import SelectedPersons from './SelectedPersons.vue';
import QuoteModal from './QuoteModal.vue';
import fetchHandler from './Fetch.vue';
import { VueSpinnerGrid } from 'vue3-spinners';

const state = reactive({

        persons: [],
        selectedPersons: [],
        isLoading: true,
        showSelected: false,
        showModal: false

}); 

const removeSelected = (name)=> {
    console.log('removed ', name)

    state.selectedPersons = state.selectedPersons.filter(p => p.name !== name);

    state.selectedPersons.length == 0 ? state.showSelected = false : state.showSelected = true;
}

const showModal = () => {
    // Remove person selection area
    // state.showSelected = false,
    state.showModal = true
    console.log("Quote called", state.showModal)
};

const handleReset = () => {
    console.log("reset called")
    state.selectedPersons = [];
    state.showModal = false
};

// Add person to selected array
const handleClick = (p) => {

    if(state.selectedPersons.length < 2) {
        // Prevent same name being added twice
        if(state.selectedPersons.length == 1 && state.selectedPersons[0].name == p.name) {
            return;
        }
        else {
            state.selectedPersons.push(p)
        }
    }

    // Show selected area with selected persons
    state.showSelected == false ? state.showSelected = true : state.showSelected == false

};

// Function to reset status in event user clicks outside or dismisses
// modal
const hideModal = ()=> {
    state.showModal = false;
}

// 'Provide' allows functions in parents to be passed to nested components
provide('reset', handleReset);

onMounted(() => {
    // Call to get persons data
    fetchHandler('/')
    .then(persons => {
         state.persons = persons
         state.isLoading = false
        })
});

</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center p-4">
                <header>
                    <h1 style=" font-family: 'Agbalumo', 'system-ui'; font-size: 6rem; font-weight: 400; font-style: normal " class="p-2">Quotable!</h1>
                </header>
            </div>
        </div>
    </div>

    <!-- Show spinner while loading -->
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <VueSpinnerGrid v-if="state.isLoading" size="120" color="black"/>
            </div>
        </div>
    </div>
    
    
    <QuoteModal v-if="state.showModal == true"
                      :persons="state.selectedPersons"
                      @dismissModal="hideModal"
                      @remove="removeSelected"    
    />

    <!-- Function below will be called in child component -->
    <SelectedPersons v-if="state.showSelected" 
                           :persons="state.selectedPersons"
                           @getQuote="showModal"
                           @removeSelected="removeSelected"
    />

    <!-- Function below (@testFunc="handleClick") will be called in child component -->
      <!-- Function that deletes within array when function is passed -->
    
    <b-container id="button-container">
        <div class="row justify-content-center text-center mb-4">
            <p v-if="!state.isLoading" class="typing fs-2 fw-bolder"><em>Select two speakers...</em></p>
        </div>
        
        <b-row class="justify-content-center">
            <b-col cols="6" md="4" v-for="person in state.persons" class="d-flex justify-content-center">

                <PersonButton   :key="person.name" :person="person"
                                :selected="state.selectedPersons.some(selected => selected.name == person.name) ? true : false"
                                @testFunc="handleClick"
            />

            </b-col>

        </b-row>
    </b-container>

</template>

<style>

body {
    background: url('../assets/images/background-paper.jpg');
}

#button-container {
    padding: 2rem;
}

@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}

  .typing {
    white-space: nowrap;
    color: black;
    overflow: hidden;
    margin: 0 auto;
    animation: 
      typing 3.2s steps(30, end),
      blink-caret .5s step-end infinite;
  }

  @media (max-width: 768px) {
  h1 {
    font-size: 4rem !important;
  }
}

</style>
