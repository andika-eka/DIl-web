import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/admin",
        redirect: "/admin/dashboard",
        component: () => import("@/pages/layouts/Admin.vue"),
        children: [
            {
                path: "/admin/dashboard",
                component: () => import("@/pages/admin/Dashboard.vue"),
            },
            {
                path: "/admin/settings",
                component: () => import("@/pages/admin/Settings.vue"),
            },
            {
                path: "/admin/tables",
                component: () => import("@/pages/admin/Tables.vue"),
            },
            {
                path: "/admin/maps",
                component: () => import("@/pages/admin/Maps.vue"),
            },
        ],
    },
    {
        path: "/auth",
        redirect: "/auth/login",
        component: () => import("@/pages/layouts/Auth.vue"),
        children: [
            {
                path: "/auth/login",
                component: () => import("@/pages/auth/Login.vue"),
            },
            {
                path: "/auth/register",
                component: () => import("@/pages/auth/Register.vue"),
            },
        ],
    },
    {
        path: "/landing",
        component: () => import("@/pages/Landing.vue"),
    },
    {
        path: "/profile",
        component: () => import("@/pages/Profile.vue"),
    },
    {
        path: "/",
        component: () => import("@/pages/index.vue"),
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

export default router;
