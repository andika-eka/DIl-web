import { defineStore } from "pinia";
import axios from "axios";

export const useKelasStore = defineStore("kelas", {
    state: () => ({
        dataMatkul: null,
        subCpmk: null,
        indikator: null,
    }),
    getters: {
        matkul: (state) => state.dataMatkul,
        getSubCpmk: (state) => state.subCpmk,
    },
    actions: {},
});
