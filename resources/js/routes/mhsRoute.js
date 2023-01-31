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
        ],
    },
];

export default routes;
