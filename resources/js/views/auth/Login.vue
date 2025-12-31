<script setup>
import { ref, reactive } from 'vue';
import useAuth from '../../composables/auth.js';

const { error, is_loading, login } = useAuth();

const form = reactive({
    username: '',
    password: ''
});

const visible = ref(false);

const handleSubmit = async () => {
    await login({ ...form });
}

// Handle Enter key press
const handleKeyPress = (event) => {
    if (event.key === 'Enter' && form.username && form.password) {
        handleSubmit();
    }
}
</script>

<template>
    <v-container fluid class="fill-height">
        <v-row class="fill-height" justify="center" align="center">
            <!-- Login Form Section - Full Width -->
            <v-col cols="12" sm="8" md="6" lg="4" class="d-flex align-center justify-center">
                <v-card
                    class="login-card mx-auto"
                    elevation="8"
                    max-width="400"
                    rounded="lg"
                >
                    <!-- ZCWD Logo -->
                    <div class="text-center mb-8">
                        <v-img
                            src="https://zcwd.gov.ph/wp-content/uploads/2024/10/ZCWD-Logo-50th-Optimized.png"
                            max-width="100"
                            class="mx-auto mb-4"
                        ></v-img>
                        <h2 class="text-h5 font-weight-bold primary--text">
                            ZCWD Property Management
                        </h2>
                         <h1 class="text-h5 font-weight-bold primary--text mb-2">
                            Welcome Back
                        </h1>
                
                    </div>

                    <!-- Error Message -->
                    <v-alert
                        v-if="error"
                        type="error"
                        variant="tonal"
                        density="compact"
                        class="mb-4"
                        closable
                    >
                        {{ error.message }}
                    </v-alert>

                    <!-- Login Form -->
                    <v-form @submit.prevent="handleSubmit">
                        <!-- Username Field -->
                        <v-text-field
                            v-model="form.username"
                            label="Username"
                            placeholder="Enter your username"
                            prepend-inner-icon="mdi-account-outline"
                            variant="outlined"
                            density="comfortable"
                            class="mb-4"
                            :rules="[v => !!v || 'Username is required']"
                            required
                        ></v-text-field>

                        <!-- Password Field -->
                        <v-text-field
                            v-model="form.password"
                            :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                            :type="visible ? 'text' : 'password'"
                            label="Password"
                            placeholder="Enter your password"
                            prepend-inner-icon="mdi-lock-outline"
                            variant="outlined"
                            density="comfortable"
                            class="mb-2"
                            :rules="[v => !!v || 'Password is required']"
                            @keyup="handleKeyPress"
                            required
                        ></v-text-field>

                        <!-- Forgot Password -->
                        <div class="text-right mb-6">
                            <v-btn
                                variant="text"
                                color="primary"
                                size="small"
                                class="text-caption"
                            >
                                Forgot Password?
                            </v-btn>
                        </div>

                        <!-- Login Button -->
                        <v-btn
                            color="primary"
                            size="large"
                            variant="flat"
                            block
                            type="submit"
                            :loading="is_loading"
                            :disabled="!form.username || !form.password"
                            class="mb-6"
                            elevation="2"
                        >
                            <v-icon left>mdi-login</v-icon>
                            Sign In
                        </v-btn>
                    </v-form>

                    <!-- Footer -->
                    <v-divider class="my-4"></v-divider>
                    <div class="text-center">
                        <p class="text-caption text-grey">
                            © 2024 Zamboanga City Water District
                        </p>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped>
.fill-height {
    height: 100vh;
}

.login-card {
    padding: 40px 32px;
    background: white;
}

.primary--text {
    color: #0c3c60 !important;
}

/* Animation for login card */
.login-card {
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .login-card {
        padding: 32px 24px;
        margin: 16px;
        max-width: 100%;
    }
}

/* Background styling */
:deep(.v-container) {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

/* Enhanced form field styling */
:deep(.v-field) {
    border-radius: 8px !important;
}

:deep(.v-field--focused) {
    border-color: #0c3c60 !important;
}

/* Button styling */
:deep(.v-btn--variant-flat) {
    border-radius: 8px;
}
</style>