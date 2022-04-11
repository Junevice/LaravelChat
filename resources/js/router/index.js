import {createRouter, createWebHistory} from 'vue-router';
import UserIndex from '../components/UserIndex';
import Messages from '../pages/Messages';
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
        component: Messages,
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