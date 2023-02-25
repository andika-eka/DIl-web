// Import global
import globalVar from "@/variable.js";

// middleware untuk admin
const isAdmin = (to, from, next) => {
    if (auth.user.tipe_pengguna == 1) {
        next();
    }
};

// route untuk admin pages
const routes = [
    {
        path: `${globalVar.base_url}/a`,
        redirect: `${globalVar.base_url}/a/dashboard`,
        component: () => import("@/pages/layouts/Admin.vue"),
        meta: {
            role: "admin",
            requireAuth: true,
        },
        children: [
            {
                path: `${globalVar.base_url}/a/dashboard`,
                name: "admin.dashboard",
                component: () => import("@/pages/admin/Dashboard.vue"),
            },
            {
                path: `${globalVar.base_url}/a/settings`,
                name: "admin.settings",
                component: () => import("@/pages/admin/Settings.vue"),
            },
            {
                path: `${globalVar.base_url}/a/list-user`,
                name: "admin.user.list",
                component: () => import("@/pages/admin/user/ListUser.vue"),
            },
            {
                path: `${globalVar.base_url}/a/register-new-user`,
                name: "admin.user.add",
                component: () => import("@/pages/admin/user/AddNewUser.vue"),
            },
            {
                path: `${globalVar.base_url}/a/list-matakuliah`,
                name: "admin.matakuliah.list",
                component: () => import("@/pages/admin/matakuliah/ListMatakuliah.vue"),
            },
            {
                path: `${globalVar.base_url}/a/add-matakuliah`,
                name: "admin.matakuliah.add",
                component: () => import("@/pages/admin/matakuliah/AddMatakuliah.vue"),
            },
            {
                path: `${globalVar.base_url}/a/list-kelas`,
                name: "admin.kelas.list",
                component: () => import("@/pages/admin/kelas/ListKelas.vue"),
            },
            {
                path: `${globalVar.base_url}/a/add-kelas`,
                name: "admin.kelas.add",
                component: () => import("@/pages/admin/kelas/AddKelas.vue"),
            },
        ],
    },
];

export default routes;
