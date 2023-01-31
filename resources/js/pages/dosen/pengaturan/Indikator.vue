<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 mb-5">
            Buat Kelas Baru
        </h3>
        <navbar-new-mata-kuliah />
        <div
            class="my-3 p-4 text-3xl font-normal leading-normal text-emerald-800 mb-28"
        >
            <div v-for="(item, index) in subCpmk" :key="item">
                <div
                    :class="[
                        index != 0 ? 'mt-4' : '',
                        'md:grid md:grid-cols-3 md:gap-6',
                    ]"
                >
                    <div v-if="index === 0" class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Indikator
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan buat indikator disamping dengan benar,
                                sesuai dengan Sub-CPMK yang telah anda buat.
                            </p>
                        </div>
                    </div>
                    <div v-else class="md:col-span-1"></div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div
                                class="shadow-lg sm:overflow-hidden sm:rounded-md"
                            >
                                <div
                                    class="space-y-6 bg-white px-4 py-5 sm:p-6"
                                >
                                    <div class="flex justify-between">
                                        <h5 class="text-xl">
                                            Sub-CPMK {{ index + 1 }}
                                        </h5>
                                        <!-- <button
                                            class="py-2 px-3 bg-gray-400 hover:bg-gray-300 text-xs rounded-sm"
                                        >
                                            <i
                                                class="fas fa-minus text-white"
                                            ></i>
                                        </button> -->
                                    </div>
                                    <label
                                        for="company-website"
                                        class="block text-sm font-medium text-gray-700"
                                        >Daftar Indikator</label
                                    >
                                    <div
                                        v-for="(idk, idx) in indikator[index]"
                                        :key="idk"
                                    >
                                        <div
                                            class="flex justify-between items-center"
                                            style="margin-top: 0.75rem"
                                        >
                                            <span
                                                class="text-sm py-2 px-4 bg-emerald-500 text-white font-semibold mr-3 rounded-md"
                                                >{{ idx + 1 }}</span
                                            >
                                            <div
                                                class="flex rounded-md shadow-sm w-full"
                                            >
                                                <input
                                                    v-model="
                                                        idk.narasi_indikator
                                                    "
                                                    type="text"
                                                    placeholder="Narasi Indikator"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                            <button
                                                v-if="idx != 0"
                                                @click="
                                                    removeIndikator(index, idx)
                                                "
                                                type="button"
                                                class="bg-red-500 hover:bg-red-700 ml-3 py-3 px-4 rounded-md flex items-center justify-center"
                                            >
                                                <i
                                                    class="fas fa-trash text-white text-xs"
                                                ></i>
                                            </button>
                                            <div
                                                v-else
                                                class="bg-white ml-3 py-3 px-4 rounded-md flex items-center justify-center"
                                            >
                                                <i
                                                    class="fas fa-trash text-white text-xs"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="flex justify-between items-center"
                                            style="margin-top: 0.75rem"
                                        >
                                            <span
                                                class="text-sm py-2 px-4 bg-none text-white select-none font-semibold mr-3 rounded-md"
                                                >{{ idx + 1 }}</span
                                            >
                                            <div
                                                class="flex gap-2 rounded-md shadow-sm w-full"
                                            >
                                                <input
                                                    v-model="idk.pertemuanKe"
                                                    type="number"
                                                    placeholder="Pertemuan Ke"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                                <input
                                                    v-model="
                                                        idk.level_indikator
                                                    "
                                                    type="number"
                                                    placeholder="Level Indikator"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                            <div
                                                class="bg-white ml-3 py-3 px-4 rounded-md flex items-center justify-center"
                                            >
                                                <i
                                                    class="fas fa-trash text-white text-xs"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        @click="addIndikator(index)"
                                        type="button"
                                        class="bg-emerald-500 hover:bg-emerald-700 flex justify-between items-center text-white py-3 px-6 rounded-lg mt-12 text-sm"
                                    >
                                        <span
                                            class="uppercase mr-3 text-xs font-semibold"
                                            >Tambah Indikator
                                        </span>
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-between items-center bg-gray-100 mt-5 px-4 pt-2 pb-4"
            >
                <router-link to="/d/sub-cpmk">
                    <button
                        type="submit"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                    >
                        Sebelumnya
                    </button>
                </router-link>
                <button
                    @click="submitAll"
                    type="button"
                    class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                >
                    Selesai
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
import { useKelasStore } from "@/stores/kelas";
import { reactive, ref } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";

const kelasStore = useKelasStore();
const subCpmk = ref(kelasStore.subCpmk);
const indikator = reactive([]);

onMounted(() => {
    if (kelasStore.indikator === null) {
        kelasStore.subCpmk.forEach((el) => {
            indikator.push([
                {
                    narasi_indikator: "",
                    pertemuanKe: "",
                    level_indikator: "",
                },
            ]);
        });
    } else {
        if (kelasStore.indikator.length > kelasStore.subCpmk.length) {
            kelasStore.indikator = indikator;
        }
        kelasStore.indikator.forEach((el) => {
            indikator.push(el);
        });
        if (kelasStore.indikator.length < kelasStore.subCpmk.length) {
            for (
                let i = 0;
                i < kelasStore.subCpmk.length - kelasStore.indikator.length;
                i++
            ) {
                indikator.push([
                    {
                        narasi_indikator: "",
                        pertemuanKe: "",
                        level_indikator: "",
                    },
                ]);
            }
        }
    }
});

const addIndikator = (subCpmkIndex) => {
    indikator[subCpmkIndex].push({
        narasi_indikator: "",
        pertemuanKe: "",
        level_indikator: "",
    });
};

const removeIndikator = (subCpmkIndex, indikatorIndex) => {
    indikator[subCpmkIndex].splice(indikatorIndex, 1);
};

const submitAll = async () => {
    await axios.post(
        "/api/Kelas",
        {},
        {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        }
    );
};

watch(indikator, () => {
    kelasStore.indikator = indikator;
});
</script>
