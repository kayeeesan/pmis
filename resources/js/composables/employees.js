import { ref } from 'vue';
import axios from 'axios';
import Swal from "sweetalert2";
import { get } from '@vueuse/core';

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
                params: query_str
            })
            .then((response) => {
                employees.value = response.data.data;
                pagination.value = response.data.meta;
            })
            .finally(() => {
                is_loading.value = false;
            });
    }

    const storeEmployee = async (payload) => {
        is_loading.value = true;
        errors.value = {};

        try {
            const response = await axios.post('/api/employees', payload);

            Swal.fire(
                "Saved!",
                response.data.message,
                "success"
            );

            await getEmployees();
            return true;

        } catch (error) {
            if (error.response?.status === 422) {
                errors.value = error.response.data.errors || {};

                Swal.fire({
                    icon: "error",
                    title: "Validation failed",
                    text: "Please check the form fields.",
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Save failed",
                    text: error.response?.data?.message || "Something went wrong",
                });
            }

            return false;

        } finally {
            is_loading.value = false;
        }
    };


    const updateEmployee = async (id, payload) => {
        try {
            const response = await axios.put(`/api/employees/${id}`, payload);

            Swal.fire(
                "Updated!",
                response.data.message,
                "success"
            );

            await getEmployees();
            return true;
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Update failed",
                text: error.response?.data?.message || "Something went wrong",
            });
            return false;
        }
    };


    const destoryEmployee = async (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                axios
                    .delete(`/api/employees/${id}`)
                    .then((response) => {
                        getEmployees();
                        Swal.fire("Deleted", response.data.message, "success");
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                        });
                    });
            }
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
        destoryEmployee,
        updateEmployee,
        storeEmployee
    }
}