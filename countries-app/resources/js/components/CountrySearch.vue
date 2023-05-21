<template>
  <div class="min-h-screen bg-gradient-to-r from-blue-500 to-indigo-600 flex flex-col justify-between">
    <!-- Navbar -->
    <nav class="w-full bg-indigo-600 bg-opacity-50 py-2 sticky top-0">
      <div class="w-full md:w-2/3 xl:w-1/2 2xl:w-1/3 flex justify-around text-white text-lg font-bold mx-auto">
      <a href="/search" class="hover:text-gray-300 hover:underline">Search</a>
<a href="/economics" class="hover:text-gray-300 hover:underline">Economics</a>
    <a href="/safety" class="hover:text-gray-300 hover:underline">Safety</a>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Content -->
    <div class="flex items-center justify-center h-screen">
      <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md flex items-center space-x-4">
        <div class="text-center w-full">
          <div class="font-semibold text-xl mb-4">Country Search</div>

          <div class="mb-4">
            <input v-model="countryName" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" placeholder="Enter country name..." />
            <button @click="searchCountry" class="mt-2 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
          </div>

          <div v-if="country" class="p-4 bg-green-100 border-2 border-green-400 rounded">
          <div><strong>Name:</strong> {{ country.name }}</div>
                    <div><strong>Capital:</strong> {{ country.capital }}</div>
                    <div><strong>Region:</strong> {{ country.region }}</div>
                    <div><strong>Subregion:</strong> {{ country.subregion }}</div>
                    <div><strong>Population:</strong> {{ country.population }}</div>
                    <div><strong>Currencies:</strong> {{ country.currencies }}</div>
            <div class="mt-4">
            <img :src="country.flag" alt="" class="mx-auto h-20">
            </div>
          </div>

          <div v-if="error" class="p-4 bg-red-100 border-2 border-red-400 rounded">{{ error }}</div>
        </div>
      </div>
    </div>
    <!-- End Main Content -->
  </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            countryName: '',
            country: null,
            error: null,
        }
    },
    methods: {
        searchCountry() {
            axios.get('/api/countries/' + this.countryName)
                .then(response => {
                    this.country = response.data;
                    this.error = null;
                })
                .catch(error => {
                    this.country = null;
                    this.error = 'Country not found';
                });
        }
    }
}
</script>
