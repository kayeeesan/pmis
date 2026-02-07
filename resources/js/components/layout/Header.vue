<!-- resources/js/components/layout/Header.vue -->
<script setup>
import { ref } from 'vue';

defineEmits(['toggle-sidebar']);

// User dropdown state
const showDropdown = ref(false);

// Close dropdown when clicking outside
const closeDropdown = () => {
  showDropdown.value = false;
};
</script>

<template>
  <header class="header">
    <div class="px-6 py-4 flex items-center justify-between">
      <!-- Left side -->
      <div class="flex items-center gap-4">
        <button 
          @click="$emit('toggle-sidebar')"
          class="p-2 hover:bg-gray-100 rounded-lg"
        >
          <i class="pi pi-bars text-xl"></i>
        </button>
        <h1 class="text-xl font-semibold text-gray-800">PMIS</h1>
      </div>
      
      <!-- Right side -->
      <div class="flex items-center gap-4">
        <!-- User info -->
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="pi pi-user text-blue-600"></i>
          </div>
          <div class="text-left">
            <p class="font-medium">Admin User</p>
            <p class="text-sm text-gray-500">Administrator</p>
          </div>
        </div>
        
        <!-- Divider -->
        <div class="h-8 w-px bg-gray-300"></div>
        
        <!-- Logout button -->
        <button class="p-2 hover:bg-red-50 rounded-lg">
          <i class="pi pi-sign-out text-red-600 text-xl"></i>
        </button>
      </div>
    </div>
  </header>
</template>