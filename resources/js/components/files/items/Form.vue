<script setup>
import { ref, reactive, watch, onMounted } from "vue";
import useItems from "../../../composables/items.js";

const { errors, is_loading, is_success, updateItem} = useItems();

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
        form.edate = value.edate;
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

const submitForm = async () => {
    if (!form.id) return;

    const payload = {
        propertyno: form.propertyno,
        item: form.item,
        unit: form.unit,
        descrip: form.descrip,
        classid: form.classid,
        yrlife: form.yrlife,
        reorderpt: form.reorderpt,
        reorderqty: form.reorderqty,
        edate: form.edate,
        itemtypeid: form.itemtypeid,
        status: form.status,
        criticalqty: form.criticalqty,
        allow: form.allow,
        propertycard: form.propertycard,
    };

    const success = await updateItem(props.item.id, payload);

    if (success) {
        emit("reloadItems");
        close();
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
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.propertyno"
                            label="Property No."
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.item"
                            label="Item"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.unit"
                            label="Unit"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.descrip"
                            label="Description"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.classid"
                            label="Class ID"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.yrlife"
                            label="Year Life"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.reorderpt"
                            label="Reorder Point"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.reorderqty"
                            label="Reorder Qty"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.edate"
                            label="Entry Date"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.itemtypeid"
                            label="Item Type ID"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.status"
                            label="Status"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.criticalqty"
                            label="Critical Qty"
                        ></v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.allow"
                            label="Allow"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field
                            v-model="form.propertycard"
                            label="Property Card"
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
                <v-btn color="primary" @click="submitForm()" variant="tonal">
                    Save
                </v-btn>
        </v-card-actions>
    </v-card>
 </v-dialog>
</template>