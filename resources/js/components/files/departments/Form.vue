<script setup>
import { ref, reactive, watch, onMounted } from 'vue';
import useDepartment from "../../../composables/department";

const { errors, is_loading, is_success, updateDepartment, storeDepartment } = useDepartment();

const emit = defineEmits(['input', 'reloadDepartment']);

const props = defineProps({
    department: {
        type: Object,
        default: null
    },
    action_type: {
        type: String,
        default: null,
    },
    value: {
        type: Boolean,
        deafault: false
    }
});

const initialState = {
    uuid: null,
    name: null,
    code: null,
}

const form = reactive({ ...initialState });

watch(
    () => props.department,
    (value) => {
        form.uuid = value.uuid;
        form.name = value.name;
        form.code = value.code;
    }
)

const show_form_modal = ref(false);

watch(
    () => props.value,
    (value) => {
        show_form_modal.value = value;
    }
);

const close = () => {
    Object.assign(form, initialState);
    emit('input', false);
    errors.value = {};
}

    const save = async () => {
        if(props.department && props.department.uuid){
            await updateDepartment({ ...form });
        } else {
            await storeDepartment({ ...form });
        }

        if (is_success.value == true){
            emit('reloadDepartment');
            emit('input', false);
        }
    }
</script>
<template>
<v-dialog v-model="show_form_modal" max-width="500px" scrollable persistent="">
    <v-card>        
        <v-card-title>
                <span class="text-h5" v-if="action_type == 'Update'">{{ action_type }} Department</span>
                <span class="text-h5" v-else>New Department</span>
        </v-card-title>

        <v-card-text>
            <v-container>
                <v-row>
                    <v-text-field
                        v-model="form.name"
                        label="Department Name"
                        :error-messages="
                                errors['name'] ? errors['name'] : []
                            "
                        required
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-text-field
                        v-model="form.code"
                        label="Department Code"
                        :error-messages="
                                errors['code'] ? errors['code'] : []
                            "
                        required
                    ></v-text-field>
                </v-row>
            </v-container>
        </v-card-text>
        
        <v-card-actions class="mb-4 mr-5">
            <v-spacer></v-spacer>
            <v-btn color="blue-grey-lighten-2" @click="close()" variant="tonal">
                    Cancel
                </v-btn>
                <v-btn color="primary" @click="save()" variant="tonal" :loading="is_loading">
                    Save
                </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>
</template>