<script setup>

const props = defineProps({
    person: Object,
    selected: Boolean
});

// Passing the funtion name is not necessary, but helps with errors at runtime
const emit = defineEmits(['testFunc'])

// const handler = () => {
//     console.log('clickd')
// }

</script>
<template>       
    <!-- Click event calls function on parent component, which in turn calls function in its script
    Long-winded, but this is the standard approach        -->
                        <!-- Pass the person name and URL as function argument -->
                         <!-- Class 'active' and 'disabled' added to highlight button once person is chosen - default behaviour is to do this for one button only  -->
    
    <button class="btn btn-outline-dark flex-fill mx-1" :class="{ active: selected}" 
            @click="emit('testFunc', props.person)">
        {{ props.person.name }}
    </button>
</template>

<style scoped>

button {
    font-family: monospace;
    font-size: 1rem;
    width: 8rem;
    padding: 0.5rem;
    margin: 0.65rem;
    /* white-space: nowrap */
}

</style>