<template>
    <div>
        <index-navbar />
        <section class="px-4 sm:px-16 lg:px-32 pt-16 pb-8">
            <!-- Welcome -->
            <div class="bg-gray-100 px-5 py-3 mt-3">
                <span class="text-2xl mr-2">Selamat Datang</span>
                <span class="text-xl uppercase italic font-bold"
                    >"{{ authStore.authUser.name }}" 👋</span
                >
                <div class="text-sm font-light italic">
                    Jaga selalu kerahasiaan username dan password anda.
                </div>
            </div>

            <!-- Kelas Saya -->
            <div class="mt-5">
                <div class="bg-gray-100 w-full py-3 px-6 rounded-sm shadow-sm">
                    <h1 class="text-xl font-medium text-emerald-700">
                        Daftar Kelas Kuliah Saya
                    </h1>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3"
                >
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
                                {{ kls.nama_kelas }} - [ SMT{{
                                    kls.semester_kelas
                                }}
                                - {{ kls.tahun_kelas }}/{{
                                    parseInt(kls.tahun_kelas) + 1
                                }}
                                ]
                            </h4>
                        </blockquote>
                        <div class="px-4 pb-2">
                            <button
                                @click.prevent="masukKelas(kls.id_kelas, index)"
                                type="button"
                                class="bg-indigo-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            >
                                <i class="fas fa-sign-in-alt mr-3"></i>
                                Masuk Kelas
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cari Kelas -->
            <!-- <div class="mt-5">
                <div class="bg-gray-100 w-full py-3 px-6 rounded-sm shadow-sm">
                    <h1 class="text-xl font-medium text-emerald-700">
                        Cari Kelas
                    </h1>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3"
                >
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
                                {{ kls.nama_kelas }} - [ SMT{{
                                    kls.semester_kelas
                                }}
                                - {{ kls.tahun_kelas }}/{{
                                    parseInt(kls.tahun_kelas) + 1
                                }}
                                ]
                            </h4>
                        </blockquote>
                        <div class="px-4 pb-2">
                            <button
                                class="bg-indigo-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button"
                            >
                                <i class="fas fa-star mr-3"></i>
                                Apply Kelas
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>
        <footer-component />
    </div>
</template>

<script setup>
import IndexNavbar from "@/pages/components/Navbars/IndexNavbarMahasiswa.vue";
import FooterComponent from "@/pages/components/Footers/FooterDosen.vue";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import { onMounted, ref } from "@vue/runtime-core";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const kelasStore = useKelasStore();
const router = useRouter();
const kelas = ref(null);

const masukKelas = async (id_kelas, idx_kelas) => {
    kelasStore.kelas = kelas.value[idx_kelas];
    router.push("/u/kelas/" + id_kelas);
};
const getAprovedClass = async () => {
    await axios
        .get("/api/getApprovedKelas", {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            kelas.value = res.data.kelas;
        });
};

onMounted(async () => {
    await getAprovedClass();
});
</script>
