import { createApp } from 'vue'
import VueCookies from 'vue3-cookies'

//Oruga UI
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import 'v-calendar/dist/style.css';
import VCalendar from 'v-calendar';

//Bootstrap
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

//Axios
import axios from 'axios';

//app
import App from "./App.vue";
import router from "./router/router";

//Material Design
import "@mdi/font/css/materialdesignicons.min.css";

const app = createApp(App).use(router).use(Oruga).use(VueCookies).use(VCalendar, {});
app.config.globalProperties.$axios = axios
window.axios = axios
app.mount("#app")

