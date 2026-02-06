<template>
  <div class="p-8 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Button System Test</h1>
    
    <!-- Section 1: Basic Buttons -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">1. Basic Button Variants</h2>
      <div class="flex flex-wrap gap-3">
        <button class="btn btn-primary">Primary</button>
        <button class="btn btn-secondary">Secondary</button>
        <button class="btn btn-success">Success</button>
        <button class="btn btn-danger">Danger</button>
        <button class="btn btn-cancel">Cancel</button>
      </div>
    </div>
    
    <!-- Section 2: Cancel Button Examples -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">2. Cancel Button Examples</h2>
      
      <!-- Example 1: Form with Cancel/Submit -->
      <div class="card p-6 mb-6">
        <h3 class="font-medium mb-4">Form Example</h3>
        <div class="space-y-4">
          <div>
            <label class="block mb-2">Email Address</label>
            <input type="email" class="w-full p-2 border rounded" placeholder="you@example.com">
          </div>
          <div>
            <label class="block mb-2">Message</label>
            <textarea class="w-full p-2 border rounded" rows="3" placeholder="Your message..."></textarea>
          </div>
          <div class="flex gap-3 pt-2">
            <button class="btn btn-primary flex-1">Submit</button>
            <button class="btn btn-cancel">Cancel</button>
          </div>
        </div>
      </div>
      
      <!-- Example 2: Different Cancel Styles -->
      <div class="card p-6">
        <h3 class="font-medium mb-4">Cancel Button Variations</h3>
        <div class="flex flex-wrap gap-3">
          <button class="btn btn-cancel">Default Cancel</button>
          <button class="btn btn-outline btn-outline-cancel">Outline Cancel</button>
          <button class="btn btn-cancel btn-sm">Small Cancel</button>
          <button class="btn btn-cancel btn-lg">Large Cancel</button>
          <button class="btn btn-cancel btn-block">Full Width Cancel</button>
        </div>
      </div>
    </div>
    
    <!-- Section 3: Dialog/Modal Example -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">3. Dialog/Modal Example</h2>
      <div class="card p-6">
        <div class="text-center mb-6">
          <h3 class="text-lg font-medium mb-2">Delete Confirmation</h3>
          <p class="text-gray-600">Are you sure you want to delete this item? This action cannot be undone.</p>
        </div>
        <div class="flex justify-center gap-3">
          <button class="btn btn-danger">Delete</button>
          <button class="btn btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
    
    <!-- Section 4: Comparison -->
    <div class="mb-8">
      <h2 class="text-xl font-semibold mb-4">4. Comparison with Regular Buttons</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-3">
          <h3 class="font-medium">Custom .btn Classes</h3>
          <button class="btn btn-cancel">.btn-cancel</button>
          <button class="btn btn-outline btn-outline-cancel">.btn-outline-cancel</button>
          <button class="btn btn-secondary">.btn-secondary (for comparison)</button>
        </div>
        <div class="space-y-3">
          <h3 class="font-medium">Raw Tailwind Classes</h3>
          <button class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Manual Cancel
          </button>
          <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-100">
            Manual Outline
          </button>
          <button class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
            Manual Secondary
          </button>
        </div>
      </div>
    </div>
    
    <!-- Section 5: Button States -->
    <div>
      <h2 class="text-xl font-semibold mb-4">5. Button States</h2>
      <div class="flex flex-wrap gap-3">
        <button class="btn btn-cancel">Normal</button>
        <button class="btn btn-cancel hover:scale-105 transform transition-transform">Hover Effect</button>
        <button class="btn btn-cancel opacity-50 cursor-not-allowed">Disabled</button>
        <button class="btn btn-cancel animate-pulse">Loading...</button>
      </div>
    </div>
  </div>
</template>

<script setup>
// No JavaScript needed for this example
</script>

<style>
/* Card style for examples */
.card {
  @apply bg-white rounded-lg shadow-sm border border-gray-200;
}

/* If you want to add some animations */
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.animate-pulse {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>