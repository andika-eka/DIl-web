// import global variable
import globalVar from "@/variable.js";

// Route untuk mahasiswa
const routes = [
    {
        path: `${globalVar.base_url}/u`,
        redirect: `${globalVar.base_url}/u/dashboard`,
        component: () => import("@/pages/layouts/Mahasiswa.vue"),
        meta: {
            role: "mahasiswa",
            requireAuth: true,
        },
        children: [
            {
                path: `${globalVar.base_url}/u/dashboard`,
                name: "mahasiswa.dashboard",
                component: () => import("@/pages/mahasiswa/Dashboard.vue"),
            },
            {
                path: `${globalVar.base_url}/u/kelas/:id`,
                name: "mahasiswa.kelas",
                component: () => import("@/pages/mahasiswa/Kelas.vue"),
            },
            {
                path: `${globalVar.base_url}/u/kelas/:id/formatif`,
                name: "mahasiswa.formatif",
                component: () => import("@/pages/mahasiswa/Formatif.vue"),
            },
            {
                path: `${globalVar.base_url}/u/kelas/:id/sumatif`,
                name: "mahasiswa.sumatif",
                component: () => import("@/pages/mahasiswa/Sumatif.vue"),
            },
        ],
    },
];

export default routes;
