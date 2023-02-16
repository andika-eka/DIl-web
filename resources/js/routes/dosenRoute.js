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
                name: "/d/dashboard",
                component: () => import("@/pages/dosen/Dashboard.vue"),
            },
            {
                path: "/d/kelas/:id_kelas",
                name: "/d/kelas",
                component: () => import("@/pages/dosen/Kelas.vue"),
            },
            {
                path: "/d/p-kelas/:id",
                name: "/d/p-kelas",
                component: () => import("@/pages/dosen/pengaturan-kelas/SettingKelas.vue"),
            },
            {
                path: "/d/p-matakuliah/:idmatakuliah/sub-cpmk",
                name: "/d/p-matakuliah/sub-cpmk",
                component: () => import("@/pages/dosen/pengaturan/SubCPMK.vue"),
            },
            {
                path: "/d/p-matkul/indikator",
                name: "/d/indikator",
                component: () => import("@/pages/dosen/pengaturan/Indikator.vue"),
            },
            {
                path: "/d/test-sumatif/:idKelas",
                name: "/d/test-sumatif",
                component: () => import("@/pages/dosen/daftar-mahasiswa/TestSumatif.vue"),
            },
            {
                path: "/d/test-formatif/:idKelas",
                name: "/d/test-formatif",
                component: () => import("@/pages/dosen/daftar-mahasiswa/TestFormatif.vue"),
            },
            {
                path: "/d/list-mahasiswa/:idKelas",
                name: "/d/list-mahasiswa",
                component: () => import("@/pages/dosen/daftar-mahasiswa/ListMahasiswa.vue"),
            },
        ],
    },
];

export default routes;
