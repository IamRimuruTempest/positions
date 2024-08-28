<script setup>
import { defineProps, defineEmits } from 'vue';
import { ref, onMounted, watch } from 'vue';
const supervisors = ref([]);
const error = ref(null);
import axios from 'axios';

const props = defineProps({
    isModalShow: {
        type: Boolean,
        required: true,
    },

    showPosition: {
        type: Object
    },
})

const newPosition = ref();


const emit = defineEmits(['update:isModalOpen']);

watch(() => props.showPosition, (current) => {
    if (current) {
        newPosition.value = { ...current };
    }
}, { immediate: true });

const closeModal = () => {
    emit('update:isModalShow', false);
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
                            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">View
                                Position </h3>

                            <div class="mt-2">
                                <h1>Position: {{ newPosition }}</h1>
                                <h1>Position:</h1>


                            </div>
                        </div>

                        <button @click="closeModal" type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>

                    </div>

                </div>
            </div>
        </div>
    </div>


</template>