// Import global
import globalVar from "@/variable.js";

// route untuk auth pages
const routes = [
    {
        path: `${globalVar.base_url}/`,
        redirect: `${globalVar.base_url}/login`,
        component: () => import("@/pages/layouts/Auth.vue"),
        children: [
            {
                path: `${globalVar.base_url}/login`,
                name: "login",
                component: () => import("@/pages/auth/Login.vue"),
                meta: {
                    authRoute: true,
                },
            },
        ],
    },
];

export default routes;
