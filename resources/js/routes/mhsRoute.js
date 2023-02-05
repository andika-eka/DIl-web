// Route untuk mahasiswa
const routes = [
    {
        path: "/u",
        redirect: "/u/dashboard",
        component: () => import("@/pages/layouts/Mahasiswa.vue"),
        meta: {
            role: "mahasiswa",
            requireAuth: true,
        },
        children: [
            {
                path: "/u/dashboard",
                component: () => import("@/pages/mahasiswa/Dashboard.vue"),
            },
            {
                path: "/u/kelas/:id",
                component: () => import("@/pages/mahasiswa/Kelas.vue"),
                // redirect: "/u/kelas/:id/materi/:idindikator",
                // children: [
                //     {
                //         path: "/u/kelas/:id/materi/:idindikator",
                //         component: () =>
                //             import("@pages/mahasiswa/kelas/Materi.vue"),
                //     },
                // ],
            },
        ],
    },
];

export default routes;
