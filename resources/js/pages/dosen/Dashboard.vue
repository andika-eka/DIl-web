<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8">
        <div class="bg-gray-100 px-5 py-3 my-3">
            <span class="text-2xl mr-2">Selamat Datang</span>
            <span class="text-xl uppercase italic font-bold"
                >"{{ authStore.authUser.name }}"👋
            </span>
            <div class="text-sm font-light italic">
                Jaga selalu kerahasiaan username dan password anda.
            </div>
        </div>
        <div class="bg-gray-100 shadow rounded-md flex items-center">
            <div class="bg-emerald-500 px-5 py-3 rounded-l-md">
                <i class="fas fa-book text-2xl text-white"></i>
            </div>
            <p class="text-2xl uppercase font-medium ml-3 text-gray-700">
                Daftar Kelas
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3">
            <div
                v-for="(kls, index) in kelas"
                :key="index"
                class="mt-4 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-emerald-500"
            >
                <img
                    alt="..."
                    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80"
                    class="w-full align-middle rounded-t-lg"
                />
                <blockquote class="p-4 mb-16">
                    <h4 class="text-xl font-bold text-white uppercase">
                        {{ kls.matkul?.nama_mataKuliah }}
                    </h4>
                    <p class="text-white uppercase">
                        {{ kls.nama_kelas }} - [ SMT{{ kls.semester_kelas }} -
                        {{ kls.tahun_kelas }}/{{
                            parseInt(kls.tahun_kelas) + 1
                        }}
                        ]
                    </p>
                </blockquote>
                <div class="px-4 absolute bottom-3 flex justify-between w-full">
                    <button
                        @click.prevent=""
                        class="bg-teal-600 hover:bg-teal-700 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150"
                        type="button"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Daftar Mahasiwa
                    </button>
                    <button
                        @click.prevent="goToSettingKelas(kls.id_kelas, index)"
                        class="bg-teal-600 hover:bg-teal-700 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150"
                        type="button"
                    >
                        <i class="fas fa-gear mr-2"></i>
                        Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import axios from "axios";
import patternVue from "@/assets/img/pattern_vue.png";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import { onMounted, ref } from "@vue/runtime-core";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const kelasStore = useKelasStore();
const router = useRouter();
const kelas = ref([]);
const matakuliah = ref([]);

const goToSettingKelas = (id, index) => {
    kelasStore.kelas = kelas.value[index];
    router.push(`/d/setting/${id}`);
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
