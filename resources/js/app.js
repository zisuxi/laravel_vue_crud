import './bootstrap';
import { createApp } from 'vue';
import router from './router/router';
import app from "./components/app.vue";
createApp(app).use(router).mount("#app");
