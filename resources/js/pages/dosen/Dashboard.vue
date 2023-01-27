<template>
    <section
        class="px-4 mb-6 sm:px-16 lg:px-32 grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3 pt-16 pb-8"
    >
        <!-- Searching -->

        <!-- Loop Items -->
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
            <blockquote class="relative p-4">
                <h4 class="text-xl font-bold text-white uppercase">
                    {{ kls.nama_kelas }} - [ SMT{{ kls.semester_kelas }} -
                    {{ kls.tahun_kelas }}/{{ parseInt(kls.tahun_kelas) + 1 }}
                    ]
                </h4>
            </blockquote>
            <div class="px-4 pb-2">
                <router-link :to="`/d/setting/${kls.id_kelas}`">
                    <button
                        class="bg-indigo-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button"
                    >
                        <i class="fas fa-gear"></i>
                        Settings
                    </button>
                </router-link>
            </div>
        </div>
    </section>
</template>

<script setup>
import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";

const authStore = useAuthStore();
const kelas = ref([]);

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

onMounted(() => {
    getPengampuan();
});
</script>
