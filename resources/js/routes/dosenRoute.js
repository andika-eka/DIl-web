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
                path: "/d/setting/:id",
                name: "/d/setting",
                component: () =>
                    import("@/pages/dosen/pengaturan/SettingKelas.vue"),
            },
            {
                path: "/d/select-matakuliah",
                name: "/d/select-matakuliah",
                component: () =>
                    import("@/pages/dosen/pengaturan/PilihMatakuliah.vue"),
            },
            {
                path: "/d/tambah-kelas",
                name: "/d/tambah-kelas",
                component: () =>
                    import("@/pages/dosen/pengaturan/TambahKelas.vue"),
            },
            {
                path: "/d/sub-cpmk",
                name: "/d/sub-cpmk",
                component: () => import("@/pages/dosen/pengaturan/SubCPMK.vue"),
            },
            {
                path: "/d/indikator",
                name: "/d/indikator",
                component: () =>
                    import("@/pages/dosen/pengaturan/Indikator.vue"),
            },
            {
                path: "/d/test-sumatif/:idKelas",
                name: "/d/test-sumatif",
                component: () =>
                    import("@/pages/dosen/daftar-mahasiswa/TestSumatif.vue"),
            },
            {
                path: "/d/test-formatif/:idKelas",
                name: "/d/test-formatif",
                component: () =>
                    import("@/pages/dosen/daftar-mahasiswa/TestFormatif.vue"),
            },
            {
                path: "/d/list-mahasiswa/:idKelas",
                name: "/d/list-mahasiswa",
                component: () =>
                    import("@/pages/dosen/daftar-mahasiswa/ListMahasiswa.vue"),
            },
        ],
    },
];

export default routes;
