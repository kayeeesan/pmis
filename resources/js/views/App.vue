<script setup>
</script>

<template>
  <div class="min-h-screen p-4">
    <!-- optional nav for testing -->
    <nav class="mb-6 space-x-4">
      <RouterLink to="/material" class="text-blue-600 underline">
        Material Form
      </RouterLink>
    </nav>

    <!-- THIS IS REQUIRED -->
    <router-view />
  </div>
</template>
