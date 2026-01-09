<script setup>
import { onMounted, ref } from 'vue';
import useDepartment from "../../composables/department";
import DepartmentForm from "../../components/files/departments/Form.vue";

const { departments, pagination, query, is_loading, getDepartments, destroyDepartment } = useDepartment();

const department = ref({});
const action_type = ref('');
const show_form_modal = ref(false);

const headers = [
    { title: "Department Name", key: "name" },
    { title: "Code", key: "code" },
    { title: "Actions", key: "actions", sortable: false },
];

const showModalForm = (val) => {
    show_form_modal.value = val;
}

const editItem = (value, action) => {
    department.value = value;
    action_type.value = action;
    showModalForm(true);
}

const deleteItem = async (value) => {
    await destroyDepartment(value.uuid);
}

const reloadDepartments = async () => {
    await getDepartments();
    department.value={};
}

onMounted(() => {
    getDepartments();
});
</script>
<template>
    <v-row class="p-2">
        <h5 class="fw-bold p-3">List of Departments</h5>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="showModalForm(true)" class="m-3">
            New Department
        </v-btn>
    </v-row>
    <v-card>
        <div class="overflow-hidden overflow-x-auto min-w-full align-middle">
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
                :items="departments"
                :search="query.search"
                class="elevation-1 p-2"
                :loading="is_loading"
                loading-text="Loading... Please wait"
            >
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        class="me-2"
                        color="success"
                        variant="tonal"
                        size="small"
                        @click="editItem(item, 'Update')"
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
                               
                            >
                            </v-pagination>
                        </div>
                    </div>
                </template>
            </v-data-table>
        </div>
    </v-card>
    <department-form
        :value="show_form_modal"
        :department="department"
        :action_type="action_type"
        @input="showModalForm"
        @reloadDepartment="reloadDepartments"
    />
</template>