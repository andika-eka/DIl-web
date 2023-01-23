<template>
    <section
        class="px-4 mb-6 sm:px-16 lg:px-32 grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3 pt-16 pb-8"
    >
        <!-- Searching -->

        <!-- Loop Items -->
        <div v-for="kls in kelas" :key="kls">
            <div
                class="mt-4 h-[250px] relative flex flex-col min-w-0 break-words w-full shadow-lg rounded-lg bg-emerald-500"
            >
                <img
                    alt="..."
                    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=lQT_bOWtysE&auto=format&fit=crop&w=500&q=80"
                    class="w-full h-[150px] object-cover align-middle rounded-t-lg"
                />
                <blockquote class="relative p-4">
                    <h4 class="text-xl font-bold text-white uppercase">
                        {{ kls.nama_kelas }} - [ {{ kls.semester_kelas }}
                        {{ kls.tahun_kelas }}/{{ kls.tahun_kelas + 1 }} ]
                    </h4>
                </blockquote>
                <div class="px-4 pb-4 absolute bottom-0 right-0">
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
            console.log(res.data.kelas[0]);
        });
};

onMounted(() => {
    getPengampuan();
});
</script>
