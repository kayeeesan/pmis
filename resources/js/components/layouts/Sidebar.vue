<script setup>
import { ref, watch, reactive } from "vue";

const props = defineProps({
    drawer: {
        type: Boolean,
        default: false,
    },
});

const items = [
    { title: 'Home', icon: 'mdi-home', route: "/" },
];

// collapsible section states
const groups = reactive({
  libraries: true,
  files: false,
});

const libraries = [
    { title: 'Role', route: "/roles" },
    { title: 'Accounts', route: "/users" },
    { title: 'Employees', route: "/employees" },
];
const files = [
    { title: 'Item Masterfile'},
    { title: 'Supplier Masterfile'},
    { title: 'Department Masterfile'},
    { title: 'Division Masterfile'},
    { title: 'Section Masterfile'},
    { title: 'Fixed Assets, and Properties'},
    { title: 'Module/Report Masterfile'},
    { title: 'Miscellaneous'},
    { title: 'Projects'},
];

const open = ref(true);
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
            // Open: full drawer, part of layout (content shifts)
            open.value = true;
            mode.rail = false;
            mode.floating = false;
            mode.app = true;
            mode.temporary = false;
        } else {
            // Closed: keep a mini rail, floating over content (no layout shift)
            open.value = true; // keep visible to show rail
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
    width="260"
    elevation="6"
    border="end"
    theme="dark"
    class="sidebar-gradient"
  >
    <v-sheet class="pa-4 d-flex align-center" color="transparent">
      <v-avatar color="cyan-darken-3" size="40" class="mr-3">
        <v-icon icon="mdi-cube-outline"></v-icon>
      </v-avatar>
      <div class="font-weight-medium text-white">PMIS</div>
    </v-sheet>
    <v-divider></v-divider>

    <v-list density="comfortable" nav>
      <v-list-item
        v-for="item in items"
        :key="item.title"
        :prepend-icon="item.icon"
        :title="item.title"
        :to="item.route"
        rounded
        active-color="cyan-accent-2"
      ></v-list-item>

      <v-divider class="my-2" color="white" opacity="0.12"></v-divider>

      <v-list-group v-model="groups.libraries" value="libraries">
      <template #activator="{ props }">
        <v-list-item
          v-bind="props"
          prepend-icon="mdi-format-list-bulleted-type"
          title="Libraries"
          class="text-white"
        />
      </template>
      <v-list-item
        v-for="library in libraries"
        :key="library.title"
        :title="library.title"
        :to="library.route"
        rounded
        active-color="cyan-accent-2"
      />
    </v-list-group>

    <v-divider class="my-2" color="white" opacity="0.12"></v-divider>

    <v-list-group v-model="groups.files" value="files">
      <template #activator="{ props }">
        <v-list-item
          v-bind="props"
          prepend-icon="mdi-folder-multiple"
          title="Files"
          class="text-white"
        />
      </template>
      <v-list-item
        v-for="file in files"
        :key="file.title"
        prepend-icon="mdi-folder-outline"
        :title="file.title"
        rounded
        active-color="cyan-accent-2"
      />
    </v-list-group>
    </v-list>
  </v-navigation-drawer>
</template>
<style>
.sidebar-gradient {
  background: linear-gradient(180deg, #0f172a, #111827);
  color: #fff;
}
.nav-header {
    margin-top: 10px
}
.nav-header.v-list-item--nav .v-list-item-title {
    font-size: 15px;
    font-weight: bold;
}

.v-navigation-drawer.v-navigation-drawer--rail {
  width: 68px !important;
}


</style>