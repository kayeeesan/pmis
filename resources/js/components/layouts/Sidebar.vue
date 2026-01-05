<script setup>
import { ref, watch, reactive } from "vue";

const props = defineProps({
    drawer: {
        type: Boolean,
        default: false,
    },
});

const isHovering = ref(false);
const open = ref(true);

function onMouseEnter() {
  if (mode.rail) {
    isHovering.value = true;
    open.value = true;
    mode.rail = false;
  }
}

function onMouseLeave() {
  if (mode.rail === false && isHovering.value) {
    isHovering.value = false;
    mode.rail = true;
    open.value = true;
  }
}

const items = [
    { title: 'Dashboard', icon: 'mdi-view-dashboard', route: "/" }
];

const groups = reactive({
  libraries: true,
  files: false,
  assets: false,
});

const libraries = [
    { title: 'Users', icon: 'mdi-account-group', route: "/users" },
    { title: 'Roles', icon: 'mdi-shield-account', route: "/roles" },
    { title: 'Employees', icon: 'mdi-badge-account', route: "/employees" },
];

const files = [
    { title: 'Item Masterfile', icon: 'mdi-package-variant', route: "/items" },
    { title: 'Supplier Masterfile', icon: 'mdi-truck-delivery' },
    { title: 'Department Masterfile', icon: 'mdi-office-building' },
    { title: 'Section Masterfile', icon: 'mdi-home-group' },
    { title: 'Fixed Assets', icon: 'mdi-desk' },
    { title: 'Properties', icon: 'mdi-home-city' },
    { title: 'Asset Transfers', icon: 'mdi-swap-horizontal' },
    { title: 'Asset Maintenance', icon: 'mdi-tools' },
];



const mode = reactive({
  rail: true,
  temporary: false,
  floating: true,
  app: false,
});

watch(
    () => props.drawer,
    (value)  => {
        if (value) {
            open.value = true;
            mode.rail = false;
            mode.floating = false;
            mode.app = true;
            mode.temporary = false;
        } else {
            open.value = true;
            mode.rail = true;
            mode.floating = true;
            mode.app = false;
            mode.temporary = false;
        }
    },
    { immediate: true }
);
</script>

<template>
  <v-navigation-drawer
    v-model="open"
    :rail="mode.rail"
    :temporary="mode.temporary"
    :permanent="!mode.temporary"
    :floating="mode.floating"
    :app="mode.app"
    :expand-on-hover="mode.rail"
    width="280"
    elevation="6"
    border="none"
    theme="dark"
    class="sidebar-gradient"
    @mouseenter="onMouseEnter"
    @mouseleave="onMouseLeave"
  >
    <!-- Logo Section -->
    <v-sheet class="pa-4 d-flex align-center justify-center" color="transparent" height="80">
      <div class="logo-container d-flex align-center">
        <v-avatar color="transparent" size="48" class="mr-2">
          <img 
            src="https://zcwd.gov.ph/wp-content/uploads/2024/10/ZCWD-Logo-50th-Optimized.png" 
            alt="ZCWD Logo"
            class="logo-img"
          />
        </v-avatar>
        <div v-if="!mode.rail" class="logo-text">
          <div class="font-weight-bold text-white text-h6">ZCWD PMIS</div>
          <div class="text-caption text-grey-lighten-2">Property Management System</div>
        </div>
      </div>
    </v-sheet>

    <v-divider class="mx-4 my-2" color="white" opacity="0.12"></v-divider>

    <!-- Main Navigation -->
    <v-list density="compact" nav class="px-2">
      <v-list-item
        v-for="item in items"
        :key="item.title"
        :prepend-icon="item.icon"
        :title="item.title"
        :to="item.route"
        rounded
        active-class="active-item"
        class="mb-1"
      >
        <template #prepend>
          <v-icon :icon="item.icon" class="mr-3"></v-icon>
        </template>
      </v-list-item>

      <v-divider class="my-3" color="white" opacity="0.12"></v-divider>

      <!-- Libraries Section -->
      <v-list-group v-model="groups.libraries" value="libraries">
        <template #activator="{ props }">
          <v-list-item
            v-bind="props"
            prepend-icon="mdi-library"
            title="Libraries"
            class="text-white"
          >
            <template #prepend>
              <v-icon icon="mdi-library" class="mr-3"></v-icon>
            </template>
          </v-list-item>
        </template>
        <v-list-item
          v-for="library in libraries"
          :key="library.title"
          :title="library.title"
          :to="library.route"
          :prepend-icon="library.icon"
          rounded
          active-class="active-item"
          class="ml-4"
        />
      </v-list-group>

      <!-- Master Files Section -->
      <v-list-group v-model="groups.files" value="files">
        <template #activator="{ props }">
          <v-list-item
            v-bind="props"
            prepend-icon="mdi-folder-multiple-outline"
            title="Files"
            class="text-white"
          >
            <template #prepend>
              <v-icon icon="mdi-folder-multiple-outline" class="mr-3"></v-icon>
            </template>
          </v-list-item>
        </template>
        <v-list-item
          v-for="file in files"
          :key="file.title"
          :prepend-icon="file.icon"
          :title="file.title"
          rounded
          active-class="active-item"
          class="ml-4"
        />
      </v-list-group>

     

      <v-divider class="my-3" color="white" opacity="0.12"></v-divider>

      <!-- System Section -->
      <v-list-item
        prepend-icon="mdi-cog"
        title="Settings"
        to="/settings"
        rounded
        active-class="active-item"
        class="mb-1"
      >
        <template #prepend>
          <v-icon icon="mdi-cog" class="mr-3"></v-icon>
        </template>
      </v-list-item>
    </v-list>

    <!-- User Info at Bottom (when expanded) -->
    <template v-if="!mode.rail" #append>
      <v-divider class="mx-4 my-2" color="white" opacity="0.12"></v-divider>
      <div class="pa-4 text-center">
        <v-icon icon="mdi-shield-check" color="green-lighten-2" class="mb-2"></v-icon>
        <div class="text-caption text-grey-lighten-3">ZCWD Property Management</div>
        <div class="text-caption text-grey-lighten-2">and Inventory System v1.0</div>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<style scoped>
.sidebar-gradient {
  background: linear-gradient(180deg, #0c3c60 0%, #0a2942 100%) !important;
  color: #fff;
}

.logo-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.logo-text {
  opacity: 1;
  transition: opacity 0.3s ease;
}

.v-navigation-drawer--rail .logo-text {
  opacity: 0;
  width: 0;
  overflow: hidden;
}

.v-navigation-drawer.v-navigation-drawer--rail {
  width: 70px !important;
}

.active-item {
  background: linear-gradient(90deg, rgba(0, 168, 232, 0.2) 0%, rgba(0, 168, 232, 0.1) 100%) !important;
  border-left: 3px solid #00a8e8 !important;
}

.v-list-item--active {
  background: linear-gradient(90deg, rgba(0, 168, 232, 0.2) 0%, rgba(0, 168, 232, 0.1) 100%) !important;
}

.v-list-item:hover {
  background: rgba(255, 255, 255, 0.05) !important;
}

.v-list-group__items .v-list-item {
  padding-left: 20px !important;
}

.v-list-item__prepend {
  margin-right: 12px !important;
}

.v-navigation-drawer.v-navigation-drawer--rail .v-list-item {
  padding-left: 5px !important;
  padding-right: 0 !important;
  min-height: 40px !important;
  justify-content: start !important;
}



</style>