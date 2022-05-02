require('./bootstrap');
import Toast from '@meforma/vue-toaster';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from "vue";
import router from './router';
import Chats from './components/Chats';
import UserIndex from './components/UserIndex';

const app = createApp({
    components:{
        Chats,
        UserIndex
    }
}).use(router).use(Toast, {
    // One of the options
    position: 'bottom'
})
.mount('#app');


