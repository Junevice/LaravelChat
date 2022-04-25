import {ref} from "vue";
import axios from "axios";

export default function useUsers(){
    const users = ref([]);
    const getUsers = async() => {
        let response = await axios.get('/api/users');
        users.value = response.data.data;
    };

    const updateUser = async (type, value)=>{
        const data = {type: type, value:value};
        await axios.get('/api/userinfos').then((response)=>{axios.put('/api/users/' + response.data.id , data)}
        );
    }

    return {
        users,
        getUsers,
        updateUser
    }
}

