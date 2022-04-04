import {createRouter, createWebHistory} from 'vue-router';
import Conversation from '../components/Conversation';
import UserIndex from '../components/UserIndex';
import Chats from '../components/Chats';

const routes = [
    {
        path:'/dashboard',
        name:'Conversation',
        component:Conversation
    },
    {
        path:'/groups/:id',
        name: 'Groups',
        component:Chats,
    },
    {
        path:'/userlist',
        name:'user.index',
        component: UserIndex,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
});