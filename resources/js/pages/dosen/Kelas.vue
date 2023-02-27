<template>
    <section class="px-4 mb-6 sm:px-16 pt-16 pb-8 my-6 font-quick">
        <div class="bg-gray-200 px-5 py-3 rounded-sm">
            <div class="">
                <h1 class="text-xl font-extrabold">
                    {{ kelas?.kelas.nama_kelas }} -
                    <span class="uppercase">
                        {{ kelas?.kelas.matakuliah.nama_mataKuliah }}
                    </span>
                    ({{ kelas?.kelas.matakuliah.kode_mataKuliah }})
                </h1>
                <div class="flex gap-3 mt-3">
                    <router-link :to="{ name: 'dosen.kelas.pengaturan', params: { id_kelas: route.params.id_kelas } }">
                        <button class="bg-emerald-500 px-2 py-1 rounded-md text-white col-span-1">
                            <i class="fas fa-sliders-h"></i>
                            Pengaturan Kelas
                        </button>
                    </router-link>
                    <button @click="goToPengaturanMatakuliah(kelas?.kelas.id_matakuliah)" class="bg-emerald-500 px-2 py-1 rounded-md text-white col-span-1">
                        <i class="fas fa-sliders-h"></i>
                        Pengaturan Matakuliah
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-3">
            <router-link :to="{ name: 'dosen.mahasiswa.list', params: { id_kelas: route.params.id_kelas } }">
                <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                    <p>List Mahasiswa</p>
                    <div class="text-7xl">{{ kelas?.enrolled.length }}</div>
                    <i class="fas fa-user-friends text-7xl text-gray-400 opacity-30 absolute right-5 top-7"></i>
                </div>
            </router-link>
            <router-link :to="{ name: 'dosen.mahasiswa.apply', params: { id_kelas: route.params.id_kelas } }">
                <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                    <p>Validasi Join Kelas</p>
                    <div class="text-7xl">{{ kelas?.applying.length }}</div>
                    <i class="fas fa-user-check text-7xl text-gray-400 opacity-30 absolute right-5 top-7"></i>
                </div>
            </router-link>
            <router-link :to="{ name: 'dosen.mahasiswa.unlock', params: { id_kelas: route.params.id_kelas } }">
                <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                    <p>Buka Kunci Mahasiswa</p>
                    <div class="text-7xl">{{ needUnlock?.length }}</div>
                    <i class="fas fa-user-lock text-7xl text-gray-400 opacity-30 absolute right-5 top-7"></i>
                </div>
            </router-link>
            <router-link :to="{ name: 'dosen.tes.formatif', params: { id_kelas: route.params.id_kelas } }">
                <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                    <p>Kontrol Proses Pembelajaran</p>
                    <i class="fas fa-calendar text-3xl text-gray-400 opacity-30 absolute right-5 top-4"></i>
                </div>
            </router-link>
            <router-link :to="{ name: 'dosen.tes.sumatif', params: { id_kelas: route.params.id_kelas } }">
                <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                    <p>Informasi Tes Sumatif</p>
                    <i class="fas fa-feather-alt text-3xl text-gray-400 opacity-30 absolute right-5 top-4"></i>
                </div>
            </router-link>
        </div>
    </section>
</template>
<script setup>
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { onBeforeMount, onMounted, ref } from "@vue/runtime-core";
import axios from "axios";

// dependensi penting
const authStore = useAuthStore();
const route = useRoute();
const router = useRouter();

onMounted(() => {
    getKelas();
    getLocked();
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

// Untuk Data Unlock
const needUnlock = ref();
const getLocked = () => {
    axios
        .get(`/api/SiswaManagementController/${route.params.id_kelas}/Locked/`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            needUnlock.value = res.data;
            console.log("Need Unlock : ", res.data);
        });
};

// Route error fix here
const goToPengaturanMatakuliah = (id_matakuliah) => {
    router.push({ name: "dosen.matakuliah.pengaturan.subcpmk", params: { id_matakuliah: id_matakuliah } });
};
</script>
