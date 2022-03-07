require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from "vue";
import router from './router';
import Chats from './components/Chats';
import UserIndex from './components/UserIndex';
import { autoscroll } from 'vue-autoscroll';

const app = createApp({
    components:{
        Chats,
        UserIndex
    }
}).use(router)
.mount('#app');

