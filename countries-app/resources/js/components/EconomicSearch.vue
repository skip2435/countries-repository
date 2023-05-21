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
        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
            <!-- Economic Data Search Section -->
            <div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md flex items-center space-x-4">
                <div class="text-center w-full">
                    <div class="font-semibold text-xl mb-4">Economic Data Search</div>

                    <div class="mb-4">
                        <input v-model="countryName" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" placeholder="Enter country name...">
                        <button @click="searchEconomicData" class="mt-2 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button>
                    </div>

                    <div v-if="economicData" class="space-y-6">
                        <div v-for="entry in economicData" :key="entry.year" class="border rounded-lg shadow-sm p-4">
                            <div class="text-lg font-semibold mb-2">Year: {{ entry.year }}</div>
                            <dl class="space-y-2">
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">GDP per capita (current US$):</dt>
                                    <dd>{{ entry.gdpPerCapita }}</dd>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">Total GDP (current US$):</dt>
                                    <dd>{{ entry.totalGdp }}</dd>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">Unemployment Rate (%):</dt>
                                    <dd>{{ entry.unemploymentRate }}</dd>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">Inflation Rate (%):</dt>
                                    <dd>{{ entry.inflationRate }}</dd>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">Interest Rate (%):</dt>
                                    <dd>{{ entry.interestRate }}</dd>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <dt class="font-semibold">Income Inequality (GINI Index):</dt>
                                    <dd>{{ entry.incomeInequality }}</dd>
                                </div>
                            </dl>
                        </div>
                        </div>

<div v-if="error" class="p-4 bg-red-100 border-2 border-red-400 rounded">{{ error }}</div>
</div>
</div>

<!-- Country Codes Section -->
<div class="max-w-md mx-auto p-6 bg-white rounded-xl shadow-md items-center space-x-4" v-if="showCountryCodes">
<h2 class="font-bold mb-2 text-lg text-center">World Bank Country Codes:</h2>
<button @click="toggleCountryCodes" class="mb-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
Hide Country Codes
</button>
<div class="overflow-auto h-64 border rounded-lg p-4 bg-gray-100">
<table class="table-auto w-full">
    <thead>
        <tr>
            <th class="px-4 py-2">Code</th>
            <th class="px-4 py-2">Country</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(country, index) in countryCodes" :key="index">
            <td class="border px-4 py-2">{{ country.id }}</td>
            <td class="border px-4 py-2">{{ country.name }}</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<!-- Toggle Button -->
<button @click="toggleCountryCodes" class="mt-4 w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" v-if="!showCountryCodes">
Show Country Codes
</button>
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
countryCodes: null,
error: null,
showCountryCodes: false
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
},
getCountryCodes() {
axios.get('https://api.worldbank.org/v2/country/?format=json')
.then(response => {
this.countryCodes = response.data[1]; // Grab the second element of the array
})
.catch(error => {
this.countryCodes = null;
});
},
toggleCountryCodes() {
this.showCountryCodes = !this.showCountryCodes;
}
},
mounted() {
this.getCountryCodes();
},
}
</script>

