require('bootstrap');
import {createApp} from 'vue/dist/vue.esm-bundler';
import {createPinia, PiniaVuePlugin} from 'pinia'
import playa from './src/Main.vue'
import VueDayjs from 'vue3-dayjs-plugin'
import './src/icons/font-awesome';
import './styles/main.scss';
import './bootstrap';
import "@vueform/slider/themes/default.css"
import router from './src/router/index'

const pinia = createPinia()
const app = createApp({
    components: {
        playa
    },
})
    .use(PiniaVuePlugin)
    .use(VueDayjs)
    .use(pinia)
    .use(router)
    .mount('#app')
