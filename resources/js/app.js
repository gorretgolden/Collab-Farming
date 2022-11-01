

require ('./bootstrap');

import { createApp } from 'vue';
import welcome from './component/home/home';

import router from './router';



const app = createApp({});


app.component('fanmis-app', welcome);




app.use(router);

//$('#hhfhfhfh')

app.mount('#app');
