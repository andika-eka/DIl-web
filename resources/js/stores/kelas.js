import { defineStore } from "pinia";
import axios from "axios";

export const useKelasStore = defineStore("kelas", {
    state: () => ({
        dataMatkul: null,
        kelas: null,
        subCpmk: null,
        indikator: null,
    }),
    actions: {},
});
