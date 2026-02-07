<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-200 p-6">
    <div class="max-w-md w-full text-center bg-white rounded-2xl shadow-xl p-10">
      
      <!-- Icon -->
      <div class="mx-auto mb-6 w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">
        <span class="text-4xl">🚧</span>
      </div>

      <!-- Title -->
      <h1 class="text-7xl font-extrabold text-gray-800 tracking-tight">
        404
      </h1>

      <p class="mt-4 text-gray-600">
        Oops! This page took a wrong turn and disappeared.
      </p>

      <!-- Divider -->
      <div class="my-6 h-px bg-gray-200"></div>

      <!-- Actions -->
      <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <RouterLink
          to="/material"
          class="px-6 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition"
        >
          Go to Material
        </RouterLink>

        <button
          @click="$router.back()"
          class="px-6 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
        >
          Go Back
        </button>
      </div>

      <!-- Footer hint -->
      <p class="mt-6 text-xs text-gray-400">
        If you believe this is an error, please contact the system administrator.
      </p>
    </div>
  </div>
</template>

<script setup>
</script>
