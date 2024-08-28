<script setup>
import ModalInsert from './components/ModalInsert.vue';
import ModalUpdate from './components/ModalUpdate.vue';
import ModalShow from './components/ModalShow.vue';
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const positions = ref([]);
const currentPosition = ref(null);
const showPosition = ref(null)

const supervisors = ref([]);
const title = "Hello";


const searchPosition = ref('')
const searchReportsTo = ref('')


const error = ref(null);
const success = ref(false);

const isModalInsert = ref(false);
const isModalUpdate = ref(false);
const isModalShow = ref(false);
const isInsert = ref(true);

const fetchPositions = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/v1/positions'); // Replace with your endpoint
    positions.value = response.data.data;

  } catch (err) {
    error.value = err;
    console.error('There was an error!', err);
  }
};

const fetchSinglePosition = async (position) => {
  try {
    await axios.put(`http://localhost:8000/api/v1/positions/${position.id}`);
    showPosition.value = response.data.data;

    console.log(showPosition.value);

  } catch (err) {
    error.value = err;
    console.error('There was an error!', err);
  }
};

const fetchSupervisors = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/v1/positions'); // Replace with your endpoint
    supervisors.value = response.data.data;

    // console.log(response.data.data);

  } catch (err) {
    error.value = err;
    console.error('There was an error!', err);
  }
};





const deletePosition = async (position) => {
  try {
    await axios.delete(`http://localhost:8000/api/v1/positions/${position}`); // Delete request
    fetchPositions();
    // fetchSupervisors();s
    // positions.value = positions.value.filter(position => position.id !== id); // Remove the deleted position from the list
  } catch (err) {
    error.value = err;
    console.error('There was an error deleting the position!', err);
  }
};


const editPosition = async (data) => {
  // tmp.value = data.id
  currentPosition.value = data

}



onMounted(() => {

  fetchPositions();
  fetchSupervisors();
});

const handleUpdateClick = (position) => {
  openUpdateModal();
  editPosition(position);
};

const handleShow = (position) => {
  fetchSinglePosition(position);
  openShowModal();
};

const openInsertModal = () => {
  isModalInsert.value = true
};

const openUpdateModal = () => {
  isModalUpdate.value = true
};

const openShowModal = () => {
  isModalShow.value = true
};



const filteredPositions = computed(() => {
  return positions.value.filter(position => {
    const matchPosition = position.position.toLowerCase().includes(searchPosition.value.toLowerCase())
    const matchReportsTo = !searchReportsTo.value || position.reports_to === searchReportsTo.value
    return matchPosition && matchReportsTo
  })
})







</script>

<template>

  <OrgChart />

  <!-- Blog Article -->
  <div class="content-center">
    <div class=" max-w-5xl px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
      <div class="max-w-4xl">
        <ModalShow v-model:isModalShow="isModalShow" v-if="isModalShow" :showPosition="showPosition" />
        <ModalInsert v-model:isModalInsert="isModalInsert" v-if="isModalInsert" :fetchPositions="fetchPositions" />
        <ModalUpdate v-model:isModalUpdate="isModalUpdate" v-if="isModalUpdate" :fetchPositions="fetchPositions"
          :currentPosition="currentPosition" />
        <!-- <TheWelcome /> -->
        <div class="w-full mb-10">
          <h1 class="text-3xl font-bold uppercase mb-3">
            Organizational Chart
          </h1>






          <div class="flex justify-between mb-4">
            <div class="flex gap-4">
              <input type="text" v-model="searchPosition" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40
 p-2.5 " />


              <select v-model="searchReportsTo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40
 p-2.5 ">
                <option selected>All Supervisor</option>
                <option v-for="supervisor in supervisors" :key="supervisor.id" :value="supervisor.id"> {{
                  supervisor.position
                  }}
                </option>
              </select>
            </div>

            <button @click="openInsertModal" type="submit"
              class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
              Create Position</button>
          </div>


          <div v-if="filteredPositions.length" class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg overflow-hidden dark:border-neutral-700">
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-bold text-gray-900 uppercase ">
                          Position</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-bold text-gray-900 uppercase ">
                          Reports To</th>

                        <th scope="col" class="px-6 py-3 text-end text-xs font-bold text-gray-900 uppercase ">
                          Action</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                      <tr v-for="position in filteredPositions" :key="position.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                          {{ position.position }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 "> <span
                            v-if="position.supervisor">
                            {{ position.supervisor.position }}
                          </span></td>

                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium space-x-4">
                          <button @click="handleShow(position)" type="button"
                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none ">Show</button>
                          <button @click="handleUpdateClick(position)" type="button"
                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none ">Update</button>
                          <button @click="deletePosition(position.id)" type="button"
                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 disabled:pointer-events-none ">Delete</button>
                        </td>
                      </tr>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div v-else>
            <p class="text-center text-red-600">No Available Position!</p>
          </div>






        </div>
      </div>
    </div>

  </div>










</template>

<style scoped></style>
