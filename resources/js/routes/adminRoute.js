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
                path: "/a/list-user",
                component: () => import("@/pages/admin/ListUser.vue"),
            },
            {
                path: "/a/list-matakuliah",
                component: () => import("@/pages/admin/ListMatakuliah.vue"),
            },
            {
                path: "/a/add-matakuliah",
                component: () => import("@/pages/admin/AddMatakuliah.vue"),
            },
            {
                path: "/a/register-new-user",
                component: () => import("@/pages/admin/AddNewUser.vue"),
            },
            {
                path: "/a/list-kelas",
                component: () => import("@/pages/admin/ListKelas.vue"),
            },
            {
                path: "/a/add-kelas",
                component: () => import("@/pages/admin/AddKelas.vue"),
            },
        ],
    },
];

export default routes;
