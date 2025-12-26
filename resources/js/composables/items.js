import { ref } from 'vue';
import axios from 'axios';
import Swal from "sweetalert2";

export default function useItems() {
    const item = ref(null);
    const items = ref([]);
    const is_loading = ref(false);
    const is_success = ref(false);
    const errors = ref({});
    const pagination = ref({});
    const query = ref({
        search: null,
        page: 1,
    });

   const getItems = async (params = {}) => {
        is_loading.value = true;

        let query_str = { ...query.value, ...params };
        await axios
            .get('/api/items', {
                params: query.value
            })
            .then((response) => {
                items.value = response.data.data;
                pagination.value = response.data.meta;
            })
            .finally(() => {
                is_loading.value = false;
            }); 
        }

        const updateItem = async (id, payload) => {
        try {
            const response = await axios.put(`/api/items/${id}`, payload);
            Swal.fire(
                "Updated!",
                response.data.message,
                "success"
            );

            await getItems();
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

    const destoryItem = async (id) => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios.delete(`/api/items/${id}`);
                Swal.fire("Deleted!", "Item has been deleted.", "success");
                await getItems();
            }
        });
    };

    return {
        item,
        items,
        is_loading,
        is_success,
        errors,
        pagination,
        getItems,
        updateItem,
        destoryItem,
    }
}