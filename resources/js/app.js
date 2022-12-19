import "./bootstrap";

import "@fortawesome/fontawesome-free/css/all.min.css";

import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from "pinia";
import router from "./routes/route";

const pinia = createPinia();
const app = createApp(App);

app.use(pinia);
app.use(router);
app.mount("#app");
