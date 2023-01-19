// route untuk auth pages

const routes = [
    {
        path: "/",
        redirect: "/login",
        component: () => import("@/pages/layouts/Auth.vue"),
        children: [
            {
                path: "/login",
                name: "login",
                component: () => import("@/pages/auth/Login.vue"),
                meta: {
                    authRoute: true,
                },
            },
            {
                path: "/register",
                component: () => import("@/pages/auth/Register.vue"),
                meta: {
                    authRoute: true,
                },
            },
        ],
    },
];

export default routes;
