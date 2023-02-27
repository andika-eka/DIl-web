<template>
    <section class="px-4 mb-6 sm:px-16 pt-16 pb-8 my-6 font-quick">
        <div class="bg-gray-200 px-5 py-3 rounded-sm">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-extrabold">
                    {{ kelas?.kelas.nama_kelas }} -
                    <span class="uppercase">
                        {{ kelas?.kelas.matakuliah.nama_mataKuliah }}
                    </span>
                    ({{ kelas?.kelas.matakuliah.kode_mataKuliah }})
                </h1>
                <router-link :to="{ name: 'dosen.kelas', params: { id_kelas: route.params.id_kelas } }">
                    <div class="bg-white rounded flex justify-center items-center px-4 py-2">
                        <ArrowLeftIcon class="h-5 w-5" />
                        Kembali
                    </div>
                </router-link>
            </div>
        </div>
        <div class="relative mt-3 flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-lg">Buka Penguncian Mahasiswa</h3>
                    </div>
                </div>
            </div>
            <div class="block w-full overflow-x-auto relative p-8">
                <!-- Projects table -->
                <table id="unlock_mahasiswa" class="display w-full">
                    <thead>
                        <tr>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">No</th>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nim</th>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama Siswa</th>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Sub-CPMK Terkunci</th>
                            <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in locked" :key="index">
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{ index + 1 }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">{{ item.identitas_siswa }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{ item.nama_siswa }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{ item.narasi_subCpmk }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                <div>
                                    <button @click="unlockMahasiswa(item.id_subCpmkPengambilan)" class="bg-emerald-500 hover:bg-emerald-600 text-white p-2 rounded-md"><LockOpenIcon class="h-5 w-5" /></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ArrowLeftIcon, LockOpenIcon } from "@heroicons/vue/20/solid";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";
import axios from "axios";

import DataTable from "datatables.net-vue3";
import DataTablesLib from "datatables.net";
import Swal from "sweetalert2";
DataTable.use(DataTablesLib);

// dependensi penting
const authStore = useAuthStore();
const route = useRoute();
const router = useRouter();

onMounted(async () => {
    await getKelas();
    await getLocked();
    await $(document).ready(function () {
        $("#unlock_mahasiswa").DataTable({
            paging: true,
            ordering: true,
            info: false,
        });
    });
});

// Untuk Data Kelas
const kelas = ref();
const getKelas = async () => {
    await axios
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

// Untuk Locked
const locked = ref();
const getLocked = async () => {
    await axios
        .get(`api/SiswaManagementController/${route.params.id_kelas}/Locked/`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            locked.value = res.data;
            console.log("Locked :", res.data);
        });
};

// Unlock Mahasiswa
const unlockMahasiswa = (id_pengambilan_kelas) => {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Penguncian Mahasiswa ini akan di Buka",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Buka",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .patch(
                    `api/SiswaManagementController/unlock/${id_pengambilan_kelas}`,
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${authStore.authUser.api_token}`,
                        },
                    }
                )
                .then(() => {
                    Swal.fire("Berhasil!", "Penguncian berhasil dibuka", "success");
                    router.go(0);
                });
        }
    });
};
</script>

<style>
@import "datatables.net-dt";
</style>
