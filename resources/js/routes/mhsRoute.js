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
            },
            {
                path: "/u/kelas/:id/materi",
                component: () => import("@/pages/mahasiswa/kelas/Materi.vue"),
            },
            {
                path: "/u/kelas/:id/formatif",
                component: () => import("@/pages/mahasiswa/kelas/Formatif.vue"),
            },
        ],
    },
];

export default routes;
