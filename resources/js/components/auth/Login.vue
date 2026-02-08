<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import useAuth from '../../composables/auth.js';

const router = useRouter();
const { login, is_loading, error } = useAuth();

const credentials = ref({
    username: '',
    password: ''
});

const handleLogin = async () => {
    try {
        await login(credentials.value);
        // Login successful - router will redirect via beforeEach guard
    } catch (err) {
        // Error is already handled in the composable
    }
};

// Handle Enter key press
const handleKeyPress = (event) => {
    if (event.key === 'Enter') {
        handleLogin();
    }
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-100 p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg border border-gray-200">
            <!-- Header -->
            <div class="px-6 py-8 text-center border-b">
                <h1 class="text-2xl font-bold text-gray-800">ZCWD PMIS</h1>
                <p class="text-gray-600 mt-1">Please login to continue</p>
            </div>
            
            <!-- Form -->
            <div class="px-6 py-8">
                <form @submit.prevent="handleLogin" class="space-y-5">
                    <!-- Error Message -->
                    <div 
                        v-if="error" 
                        class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded"
                    >
                        {{ error.message || 'Invalid credentials' }}
                    </div>

                    <!-- Username Field -->
                    <div class="space-y-2">
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <input
                            id="username"
                            v-model="credentials.username"
                            type="text"
                            placeholder="Enter your username"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            :disabled="is_loading"
                            autofocus
                        />
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input
                            id="password"
                            v-model="credentials.password"
                            type="password"
                            placeholder="Enter your password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            :disabled="is_loading"
                            @keypress="handleKeyPress"
                        />
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        :disabled="is_loading || !credentials.username || !credentials.password"
                        class="btn btn-primary btn-block mt-2"
                    >
                        <span v-if="is_loading" class="flex items-center justify-center">
                            <svg class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Logging in...
                        </span>
                        <span v-else>Login</span>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 border-t text-center text-sm text-gray-500 bg-gray-50 rounded-b-lg">
                <p>Zamboanga City Water District</p>
                <p class="mt-1">Property Management Information System</p>
            </div>
        </div>
    </div>
</template>