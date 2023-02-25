<template>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded" :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-lg" :class="[color === 'light' ? 'text-slate-700' : 'text-white']">List Kelas</h3>
                </div>
                <!-- Add Button -->
                <router-link :to="{ name: 'admin.kelas.add' }">
                    <button class="bg-emerald-500 hover:bg-emerald-700 px-4 py-2 rounded-md text-white text-sm">
                        Add Kelas
                        <i class="fas fa-plus ml-2"></i>
                    </button>
                </router-link>
            </div>
        </div>
        <div class="block w-full overflow-x-auto relative p-8">
            <!-- Projects table -->
            <table id="kelas_table" class="display w-full">
                <thead>
                    <tr>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nama Kelas</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Semester Kelas</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Tahun Kelas</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Jenis Kelas</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Status Kelas</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data" :key="index">
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ item.nama_kelas }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <span v-if="item.semester_kelas == 1">Ganjil</span>
                            <span v-else>Genap</span>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            {{ item.tahun_kelas }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <span v-if="item.jenis_kelas == 1">Reguler</span>
                            <span v-else>International</span>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <span v-if="item.status_kelas == 1">
                                <i class="fas fa-circle text-emerald-500 mr-2"></i>
                                Aktif
                            </span>
                            <span v-else>
                                <i class="fas fa-circle text-orange-500 mr-2"></i>
                                Non-Aktif
                            </span>
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                            <div class="space-x-2">
                                <button class="px-3 py-2 bg-orange-500 rounded hover:bg-orange-600">
                                    <i class="fas fa-pen text-white"></i>
                                </button>
                                <button class="px-3 py-2 bg-red-500 rounded hover:bg-red-600">
                                    <i class="fas fa-trash text-white"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from "@vue/runtime-core";
import DataTable from "datatables.net-vue3";
import DataTablesLib from "datatables.net";

DataTable.use(DataTablesLib);

import authAxios from "@/axios/auth";
const data = ref(null);

const props = defineProps({
    color: {
        default: "light",
        validator: function (value) {
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

onMounted(async () => {
    await getKelas();
    await $(document).ready(function () {
        $("#kelas_table").DataTable({
            paging: true,
            ordering: true,
            info: false,
        });
    });
});

const getKelas = async () => {
    await authAxios.get("/api/Kelas").then((res) => {
        data.value = res.data;
    });
};
</script>

<style>
@import "datatables.net-dt";
</style>
