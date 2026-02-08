<script setup>
import { ref, watch } from "vue";
import useRoles from '../../../composables/roles';

const { storeRole, updateRole, is_loading, errors } = useRoles();
const props = defineProps({
    role: Object // role to edit
});
const emit = defineEmits(["saved"]);

const role = ref({ name: "", slug: "", id: null });

// When props.role changes (for edit), update local role
watch(() => props.role, (newRole) => {
    if(newRole) role.value = { ...newRole };
}, { immediate: true });

const submitForm = async () => {
    if(role.value.id) {
        // Update existing role
        await updateRole(role.value);
    } else {
        // Create new role
        await storeRole(role.value);
    }
    emit("saved");
};
</script>

<template>
  <div>
    <div class="flex flex-col gap-2">
      <input v-model="role.name" placeholder="Role Name" class="border p-2 rounded" />
      <button @click="submitForm" :disabled="is_loading" class="btn btn-primary">
        {{ role.id ? 'Update' : 'Save' }}
      </button>
    </div>
  </div>
</template>
