<script setup>

import fetchHandler from './Fetch.vue';

import quoteUpper from '@/assets/images/quote-mark-upper.webp';
import quoteLower from '@/assets/images/quote-mark-lower.webp';


import { defineProps, onMounted, reactive } from 'vue';

const props = defineProps({
        persons: Array,
    })

const state = reactive({
                  isLoading: true,
                  persons: props.persons, // allows img URL to be added. Means can avoid mutating prop
                  selectedPerson: {}, // name and URL
                  quote: "",
                  correctAns: null
    })

// Allows function in parent to be called
const emit = defineEmits(['clickHandler']);

const handleAnswer = (name) => {

        // Check whether answer is correct and set value
        name == state.selectedPerson.name ? state.correctAns = true : state.correctAns = false;

        // Results to be shown
        emit('clickHandler', { correct: state.correctAns, 
                               person: state.selectedPerson.name,
                               quote: state.quote
                              })
};

onMounted(()=> {

  // Randomly select person from persons array
  state.selectedPerson = props.persons[(Math.floor(Math.random() * props.persons.length))];

  // Get quote
  fetchHandler(`/?q=challenge&p=${state.selectedPerson.url}`)
              .then((quote) => {
                state.isLoading = false,
                state.quote = quote
              });
});

</script>

<template>

    <!-- Quote area -->
    <div id="display-area">

        <div class="row d-flex justify-content-start">
            <img :src="quoteUpper" :class="{'quote-img': true, 'spin-quotes': state.isLoading }"
                                    alt="image of quotation mark">
        </div>
    
        <p class="m-0 py-3"> {{ state.quote }} </p>

        <div class="row d-flex justify-content-end">
            <img :src="quoteLower" :class="{'quote-img': true, 'spin-quotes': state.isLoading }"
                                   alt="image of quotation mark">
        </div>

    </div>

    <!-- Person buttons -->
    <div v-if="!state.isLoading" class="row">
        <div v-for="person in persons" 
                    :key="person.name" 
                    :person="person" 
                    class="col-6 d-flex justify-content-center">
                    
                    <div class="row">
                      <button @click="handleAnswer(person.name)" style="width: 100%"
                              class="btn btn-outline-dark">

                          {{ person.name }}

                      </button> 

                    </div>
         </div>
    </div>
    
</template>

<style scoped>

p {
  font-size: 1.25rem;
  font-weight: 700;
}

/* Spinning quotation marks efffect */

  @keyframes spin-quotes {
    0% {
      transform: rotateY(0deg);
    }
    90% {
      transform: rotateY(360deg);
    }
    100% {
      transform: rotateY(360deg);
    }
  }

  .quote-img {
      max-width: 7rem;
  }

  #display-area {
      margin: 1rem 0rem 1rem 0rem;
  }

  .spin-quotes {
    animation: spin-quotes 2s linear infinite;
    transform-style: preserve-3d; /* Ensure 3D transformation is enabled */
  }

  button {
    font-family: monospace;
    font-size: 1.2rem;
    width: 200px;
    padding: 0.5rem;
    margin: 0.35rem;
}

</style>

