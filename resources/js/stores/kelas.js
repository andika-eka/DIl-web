import { defineStore } from "pinia";
import axios from "axios";

export const useKelasStore = defineStore("kelas", {
    state: () => ({
        kelas: null,
        subCpmk: null,
        indikator: null,
    }),
    actions: {
        createKelas: async function () {
            let kelasForm = {
                id_matakuliah: this.dataMatkul.id_matakuliah,
                tahun_kelas: this.kelas.tahun_kelas,
                semester_kelas: this.kelas.semester_kelas,
                nama_kelas: this.kelas.nama_kelas,
                tanggalBuat_kelas: Date.now(),
                tanggalMulai_kelas: this.kelas.tgl_mulai,
                tanggalSelsai_kelas: this.kelas.tgl_selesai,
                status_kelas: 1,
                jenis_kelas: 1,
            };
            await axios.post("/api/Kelas", kelasForm, {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            });
        },
        createSubCPMK: async function () {
            this.subCpmk.forEach(async (subCpmkForm) => {
                await axios.post(
                    `Matakuliah/${this.dataMatkul.id_matakuliah}/subcpmk`,
                    subCpmkForm,
                    {
                        headers: {
                            Authorization: `Bearer ${authStore.authUser.api_token}`,
                        },
                    }
                );
            });
        },
    },
});
