require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from "vue";
import router from './router';
import Chats from './components/Chats';

createApp({
    components:{
        Chats
    }
}).use(router)
.mount('#app');
