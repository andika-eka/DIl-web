<template>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-white">Tambah Kelas Baru</h3>
                                <p class="mt-1 text-sm text-white">Silakan isi form berikut untuk menambahkan data kelas kuliah baru.</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form @submit.prevent="addKelas()">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <matakuliah-select />
                                            </div>
                                            <div class="col-span-2">
                                                <tahun-select />
                                            </div>
                                            <div class="col-span-4">
                                                <semester-select />
                                            </div>
                                            <div class="col-span-2">
                                                <kelas-kuliah-select />
                                            </div>
                                            <div class="col-span-4">
                                                <jenis-kelas-select />
                                            </div>
                                            <div class="col-span-6">
                                                <status-kelas-select />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import TahunSelect from "@/pages/components/Select/TahunSelect.vue";
import MatakuliahSelect from "@/pages/components/Select/MatakuliahSelect.vue";
import SemesterSelect from "@/pages/components/Select/SemesterSelect.vue";
import StatusKelasSelect from "@/pages/components/Select/StatusKelasSelect.vue";
import JenisKelasSelect from "@/pages/components/Select/JenisKelasSelect.vue";
import KelasKuliahSelect from "@/pages/components/Select/KelasKuliahSelect.vue";
import { ref } from "@vue/reactivity";
import Swal from "sweetalert2";
import { useKelasStore } from "@/stores/kelas";
import { useRouter } from "vue-router";

const kelasStore = useKelasStore();
const router = useRouter();
const selected = ref(null);

const addKelas = async () => {
    await kelasStore.makeDefaultDate();
    await kelasStore.createKelas().then((res) => {
        Swal.fire("Adding Success", "Data Kelas Berhasil ditambahkan", "success").then(() => {
            router.push({ name: "admin.kelas.list" });
        });
    });
};
</script>
