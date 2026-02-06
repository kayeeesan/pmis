<template>
  <div class="p-8 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Button System Test</h1>

    <div class="flex flex-wrap gap-3">
      <button class="btn btn-primary">Primary</button>
      <button class="btn btn-secondary">Secondary</button>
      <button class="btn btn-success">Success</button>
      <button class="btn btn-danger">Danger</button>
      <button class="btn btn-cancel">Cancel</button>
    </div>

    <!-- Outline buttons -->
    <div class="flex flex-wrap gap-3 mt-6">
      <button class="btn btn-outline btn-outline-primary">Outline Primary</button>
      <button class="btn btn-outline btn-outline-cancel">Outline Cancel</button>
    </div>

    <!-- Sizes -->
    <div class="flex flex-wrap gap-3 mt-6">
      <button class="btn btn-cancel btn-sm">Small</button>
      <button class="btn btn-cancel">Normal</button>
      <button class="btn btn-cancel btn-lg">Large</button>
      <button class="btn btn-cancel btn-block">Full Width</button>
    </div>

    <!-- States -->
    <div class="flex flex-wrap gap-3 mt-6">
      <button class="btn btn-cancel">Normal</button>
      <button class="btn btn-cancel hover:scale-105 transform transition-transform">Hover Effect</button>
      <button class="btn btn-cancel opacity-50 cursor-not-allowed">Disabled</button>
      <button class="btn btn-cancel animate-pulse">Loading...</button>
    </div>
  </div>
</template>

<script setup>
// No JS needed
</script>

<!-- No <style> here at all! -->
