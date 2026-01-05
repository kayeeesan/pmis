<script setup>
import { ref, reactive, watch, onMounted } from "vue";
import useEmployees from "../../composables/employees.js";

const { errors, is_loading, is_success, updateEmployee } = useEmployees();

const emit = defineEmits(["input", "reloadEmployees"]);
const props = defineProps({
    employee: {
        type: Object,
        default: null
    },
    value: {
        type: Boolean,
        default: false,
    }
});

const initialState = {
    IDNumber: null,
    FirstName: null,
    LastName: null,
    Address: null,
    PhoneNo: null,
    Status: null,
}

const form = reactive({ ...initialState});

watch(
    () => props.employee,
    (value)  => {
        form.IDNumber = value.IDNumber;
        form.FirstName = value.FirstName;
        form.LastName = value.LastName;
        form.Address = value.Address;
        form.PhoneNo = value.PhoneNo;
        form.Status = value.Status;
    }
);

const show_form_modal = ref(false);
watch(
    () => props.value,
    (value)  => {
        show_form_modal.value = value;
    }
);

const close = () => {
    Object.assign(form, initialState);
    emit("input", false);
    errors.value = {};
}

const submitForm = async () => {
    if (!form.IDNumber) return; 

    const payload = {
        FirstName: form.FirstName,
        LastName: form.LastName,
        Address: form.Address,
        PhoneNo: form.PhoneNo,
        Status: form.Status,
    };

    const success = await updateEmployee(form.IDNumber, payload);

    if (success) {
        emit("reloadEmployees"); 
        close(); 
    }
};


</script>

<template>
    <v-dialog v-model="show_form_modal" max-width="500px" scrollable persistent="">
        <v-card>
            <v-card-title class="mt-2">
                <span class="text-h5">Update Employee</span>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="form.FirstName"
                                label="First Name"
                                :error-messages="errors.FirstName"
                                outlined
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="form.LastName"
                                label="Last Name"
                                :error-messages="errors.LastName"
                                outlined
                                dense
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field
                                v-model="form.Address"
                                label="Address"
                                :error-messages="errors.Address"
                                outlined
                                dense
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field
                                v-model="form.PhoneNo"
                                label="Contact No."
                                :error-messages="errors.PhoneNo"
                                outlined
                                dense
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-select
                                v-model="form.Status"
                                :items="['Active', 'Inactive']"
                                label="Status"
                                :error-messages="errors.Status"
                                outlined
                                dense
                            ></v-select>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            
            <v-card-actions class="mb-4 mr-5">
                    <v-spacer></v-spacer>
                <v-btn color="blue-grey-lighten-2" @click="close()" variant="tonal">
                    Cancel
                </v-btn>
                <v-btn color="primary" variant="tonal" @click="submitForm">
                    Save
                    </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>