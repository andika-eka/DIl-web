import { createRouter, createWebHistory } from "vue-router";

// import route
import adminRoute from "./adminRoute";
import authRoute from "./authRoute";
import webRoute from "./webRoute";

// tambahkan route disini dengan destructuring array
const routes = [...adminRoute, ...authRoute, ...webRoute];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
