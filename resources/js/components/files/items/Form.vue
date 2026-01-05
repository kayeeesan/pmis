<script setup>
import { ref, reactive, watch, onMounted } from "vue";
import useItems from "../../../composables/items.js";

const { errors, is_loading, is_success, updateItem, storeItem} = useItems();

const emit = defineEmits(["input", "reloadItem"]);
const props = defineProps({
    item: {
        type: Object,
        default: null
    },
    value: {
        type: Boolean,
        deafault: false
    }
});

const initialState = {
    id: null,
    propertyno: null,
    item: null,
    unit: null,
    descrip: null,
    classid: null,
    yrlife: null,
    reorderpt: null,
    reorderqty: null,
    edate: null,
    itemtypeid: null,
    status: null,
    criticalqty: null,
    allow: null,
    propertycard: null,
}

const form = reactive({ ...initialState});

watch (
    () => props.item,
    (value) => {
        form.id = value.id;
        form.propertyno = value.propertyno;
        form.item = value.item;
        form.unit = value.unit;
        form.descrip = value.descrip;
        form.classid = value.classid;
        form.yrlife = value.yrlife;
        form.reorderpt = value.reorderpt;
        form.reorderqty = value.reorderqty;
        form.edate = value.edate
            ? value.edate.substring(0, 10) : null;
        form.itemtypeid = value.itemtypeid;
        form.status = value.status;
        form.criticalqty = value.criticalqty;
        form.allow = value.allow;
        form.propertycard = value.propertycard;
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
    emit("input", false);
    errors.value = {};
}

const save = async () => {
    if(props.item && props.item.id) {
        await updateItem({ ...form});
    } else {
        await storeItem({ ...form});
    }

    if (is_success.value == true){
        emit("reloadItems");
        emit("input", false);
    }
}

</script>
<template>
 <v-dialog v-model="show_form_modal" max-width="500px" scrollable persistent="">
    <v-card>
        <v-card-title class="mt-2">
            <span class="text-h5">Update Item</span>
        </v-card-title>

        <v-card-text>
             <v-container>
                <!-- Basic Information -->
                <v-row>
                    <v-col cols="12">
                        <div class="text-subtitle-1 font-weight-medium mb-3">Basic Information</div>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.propertyno"
                            label="Property No."
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.item"
                            label="Item"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.unit"
                            label="Unit"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.descrip"
                            label="Description"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                </v-row>

                <!-- Classification -->
                <v-row class="mt-2">
                    <v-col cols="12">
                        <div class="text-subtitle-1 font-weight-medium mb-3">Classification</div>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.classid"
                            label="Class ID"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.itemtypeid"
                            label="Item Type ID"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.yrlife"
                            label="Year Life"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.status"
                            label="Status"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                </v-row>

                <!-- Inventory Settings -->
                <v-row class="mt-2">
                    <v-col cols="12">
                        <div class="text-subtitle-1 font-weight-medium mb-3">Inventory Settings</div>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.reorderpt"
                            label="Reorder Point"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.reorderqty"
                            label="Reorder Qty"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.criticalqty"
                            label="Critical Qty"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.allow"
                            label="Allow"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                </v-row>

                <!-- Additional Information -->
                <v-row class="mt-2">
                    <v-col cols="12">
                        <div class="text-subtitle-1 font-weight-medium mb-3">Additional Information</div>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.edate"
                            label="Entry Date"
                            type="date"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.propertycard"
                            label="Property Card"
                            density="compact"
                            outlined
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>

        <v-card-actions class="mb-4 mr-5">
            <v-spacer></v-spacer>
            <v-btn color="blue-grey-lighten-2" @click="close()" variant="tonal">
                    Cancel
                </v-btn>
                <v-btn color="primary" @click="save()" variant="tonal">
                    Save
                </v-btn>
        </v-card-actions>
    </v-card>
 </v-dialog>
</template>