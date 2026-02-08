<script setup>
import { ref } from 'vue'
import Sidebar from '../components/layout/Sidebar.vue'
import Header from '../components/layout/Header.vue'

const sidebarCollapsed = ref(false)
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex">
    <Sidebar :collapsed="sidebarCollapsed" />

    <div class="flex-1 flex flex-col">
      <Header @toggle-sidebar="sidebarCollapsed = !sidebarCollapsed" />

      <main class="flex-1 p-6 overflow-auto">
        <router-view />
      </main>

      <footer class="bg-white border-t px-6 py-4 text-center text-gray-500 text-sm">
        © {{ new Date().getFullYear() }} PMIS v1.0
      </footer>
    </div>
  </div>
</template>
