<script setup>

import { defineProps, inject } from 'vue';

const props = defineProps({
    result: Object
})

const reset = inject('reset')

</script>

<template>
    <div class="row my-4">
        <div class="col-12 justify-content-center">
            <h2 class="text-center">
                <strong>
                    {{ result.correct ? 'Correct!' : 'Wrong...' }}
                </strong>
            </h2>
        </div>
    </div>
    <div class="row mt-4 mb-1">
        <div class="col-12">
            <p class="text-center">
                <em>
                    "{{ result.quote }}"
                </em>
            </p>
        </div>
    </div>
    <div class="row pe-1">
        <div class="col-12">
            <p class="text-end fw-bolder">
                <span v-if="!result.correct">is by</span>
                {{ result.person }}
            </p>
        </div>
    </div>
    <div class="row justify-content-center mt-4 mb-1">
        <div class="col-12">
            <button @click="reset" class="w-100 btn btn-primary">Try again</button>
        </div>
    </div>   
    
</template>

