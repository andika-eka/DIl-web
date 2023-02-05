import { defineStore } from "pinia";
import authAxios from "@/axios/auth";

export const useIndikatorStore = defineStore("indikator", {
    state: () => ({
        indikator: null,
    }),
    actions: {},
});
