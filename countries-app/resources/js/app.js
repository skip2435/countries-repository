import './bootstrap';

import { createApp } from 'vue';
import CountrySearch from './components/CountrySearch.vue';

createApp({
    components: {
        CountrySearch
    }
}).mount('#app');
