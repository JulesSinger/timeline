import './bootstrap';
import '../sass/app.scss'
import Router from './router/router.js'
import App from './App.vue'
import store from './store'
import Toaster from '@meforma/vue-toaster';
import { createApp } from 'vue/dist/vue.esm-bundler';
import 'vuetify/styles'

import { createVuetify } from 'vuetify';
const vuetify = createVuetify()
const app = createApp(App)
app.use(Router)
app.use(store)
app.use(vuetify)
app.use(Toaster).provide('toast', app.config.globalProperties.$toast);
app.mount('#app')