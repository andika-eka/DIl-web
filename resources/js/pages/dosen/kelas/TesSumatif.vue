<template>
    <section class="px-4 mb-6 sm:px-16 pt-16 pb-8 my-6 font-quick">
        <div class="bg-gray-200 px-5 py-3 rounded-sm">
            <div class="flex justify-between">
                <h1 class="text-xl font-extrabold">
                    {{ kelas?.kelas.nama_kelas }} -
                    <span class="uppercase">
                        {{ kelas?.kelas.matakuliah.nama_mataKuliah }}
                    </span>
                    ({{ kelas?.kelas.matakuliah.kode_mataKuliah }})
                </h1>
            </div>
        </div>
        <div class="relative mt-3 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-lg">Daftar Tes Sumatif</h3>
                    </div>
                </div>
            </div>
            <div class="block w-full overflow-x-auto relative p-8">
                <!-- Projects table -->
                <table id="mahasiswa_table" class="display w-full">
                    <thead>
                        <tr>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Email Siswa</th>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Identitas Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in kelas?.applying" :key="index">
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{ item.email_siswa }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">{{ item.identitas_siswa }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";
import axios from "axios";

import DataTable from "datatables.net-vue3";
import DataTablesLib from "datatables.net";
DataTable.use(DataTablesLib);

// dependensi penting
const authStore = useAuthStore();
const route = useRoute();
const router = useRouter();

onMounted(() => {
    getKelas();
    $(document).ready(function () {
        $("#mahasiswa_table").DataTable({
            paging: true,
            ordering: true,
            info: false,
        });
    });
});

// Untuk Data Kelas
const kelas = ref();
const getKelas = () => {
    axios
        .get(`/api/Kelas/${route.params.id_kelas}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            kelas.value = res.data;
            console.log("Kelas :", res.data);
        });
};
</script>

<style>
@import "datatables.net-dt";
</style>
