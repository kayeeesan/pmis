<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import Sidebar from "../components/layouts/Sidebar.vue";
import useAuth from "../composables/auth.js";
import store from "@/store";

const { logout } = useAuth();
const user = store.state.auth.user;

// Removed drawer toggle logic since sidebar auto-hovers
const cleanUpExpiredItems = () => {
    const expiry = localStorage.getItem("expiry");

    if (!expiry) {
        return null;
    }

    const now = new Date();

    if (now.getTime() > expiry) {
        logout();
        return null;
    }
};

let interval;

onMounted(() => {
    interval = setInterval(cleanUpExpiredItems, 28800000); // Check every 8 hours
});

onUnmounted(() => {
    clearInterval(interval);
});
</script>

<template>
    <v-app>
        <sidebar />

        <v-app-bar app color="white" elevation="2">
            <!-- Removed app-bar-nav-icon -->
            <v-toolbar-title class="d-flex align-center">
                <span class="text-h6 font-weight-medium primary--text">ZCWD PMIS</span>
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
            
            <!-- User Info -->
            <div class="d-flex align-center mr-4">
                <v-avatar size="36" color="blue-lighten-5" class="mr-2">
                    <v-icon icon="mdi-account" color="blue-darken-3"></v-icon>
                </v-avatar>
                <div class="text-right">
                    <div class="text-subtitle-2 font-weight-medium">{{ user?.full_name || 'Guest' }}</div>
                    <div class="text-caption text-grey">{{ user?.roles?.[0]?.name || '' }}</div>
                </div>
            </div>
            
            <v-divider vertical inset class="mx-3"></v-divider>
            
            <!-- Logout Button -->
            <v-btn 
                icon 
                variant="text" 
                color="red-darken-1"
                title="Logout"
                @click="logout()"
            >
                <v-icon>mdi-logout</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main>
            <v-container fluid class="pa-6">
                <router-view />
            </v-container>
            
            <!-- Footer -->
            <v-footer app inset color="transparent" height="40" class="px-4">
                <v-spacer></v-spacer>
                <div class="text-caption text-grey">
                    © 2024 Zamboanga City Water District - PMIS v1.0
                </div>
                <v-spacer></v-spacer>
            </v-footer>
        </v-main>
    </v-app>
</template>

<style scoped>
.primary--text {
    color: #0c3c60 !important;
}

.notification-badge {
    position: absolute;
    top: 8px;
    right: 8px;
}

.v-app-bar {
    border-bottom: 1px solid #e0e0e0 !important;
}

.v-container {
    max-width: 1400px;
}

.v-footer {
    border-top: 1px solid #e0e0e0;
}
</style>