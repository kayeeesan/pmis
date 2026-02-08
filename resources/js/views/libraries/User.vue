<script setup>
import { ref, onMounted, watch } from 'vue';
import useUsers from '../../composables/users';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';

const { users, pagination, querySearch, is_loading, getUsers, destroyUser } = useUsers();

onMounted(() => {
    getUsers();
});

// Watch for page changes
watch(() => querySearch.page, () => {
    getUsers();
});

// Reload
const reloadUsers = async () => {
    querySearch.page = 1;
    await getUsers();
};
</script>

<template>
  <div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Users List</h2>

    <!-- Search + Reload -->
    <div class="mb-3 flex flex-col sm:flex-row justify-between items-center gap-2">
      <input
        v-model="querySearch.search"
        type="text"
        placeholder="Search users..."
        class="border rounded px-3 py-2 w-full sm:w-64 focus:ring-2 focus:ring-blue-500"
        @input="() => { querySearch.page = 1; getUsers(); }"
      />
      <Button label="Reload" icon="pi pi-refresh" class="btn btn-primary" @click="reloadUsers" />
    </div>

    <!-- DataTable -->
    <DataTable
      :value="users"
      :loading="is_loading"
      :paginator="true"
      :first="(querySearch.page - 1) * pagination.per_page"
      :rows="pagination.per_page"
      :totalRecords="pagination.total"
      :lazy="true"
      @page="(event) => { querySearch.page = event.page + 1 }"
      class="shadow-lg rounded-lg overflow-hidden"
    >
      <Column field="id" header="#" style="width: 50px" />
      <Column field="username" header="Username" />
      <Column field="full_name" header="Full Name" />

      <!-- Actions column using template slot -->
      <Column header="Actions" style="width: 160px">
        <template #body="{ data }">
          <div class="flex gap-2">
            <Button
              icon="pi pi-pencil"
              class="btn btn-outline-primary btn-sm"
              @click="() => alert('Edit ' + data.username)"
            />
            <Button
              icon="pi pi-trash"
              class="btn btn-danger btn-sm"
              @click="() => destroyUser(data.id)"
            />
          </div>
        </template>
      </Column>
    </DataTable>
  </div>
</template>
