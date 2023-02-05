import { defineStore } from "pinia";
import authAxios from "@/axios/auth";

export const useKelasStore = defineStore("kelas", {
    state: () => ({
        kelas: {
            id_matakuliah: null,
            tahun_kelas: null,
            semester_kelas: null,
            nama_kelas: null,
            tanggalBuat_kelas: null,
            tanggalMulai_kelas: null,
            tanggalSelesai_kelas: null,
            status_kelas: null,
            jenis_kelas: null,
        },
        kelasList: null,
    }),
    actions: {
        makeDefaultDate: async function () {
            function formatDate(date) {
                var d = new Date(date),
                    month = "" + (d.getMonth() + 1),
                    day = "" + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = "0" + month;
                if (day.length < 2) day = "0" + day;

                return [year, month, day].join("-");
            }
            this.kelas.tanggalBuat_kelas = formatDate(Date.now());
            this.kelas.tanggalMulai_kelas = formatDate(Date.now());
            this.kelas.tanggalSelesai_kelas = formatDate(Date.now());
        },
        createKelas: async function () {
            await authAxios.post("/api/Kelas", this.kelas).then((res) => {
                this.$reset();
            });
        },
    },
});
