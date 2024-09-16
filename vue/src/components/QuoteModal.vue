<script setup>

    import { defineProps, onMounted, reactive } from 'vue';
    import DisplayQuote from './DisplayQuote.vue';
    import DisplayResult from './DisplayResult.vue';

    // console.log("QUOTE MODAL HERE")

    const props = defineProps({
        persons: Array
    });

    const emit = defineEmits(['dismissModal']);
  
    const state = reactive({
                isModalVisible: false, // Must be set to trigger modal in BSVue3
                showQuote: true,       // Show quote first
                showResult: false,     // Updated by handleResult
                result: {}             
    });

    const handleResult = (result)=> {
            console.log("Result received", result)
            state.result = result; // Result (true or false, quote, and name)
            state.showQuote = false,
            state.showResult = true
    };

    onMounted(() => {
        // Only way to get the modal to render was to create a state change
        state.isModalVisible = true;
    });

   
</script>

<template>

    <!-- BootstrapVue 3 Modal! -->   
                                            <!-- event fired when modal is dismissed        -->
    <b-modal v-model="state.isModalVisible" @hidden="emit('dismissModal')" hide-footer>

         <div class="modal-body">

            <DisplayQuote v-if="state.showQuote" 
                                        :persons="props.persons"
                                        @clickHandler="handleResult"/>

            <DisplayResult v-if="state.showResult"
                                 :result="state.result"/>
        </div>
        
    </b-modal>
 
</template>

<style scoped>

.modal-body {
    background-color: #8bdbec;
}

#display-area {
    margin: 1rem 0rem 1rem 0rem;
}

</style>