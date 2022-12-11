// route untuk auth pages
const routes = [
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
];

export default routes;
