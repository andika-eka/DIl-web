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
                        <h3 class="font-semibold text-lg">Sub-CPMK</h3>
                    </div>
                </div>
            </div>
            <div class="block w-full overflow-x-auto relative px-8 pb-4">
                <!-- Projects table -->
                <ul>
                    <li class="bg-gray-100 mt-3 px-4 py-2 rounded-md cursor-pointer hover:bg-gray-200" @click="goToDaftarTesFormatif(item.id_subCpmk)" v-for="(item, index) in matakuliah?.sub_cpmk" :key="index">
                        {{ item.narasi_subCpmk }}
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ArrowLeftIcon } from "@heroicons/vue/20/solid";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";
import axios from "axios";

// dependensi penting
const authStore = useAuthStore();
const route = useRoute();
const router = useRouter();

onMounted(() => {
    getKelas();
});

// Untuk Data matakuliah
const matakuliah = ref();
const getMatakuliah = (id_matakuliah) => {
    axios
        .get(`/api/Matakuliah/${id_matakuliah}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            matakuliah.value = res.data;
            console.log("Matakuliah :", res.data);
        });
};
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
            getMatakuliah(res.data.kelas.id_matakuliah);
            console.log("Kelas :", res.data);
        });
};

// Router
const goToDaftarTesFormatif = (id_sub_cpmk) => {
    // console.log(id_sub_cpmk);
    router.push({ name: "dosen.tes.formatif.detail", params: { id_kelas: route.params.id_kelas, id_sub_cpmk: id_sub_cpmk } });
};
</script>
