import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("@/pages/Welcome.vue"),
    },
    {
        path: "/a/dashboard",
        name: "a.dashboard",
        component: () => import("@/pages/admin/Dashboard.vue"),
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
