import { ref } from 'vue';
import axios from 'axios';
import { useStore } from "vuex";
import { useRouter } from 'vue-router';
import Swal from "sweetalert2";

export default function useAuth() {
    const user = ref(null);
    const is_loading = ref(false);
    const store =  useStore();
    const error = ref("");
    const router = useRouter();

    const login = async (data) => {
        is_loading.value = true;

        try{
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/login', data)
            .then((response) => {
                if(response.data.user){
                    user.value = response.data.user;
        
                    const now = new Date();
                    const expiry = now.getTime() + 8 * 60 * 60 * 1000; // expire every 8 hours

                    localStorage.setItem('expiry', expiry);
                    localStorage.setItem('token', response.data.access_token);

                    store.commit('auth/SET_USER', user.value);
                    store.commit('auth/SET_AUTHENTICATED',true);
                    location.reload();
                }
            })
        } catch (e) {
            error.value = e.response.data;
            is_loading.value = false;
        }
    }

    const logout = async () => {

        const result = await Swal.fire({
            title: 'Logout',
            text: 'Are you sure you want to logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            focusCancel: true
        });

        if (!result.isConfirmed) {
            return;
        }

        is_loading.value = true;
        await axios.post('/api/logout')
        .then(() => {
            localStorage.clear();
            store.dispatch('auth/logout');
            
            is_loading.value = false;
            location.reload();
        })
    }

    
    return {
        user,
        is_loading,
        error,
        login,
        logout,
        }
}