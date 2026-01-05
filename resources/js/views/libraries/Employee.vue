<script setup>
import { ref, onMounted } from "vue";
import useEmployees from "../../composables/employees.js";
import EmployeeForm from "../../components/employees/Form.vue";

const { employees, pagination, query, is_loading, getEmployees, destoryEmployee, updateEmployee } = useEmployees();

const employee = ref({});
const show_form_modal = ref(false);

const headers = [
    { title: "Name", key: "FirstName" },
    { title: "Address", key: "Address" },
    { title: "Contact No.", key: "PhoneNo" },
    { title: "Status", key: "Status"},
    { title: "Actions", key: "actions", sortable: false },
];

const showModalForm = (val) => {
    show_form_modal.value = val;
};

const deleteItem = async (item) => {
    await destoryEmployee(item.IDNumber);
}

const editItem = (value) => {
    employee.value = value;
    showModalForm(true);
};
const reloadEmployees = async () => {
    await getEmployees();
    employee.value = {};
};

onMounted(() => {
    getEmployees();
});
</script>
<template>
   <v-row class="p-2">
    <h5 class="fw-bold p-3">List of Employees</h5>
    <v-spacer></v-spacer>
    <v-btn color="primary" @click="showModalForm(true)">New Employee</v-btn>
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
                :items="employees"
                :search="query.search"
                class="elevation-1 p-2"
                :loading="is_loading"
                loading-text="Loading... Please wait"
            >
                <template v-slot:item.actions="{ item }">
                    <v-btn
                        class="me-2"
                        color="success"
                        @click="editItem(item)"
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
                                @click="getEmployees"
                            >
                            </v-pagination>
                        </div>
                    </div>
                </template>
            </v-data-table>
    </div>
   </v-card>
   <employee-form
    :value="show_form_modal"
    :employee="employee"
    @input="showModalForm"
    @reloadEmployees="reloadEmployees"
   />
    
</template>