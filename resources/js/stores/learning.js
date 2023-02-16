import { defineStore } from "pinia";

export const useLearningStore = defineStore("learning", {
    state: () => ({
        materiList: {},
        currentMateri: {},
        currentUnit: {},
        mataKuliah: {},
    }),
    actions: {},
});
