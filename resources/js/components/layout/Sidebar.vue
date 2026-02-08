<!-- resources/js/components/layout/Sidebar.vue -->
<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router';

defineProps({
  collapsed: Boolean
});

// Menu structure
const menuItems = [
  {
    label: 'Home',
    icon: 'pi pi-home',
    route: '/'
  },
  {
    label: 'Libraries',
    icon: 'pi pi-database',
    children: [
      { label: 'User', icon: 'pi pi-user', route: '/users' },
      { label: 'Role', icon: 'pi pi-id-card', route: '/roles' }
    ]
  }
];

// Toggle submenus
const expandedMenus = ref([]);
const toggleMenu = (label) => {
  const index = expandedMenus.value.indexOf(label);
  if (index > -1) {
    expandedMenus.value.splice(index, 1);
  } else {
    expandedMenus.value.push(label);
  }
};
</script>

<template>
  <aside 
    :class="[
      'sidebar',
      collapsed ? 'w-20' : 'w-64'
    ]"
  >
    <!-- Logo -->
    <div class="p-4 border-b border-gray-800">
      <div class="flex items-center gap-3">
        <!-- ZCWD Logo -->
        <div class="flex-shrink-0">
          <img 
            src="https://zcwd.gov.ph/wp-content/uploads/2024/10/ZCWD-Logo-50th-Optimized.png" 
            alt="ZCWD Logo"
            :class="[
              'transition-all duration-300',
              collapsed ? 'w-10 h-10' : 'w-12 h-12'
            ]"
          />
        </div>
        
        <!-- Text -->
        <div v-if="!collapsed" class="flex flex-col">
          <span class="text-lg font-bold text-white">ZCWD PMIS</span>
        </div>
      </div>
    </div>
    
    <!-- Menu -->
    <nav class="flex-1 p-4">
      <ul class="space-y-2">
        <li v-for="item in menuItems" :key="item.label">
          <!-- Simple menu item -->
          <template v-if="!item.children">
            <RouterLink
              :to="item.route"
              class="sidebar-link"
              active-class="active"
            >
              <i :class="item.icon"></i>
              <span v-if="!collapsed">{{ item.label }}</span>
            </RouterLink>
          </template>
          
          <!-- Menu with sub-items -->
          <template v-else>
            <button
              @click="toggleMenu(item.label)"
              class="sidebar-link w-full text-left"
            >
              <i :class="item.icon"></i>
              <span v-if="!collapsed" class="flex-1">{{ item.label }}</span>
              <i 
                v-if="!collapsed"
                :class="[
                  'pi pi-chevron-down transition-transform',
                  expandedMenus.includes(item.label) ? 'rotate-180' : ''
                ]"
              ></i>
            </button>
            
            <!-- Submenu -->
            <ul 
              v-if="!collapsed && expandedMenus.includes(item.label)"
              class="sidebar-submenu"
            >
              <li v-for="child in item.children" :key="child.route">
                <RouterLink
                  :to="child.route"
                  class="sidebar-link"
                  active-class="active"
                >
                  <i :class="child.icon"></i>
                  <span>{{ child.label }}</span>
                </RouterLink>
              </li>
            </ul>
          </template>
        </li>
      </ul>
    </nav>
  </aside>
</template>