import "./bootstrap";

import "@fortawesome/fontawesome-free/css/all.min.css";

import { createApp, markRaw } from "vue";
import App from "./App.vue";
import { createPinia } from "pinia";
import { VueCookieNext } from "vue-cookie-next";
import { useCookie } from "vue-cookie-next";
import router from "./routes/route";

const pinia = createPinia();
const app = createApp(App);

app.use(VueCookieNext);
app.use(pinia);

pinia.use(({ store }) => {
    store.$router = markRaw(router);
    store.cookie = useCookie();
});
app.use(router);

// set default config
VueCookieNext.config({ expire: "-1" });

app.mount("#app");
