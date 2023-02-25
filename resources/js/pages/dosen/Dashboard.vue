<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8">
        <div class="bg-gray-100 px-5 py-3 my-3">
            <span class="text-2xl mr-2">Selamat Datang</span>
            <span class="text-xl uppercase italic font-bold">"{{ authStore.authUser.name }}"👋 </span>
            <div class="text-sm font-light italic">Jaga selalu kerahasiaan username dan password anda.</div>
        </div>
        <div class="bg-gray-100 shadow rounded-md flex items-center">
            <div class="bg-emerald-500 px-5 py-3 rounded-l-md">
                <i class="fas fa-book text-2xl text-white"></i>
            </div>
            <p class="text-2xl uppercase font-medium ml-3 text-gray-700">Daftar Kelas</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 md:gap-3">
            <div v-for="(kls, index) in kelas" :key="index">
                <div @click="openClass(kls.id_kelas)" class="cursor-pointer mt-4 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-emerald-500">
                    <img alt="..." src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80" class="w-full align-middle rounded-t-lg" />
                    <blockquote class="p-4 mb-16">
                        <h4 class="text-xl font-bold text-white uppercase">
                            {{ kls.nama_kelas }} - {{ kls.matkul?.nama_mataKuliah }} -
                            {{ kls.matkul?.kode_mataKuliah }}
                        </h4>
                        <p class="text-white uppercase">
                            [ SMT{{ kls.semester_kelas }} - {{ kls.tahun_kelas }}/{{ parseInt(kls.tahun_kelas) + 1 }}
                            ]
                        </p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import { onMounted, ref } from "@vue/runtime-core";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const kelasStore = useKelasStore();
const router = useRouter();
const kelas = ref([]);
const matakuliah = ref([]);

const openClass = (id_kelas) => {
    router.push({ name: "dosen.kelas", params: { id_kelas: id_kelas } });
};

const getPengampuan = async () => {
    await axios
        .get("/api/getPengampuanKelas", {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            kelas.value = res.data.kelas;
        });
};

const getAllMatakuliah = async () => {
    await axios
        .get("/api/Matakuliah", {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            matakuliah.value = res.data;
        });
};

onMounted(async () => {
    kelasStore.$reset();
    await getAllMatakuliah();
    await getPengampuan();

    kelas.value.forEach((data) => {
        matakuliah.value.forEach((matkul) => {
            if (matkul.id_matakuliah == data.id_matakuliah) {
                data.matkul = matkul;
            }
        });
    });
});
</script>
