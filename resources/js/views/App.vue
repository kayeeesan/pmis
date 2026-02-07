<!-- resources/js/views/App.vue -->
<script setup>
import { ref } from 'vue';
import Sidebar from '../components/layout/Sidebar.vue';
import Header from '../components/layout/Header.vue';

// Sidebar state
const sidebarCollapsed = ref(false);
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Sidebar -->
    <Sidebar :collapsed="sidebarCollapsed" />
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Header -->
      <Header @toggle-sidebar="sidebarCollapsed = !sidebarCollapsed" />
      
      <!-- Page Content -->
      <main class="flex-1 p-6 overflow-auto">
        <router-view />
      </main>
      
      <!-- Footer -->
      <footer class="bg-white border-t px-6 py-4 text-center text-gray-500 text-sm">
        © {{ new Date().getFullYear() }} PMIS v1.0
      </footer>
    </div>
  </div>
</template>