import {ref} from "vue";
import axios from "axios";

export default function useUsers(){
    const users = ref([]);
    const getUsers = async() => {
        let response = await axios.get('/api/users');
        users.value = response.data.data;
    };

    return {
        users,
        getUsers,
    }
}

