<script setup>
import { onMounted, ref } from 'vue';
import useDepartment from "../../composables/department"

const { departments, pagination, query, is_loading, getDepartments, destroyDepartment } = useDepartment();

const department = ref({});

const headers = [
    { title: "Department Name", key: "name" },
    { title: "Code", key: "code" },
    { title: "Actions", key: "actions", sortable: false },
];


const deleteDepartment = async (value) => {
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
        <v-btn color="primary" class="m-3">
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
                    >
                        <v-icon size="small"> mdi-pencil </v-icon> Edit
                    </v-btn>
                    <v-btn
                        color="error"
                        @click="deleteDepartment(item)"
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
    <department-form
        :value="show_form_modal"
        :department="department"
        @input="showModalForm"
        @reloadItems="reloadDepartments"
    />
    </v-card>
</template>