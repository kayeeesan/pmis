import { createRouter, createWebHistory } from 'vue-router';

import Home from '../components/layout/Home.vue';
import PageNotFound from '../components/layout/PageNotFound.vue';
import material from '../components/material/form.vue';

const routes = [
  
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/material',
    name: 'material',
    component: material,
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'PageNotFound',
    component: PageNotFound,
  },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
