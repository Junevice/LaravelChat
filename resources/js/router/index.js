import {createRouter, createWebHistory} from 'vue-router';
import UserIndex from '../components/UserIndex';
import Chats from '../components/Chats';
import Dashboard from '../pages/Dashboard';
import Parameters from '../pages/Parameters';

const routes = [
    {
        path:'/dashboard',
        name:'Conversation',
        component: Dashboard,
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
    {
        path:'/parameters',
        name:'parameters.modifyProfile',
        component: Parameters,
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
});