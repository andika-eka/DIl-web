// middleware untuk admin
const isAdmin = (to, from, next) => {
    if (auth.user.tipe_pengguna == 1) {
        next();
    }
};

// route untuk admin pages
const routes = [
    {
        path: "/a",
        redirect: "/a/dashboard",
        component: () => import("@/pages/layouts/Admin.vue"),
        meta: {
            role: "admin",
            requireAuth: true,
        },
        children: [
            {
                path: "/a/dashboard",
                component: () => import("@/pages/admin/Dashboard.vue"),
            },
            {
                path: "/a/settings",
                component: () => import("@/pages/admin/Settings.vue"),
            },
            {
                path: "/a/tables",
                component: () => import("@/pages/admin/Tables.vue"),
            },
            {
                path: "/a/maps",
                component: () => import("@/pages/admin/Maps.vue"),
            },
        ],
    },
];

export default routes;
