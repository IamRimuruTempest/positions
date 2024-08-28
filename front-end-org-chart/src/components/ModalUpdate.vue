<script setup>
import { defineProps, defineEmits } from 'vue';
import { ref, onMounted, watch } from 'vue';
const supervisors = ref([]);
const error = ref(null);
import axios from 'axios';

const props = defineProps({
    isModalUpdate: {
        type: Boolean,
        required: true,
    },
    fetchPositions: {
        type: Function,
        required: true,
    },
    currentPosition: {
        type: Object
    },
    positions: {
        type: Array,
        required: true,
    },
})

const newPosition = ref({});


const emit = defineEmits(['update:isModalUpdate']);

const updatePosition = async () => {
    try {

        await axios.put(`http://localhost:8000/api/v1/positions/${props.currentPosition.id}`, newPosition.value);

        // Reset the form and close the modal
        newPosition.value = {};
        closeModal();

        // Fetch the updated positions
        props.fetchPositions();
    } catch (err) {
        error.value = err;
        console.error('There was an error updating the position!', err);
    }
};





onMounted(() => {
    supervisors.value = props.positions
    newPosition.value = props.currentPosition;
    console.log(props.currentPosition);
    console.log(props.positions);

});



const closeModal = () => {
    emit('update:isModalUpdate', false);
};
</script>
<template>


    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">


                        <div class="text-center  sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Update
                                Position </h3>



                            <div class="mt-2">
                                <form @submit.prevent="updatePosition()" class="">
                                    <div class="mb-3">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Position</label>
                                        <input type="text" v-model="newPosition.position"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            required />
                                    </div>

                                    <div class="relative z-0 w-full mb-3 group">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Report To</label>
                                        <select v-model="newPosition.reports_to"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option selected value="">Select Supervisor</option>
                                            <option v-for="supervisor in supervisors" :key="supervisor.id"
                                                :value="supervisor.id"
                                                :disabled="supervisor.position === newPosition.position"> {{
                                                    supervisor.position
                                                }}
                                            </option>
                                        </select>


                                    </div>



                                    <div class=" py-3 sm:flex sm:flex-row-reverse ">
                                        <button type="submit"
                                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">Update</button>
                                        <button @click="closeModal" type="button"
                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


</template>