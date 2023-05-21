import { createApp } from 'vue';
import CountrySearch from './components/CountrySearch.vue';
import EconomicSearch from './components/EconomicSearch.vue';
import SafetySearch from './components/SafetySearch.vue';

createApp({
    components: {
        CountrySearch,
        EconomicSearch,
        SafetySearch
    }
}).mount('#app');
