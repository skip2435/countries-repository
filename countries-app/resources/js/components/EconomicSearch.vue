<template>
    <div class="min-h-screen bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center py-5 px-4 sm:px-6 lg:px-8">
        <!-- Navbar -->
        <nav class="w-full bg-indigo-600 bg-opacity-50 py-2 mb-16 fixed top-0">
            <div class="w-full md:w-2/3 xl:w-1/2 2xl:w-1/3 flex justify-around text-white text-lg font-bold mx-auto">
            <a href="/search" class="hover:text-gray-300 hover:underline">Search</a>
<a href="/economics" class="hover:text-gray-300 hover:underline">Economics</a>
    <a href="#" class="hover:text-gray-300 hover:underline">Safety</a>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md flex items-center space-x-4">
            <div class="text-center w-full">
                <div class="font-semibold text-xl mb-4">Economic Data Search</div>

                <div class="mb-4">
                    <input v-model="countryName" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" placeholder="Enter country name...">
                    <button @click="searchEconomicData" class="mt-2 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                </div>

                <div v-if="economicData" class="p-4 bg-green-100 border-2 border-green-400 rounded">
        <div v-for="entry in economicData" :key="entry.year">
            <strong>Year:</strong> {{ entry.year }}<br/>
            <strong>GDP per capita (current US$):</strong> {{ entry.gdpPerCapita }}
        </div>
    </div>

                <div v-if="error" class="p-4 bg-red-100 border-2 border-red-400 rounded">{{ error }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            countryName: '',
            economicData: null,
            error: null,
        }
    },
    methods: {
        searchEconomicData() {
            axios.get('/api/worldbank/' + this.countryName)
                .then(response => {
                    this.economicData = response.data;
                    this.error = null;
                })
                .catch(error => {
                    this.economicData = null;
                    this.error = 'Country not found';
                });
        }
    }
}
</script>
