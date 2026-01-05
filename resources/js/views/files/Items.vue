<script setup>
import { onMounted, ref } from 'vue';
import useItems from "../../composables/items"
import { get } from '@vueuse/core';
import ItemForm from "../../components/files/items/Form.vue"

const { items, pagination, query, is_loading, getItems, destoryItem, storeEmployee } = useItems();

const item = ref({});
const show_form_modal = ref(false);

const headers = [
  { title: "Property No.", key: "propertyno" },
  { title: "Item", key: "item" },
  { title: "Unit", key: "unit" },
  { title: "Description", key: "descrip" },
  { title: "Class ID", key: "classid" },
  { title: "Year Life", key: "yrlife" },
  { title: "Reorder Point", key: "reorderpt" },
  { title: "Reorder Qty", key: "reorderqty" },
  { title: "Entry Date", key: "edate" },
  { title: "Item Type ID", key: "itemtypeid" },
  { title: "Status", key: "status" },
  { title: "Critical Qty", key: "criticalqty" },
  { title: "Allow", key: "allow" },
  { title: "Property Card", key: "propertycard" },
  { title: "Actions", key: "actions", sortable: false },
];

const showModalForm = (val) => {
    show_form_modal.value = val;
}

const deleteItem = async (value) => {
    await destoryItem(value.id);
}

const editItem = (value) => {
    item.value = value;
    showModalForm(true);
}

const reloadItems = async () => {
    await getItems();
    item.value={};
}

onMounted(() => {
    getItems();
});
</script>
<template>
    <v-row class="p-2">
        <h5 class="fw-bold p-3">List of Items</h5>
        <v-spacer></v-spacer>
    </v-row>
    <v-card>
        <div  class="overflow-hidden overflow-x-auto min-w-full align-middle">
            <v-card-title>
                <v-text-field
                    v-model="query.search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="items"
                :search="query.search"
                class="elevation-1 p-2"
                :loading="is_loading"
                loading-text="Loading... Please wait"
            >
            <template v-slot:item.actions="{ item }">
                <v-btn
                        class="me-2"
                        @click="editItem(item)"
                        color="success"
                        variant="tonal"
                        size="small"
                    >
                        <v-icon size="small"> mdi-pencil </v-icon> Edit
                    </v-btn>
                    <v-btn
                        color="error"
                        @click="deleteItem(item)"
                        variant="tonal"
                        size="small"
                    >
                        <v-icon> mdi-delete </v-icon> delete
                    </v-btn>
            </template>
            <template v-slot:bottom>
                    <div class="m-2">
                        <span style="color: gray" v-if="pagination">
                            Showing {{ pagination.from }} to
                            {{ pagination.to }} out of
                            <b>{{ pagination.total }} records</b>
                        </span>
                        <div class="text-center">
                            <v-pagination
                                v-model="query.page"
                                :length="pagination.last_page"
                                circle
                                @click="getItems"
                            >
                            </v-pagination>
                        </div>
                    </div>
                </template>
        </v-data-table>
        </div>
        <item-form
        :value="show_form_modal"
        :item="item"
        @input="showModalForm"
        @reloadItems="reloadItems"
        />
    </v-card>
</template>