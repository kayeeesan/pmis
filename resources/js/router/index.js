import { createRouter, createWebHistory } from 'vue-router';

import material from '../components/material/form.vue';

const routes = [
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
