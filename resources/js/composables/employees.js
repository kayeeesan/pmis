import { ref } from 'vue';
import axios from 'axios';
import Swal from "sweetalert2";

export default function useRoles() {
    const employee = ref(null);
    const employees = ref([]);
    const is_loading = ref(false);
    const is_success = ref(false);
    const errors = ref({});
    const pagination = ref({});
    const query = ref({
        search: null,
        page: 1,
    });

    const getEmployees = async (params = {}) => {
        is_loading.value = true;

        let query_str = { ...query.value, ...params };
        await axios
            .get('/api/employees', {
                params: query.value
            })
            .then((response) => {
                employees.value = response.data.data;
                pagination.value = response.data.meta;
            })
            .finally(() => {
                is_loading.value = false;
            });
    }


    return {
        employee,
        employees,
        is_loading,
        is_success,
        errors,
        pagination, 
        query,
        getEmployees,
    }
}