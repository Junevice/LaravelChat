import {createRouter, createWebHistory} from 'vue-router';
import Chats from '../components/Chats';
import UserIndex from '../components/UserIndex'

const routes = [
    {
        path:'/dashboard',
        name:'chats',
        component:Chats
    },
    {
        path:'/userlist',
        name:'user.index',
        component: UserIndex,
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});