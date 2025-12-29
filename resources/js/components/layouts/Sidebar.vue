<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    drawer: {
        type: Boolean,
        default: false,
    },
});

const items = [
    { title: 'Home', icon: 'mdi-home', route: "/" },
];

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
const isRail = ref(true);

watch(
    () => props.drawer,
    (value)  => {
        // When drawer is active (true), expand to full width (rail=false)
        // When inactive (false), collapse to rail (mini variant)
        isRail.value = !value;
    }
);
</script>
<template>
    <v-navigation-drawer v-model="open" :rail="isRail" :permanent="true" app>
        <v-list>
            <template v-for="item in items">
                <v-list-item
                    :prepend-icon="item.icon"
                    :title="item.title"
                    :to="item.route"
                ></v-list-item>
            </template>

            <v-list-group value="Actions">
                <template v-slot:activator="{ props }">
                    <v-list-item
                        prepend-icon="mdi-format-list-bulleted-type"
                        v-bind="props"
                        title="Libraries"
                    ></v-list-item>
                </template>

                <v-list-item
                    v-for="library in libraries"
                    :title="library.title"
                    :to="library.route"
                ></v-list-item>
            </v-list-group>

            <v-list-group value="Files">
                <template v-slot:activator="{ props }">
                    <v-list-item
                    prepend-icon="mdi-folder-multiple"
                    v-bind="props"
                    title="Files"
                    ></v-list-item>
                </template>

                <v-list-item
                    v-for="file in files"
                    :key="file.title"
                    :title="file.title"
                ></v-list-item>
            </v-list-group>

        </v-list>
      </v-navigation-drawer>
</template>
<style>
.v-navigation-drawer--rail.v-navigation-drawer--expand-on-hover:not(.v-navigation-drawer--is-hovering) .v-list-item .v-avatar, .v-navigation-drawer--rail:not(.v-navigation-drawer--expand-on-hover) .v-list-item .v-avatar{
    width: 38px;
    height: 38px;
}
.nav-header {
    margin-top: 10px
}
.nav-header.v-list-item--nav .v-list-item-title {
    font-size: 15px;
    font-weight: bold;
}
</style>