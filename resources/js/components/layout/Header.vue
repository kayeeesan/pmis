<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'
import useAuth from '@/composables/auth'

defineEmits(['toggle-sidebar'])

const store = useStore()
const { logout, is_loading } = useAuth()

const user = computed(() => store.state.auth.user)

const fullName = computed(() => {
  if (!user.value) return ''
  return (
    user.value.full_name ||
    `${user.value.first_name ?? ''} ${user.value.last_name ?? ''}`.trim()
  )
})
</script>

<template>
  <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
    <!-- Left -->
    <button
      @click="$emit('toggle-sidebar')"
      class="btn btn-secondary"
    >
      ☰
    </button>

    <!-- Right -->
    <div class="flex items-center gap-4">
      <!-- Username -->
      <span class="text-sm text-gray-700 font-medium">
        👋 {{ fullName || user?.username }}
      </span>

      <!-- Logout -->
      <button
        @click="logout"
        :disabled="is_loading"
        class="btn btn-danger"
      >
        Logout
      </button>
    </div>
  </header>
</template>
