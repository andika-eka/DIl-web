import { defineStore } from "pinia";
import authAxios from "@/axios/auth";

export const useSubCPMKStore = defineStore("sub-cpmk", {
    state: () => ({
        subCpmk: null,
    }),
    actions: {
        createSubCPMK: async function () {
            this.subCpmk.forEach(async (subCpmkForm) => {
                await authAxios.post(
                    `Matakuliah/${this.dataMatkul.id_matakuliah}/subcpmk`,
                    subCpmkForm
                );
            });
        },
    },
});
