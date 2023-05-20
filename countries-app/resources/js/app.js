import { createApp } from 'vue';
import CountrySearch from './components/CountrySearch.vue';
import EconomicSearch from './components/EconomicSearch.vue';

createApp({
    components: {
        CountrySearch,
        EconomicSearch
    }
}).mount('#app');
