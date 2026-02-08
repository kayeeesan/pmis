

import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import router from './router/index.js';
import store from './store/index.js';
import "../css/app.css";
import VueMultiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css';

import PrimeVue from 'primevue/config';
import Lara from '@primevue/themes/lara';
import 'primeicons/primeicons.css';

import axios from "axios";
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

const app = createApp({});
app.use(router)
app.use(PrimeVue, {
    theme: {
        preset: Lara
    }
});
app.use(store)
app.component('VueMultiselect', VueMultiselect);
app.mount('#app')