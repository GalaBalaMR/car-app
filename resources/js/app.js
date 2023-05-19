import './bootstrap';
import * as bootstrap from 'bootstrap';

import {createApp} from 'vue'

import App from './page/App.vue'
import router from './router/Router'
import store from './store/Store'

createApp(App)
// Make sure to _use_ the router instance to make the
// whole app router-aware.
.use(router)
.use(store)
.mount('#app')