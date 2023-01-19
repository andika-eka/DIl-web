// Route untuk Role Dosen
const routes = [
    {
        path: "/d",
        redirect: "/d/dashboard",
        component: () => import("@/pages/layouts/Dosen.vue"),
        meta: {
            role: "dosen",
            requireAuth: true,
        },
        children: [
            {
                path: "/d/dashboard",
                component: () => import("@/pages/dosen/Dashboard.vue"),
            },
            {
                path: "/d/setting/:id",
                component: () => import("@/pages/dosen/SettingMatakuliah.vue"),
            },
            {
                path: "/d/new-matakuliah",
                component: () => import("@/pages/dosen/NewMatakuliah.vue"),
            },
            {
                path: "/d/sub-cpmk",
                component: () => import("@/pages/dosen/SubCPMK.vue"),
            },
            {
                path: "/d/indikator",
                component: () => import("@/pages/dosen/Indikator.vue"),
            },
        ],
    },
];

export default routes;
