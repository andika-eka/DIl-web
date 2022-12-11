// route untuk admin pages
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
];

export default routes;
