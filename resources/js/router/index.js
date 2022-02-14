import {createRouter, createWebHistory} from 'vue-router';
import Chats from '../components/Chats';

const routes = [
    {
        path:'/dashboard',
        name:'chats',
        component:Chats
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
});