// import global variable
import globalVar from "@/variable.js";

// Route untuk Role Dosen
const routes = [
    {
        path: `${globalVar.base_url}/d`,
        redirect: `${globalVar.base_url}/d/dashboard`,
        component: () => import("@/pages/layouts/Dosen.vue"),
        meta: {
            role: "dosen",
            requireAuth: true,
        },
        children: [
            {
                path: `${globalVar.base_url}/d/dashboard`,
                name: "dosen.dashboard",
                component: () => import("@/pages/dosen/Dashboard.vue"),
            },
            {
                path: `${globalVar.base_url}/d/kelas/:id_kelas`,
                name: "dosen.kelas",
                component: () => import("@/pages/dosen/Kelas.vue"),
            },
            {
                path: `${globalVar.base_url}/d/p-kelas/:id_kelas`,
                name: "dosen.kelas.pengaturan",
                component: () => import("@/pages/dosen/pengaturan-kelas/SettingKelas.vue"),
            },
            {
                path: `${globalVar.base_url}/d/p-matkul/:id_matakuliah/sub-cpmk`,
                name: "dosen.matakuliah.pengaturan.subcpmk",
                component: () => import("@/pages/dosen/pengaturan-matakuliah/SubCPMK.vue"),
            },
            {
                path: `${globalVar.base_url}/d/p-matkul/:id_matakuliah/indikator`,
                name: "dosen.matakuliah.pengaturan.indikator",
                component: () => import("@/pages/dosen/pengaturan-matakuliah/Indikator.vue"),
            },
            {
                path: `${globalVar.base_url}/d/p-matkul/:id_matakuliah/materi`,
                name: "dosen.matakuliah.pengaturan.materi",
                component: () => import("@/pages/dosen/pengaturan-matakuliah/Materi.vue"),
            },
            {
                path: `${globalVar.base_url}/d/tes-sumatif/:id_kelas`,
                name: "dosen.tes.sumatif",
                component: () => import("@/pages/dosen/kelas/TesSumatif.vue"),
            },
            {
                path: `${globalVar.base_url}/d/tes-formatif/:id_kelas`,
                name: "dosen.tes.formatif",
                component: () => import("@/pages/dosen/kelas/TesFormatifPilihSubCPMK.vue"),
            },
            {
                path: `${globalVar.base_url}/d/tes-formatif/:id_kelas/:id_sub_cpmk`,
                name: "dosen.tes.formatif.detail",
                component: () => import("@/pages/dosen/kelas/TesFormatif.vue"),
            },
            // {
            //     path: `${globalVar.base_url}/d/tes-formatif/:id_kelas`,
            //     name: "dosen.tes.formatif.detail.soal",
            //     component: () => import("@/pages/dosen/kelas/TesFormatif.vue"),
            // },
            {
                path: `${globalVar.base_url}/d/list-mahasiswa/:id_kelas`,
                name: "dosen.mahasiswa.list",
                component: () => import("@/pages/dosen/kelas/ListMahasiswa.vue"),
            },
            {
                path: `${globalVar.base_url}/d/apply-mahasiswa/:id_kelas`,
                name: "dosen.mahasiswa.apply",
                component: () => import("@/pages/dosen/kelas/Applying.vue"),
            },
            {
                path: `${globalVar.base_url}/d/unlock-mahasiswa/:id_kelas`,
                name: "dosen.mahasiswa.unlock",
                component: () => import("@/pages/dosen/kelas/Unlock.vue"),
            },
        ],
    },
];

export default routes;
