import { createRouter, createWebHistory } from 'vue-router';

import PageNotFound from '../components/material/layout/PageNotFound.vue';
import material from '../components/material/form.vue';

const routes = [
  {
    path: '/:pathMatch(.*)*',
    name: 'PageNotFound',
    component: PageNotFound,
  },
  {
    path: '/material',
    name: 'material',
    component: material,
  }
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
