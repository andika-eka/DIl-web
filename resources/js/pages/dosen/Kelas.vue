<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <div class="bg-gray-200 px-5 py-3 rounded-sm">
            <div class="flex justify-between">
                <h1 class="text-lg font-extrabold">
                    {{ data?.kelas.nama_kelas }} -
                    <span class="uppercase">
                        {{ data?.kelas.matakuliah.nama_mataKuliah }}
                    </span>
                    ({{ data?.kelas.matakuliah.kode_mataKuliah }})
                </h1>
                <button
                    class="bg-emerald-500 px-2 py-1 rounded-md text-white text-sm"
                >
                    <i class="fas fa-sliders-h"></i>
                </button>
            </div>
            <p class="text-xs italic">
                Dosen Pengampu:
                {{ data?.kelas.pengajar.identitas_pengajar ?? "Nama Pengajar" }}
            </p>
        </div>

        <div class="mt-3 bg-gray-200 rounded-sm">
            <div class="px-5 py-3">
                <h1 class="text-md font-bold uppercase">Daftar Mahasiswa</h1>
                <p class="text-xs italic">
                    Daftar mahasiswa yang mengikuti kelas
                    <span class="font-bold">
                        {{ data?.kelas.matakuliah.nama_mataKuliah }}</span
                    >
                    ini.
                </p>
            </div>
            <div class="h-1 bg-gray-500" />
            <div class="px-5 py-3 overflow-x-scroll">
                <table id="kelas_table" class="display w-full">
                    <thead>
                        <tr>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Nama Kelas
                            </th>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Semester Kelas
                            </th>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Tahun Kelas
                            </th>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Jenis Kelas
                            </th>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Status Kelas
                            </th>
                            <th
                                class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data.enrolled" :key="index">
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                {{ item.nama_kelas }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                <span v-if="item.semester_kelas == 1"
                                    >Ganjil</span
                                >
                                <span v-else>Genap</span>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                {{ item.tahun_kelas }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                <span v-if="item.jenis_kelas == 1"
                                    >Reguler</span
                                >
                                <span v-else>International</span>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                <span v-if="item.status_kelas == 1">
                                    <i
                                        class="fas fa-circle text-emerald-500 mr-2"
                                    ></i>
                                    Aktif
                                </span>
                                <span v-else>
                                    <i
                                        class="fas fa-circle text-orange-500 mr-2"
                                    ></i>
                                    Non-Aktif
                                </span>
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                            >
                                <div class="space-x-2">
                                    <button
                                        class="px-3 py-2 bg-orange-500 rounded hover:bg-orange-600"
                                    >
                                        <i class="fas fa-pen text-white"></i>
                                    </button>
                                    <button
                                        class="px-3 py-2 bg-red-500 rounded hover:bg-red-600"
                                    >
                                        <i class="fas fa-trash text-white"></i>
                                    </button>
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
import { useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";

const authStore = useAuthStore();
const routes = useRoute();
const data = ref();

onMounted(async () => {
    await getKelas();
});

const getKelas = async () => {
    await axios
        .get(`/api/Kelas/${routes.params.id_kelas}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            data.value = res.data;
            console.log(res.data);
        });
};
</script>
