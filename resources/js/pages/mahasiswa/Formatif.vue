<template>
    <div>
        <nav class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow">
            <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                <div class="w-full relative flex items-center justify-between">
                    <router-link :to="'/u/kelas/' + route.params.id">
                        <div class="bg-gray-100 hover:bg-gray-200 shadow-md px-4 py-2.5 rounded flex items-center">
                            <i class="fas fa-chevron-left mr-2 p-1 rounded"></i>
                            <span class="font-quick text-sm"> Materi Belajar </span>
                        </div>
                    </router-link>
                    <h1 class="text-xl font-bold tracking-tight text-gray-900 uppercase">
                        {{ kelas?.matakuliah.nama_mataKuliah }} -
                        {{ kelas?.matakuliah.kode_mataKuliah }}
                    </h1>
                </div>
            </div>
        </nav>
        <section class="px-4 sm:px-8 lg:px-16 pb-8">
            <div class="bg-white pb-24">
                <div>
                    <!-- Mobile filter dialog -->
                    <!-- <TransitionRoot as="template" :show="mobileFiltersOpen">
                            <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                                </TransitionChild>

                                <div class="fixed inset-0 z-40 flex">
                                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="translate-x-full">
                                        <DialogPanel class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                            <div class="flex items-center justify-between px-4">
                                                <h2 class="text-lg font-medium text-gray-900">Unit</h2>
                                                <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400" @click="mobileFiltersOpen = false">
                                                    <span class="sr-only">Close menu</span>
                                                    <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                                </button>
                                            </div>

                                            <form class="mt-4 border-t border-gray-200">
                                                <h3 class="sr-only">Categories</h3>
                                                <ul role="list" class="px-2 py-3 font-medium text-gray-900">
                                                    <li v-for="materi in subCategories" :key="materi.name">
                                                        <a :href="materi.href" class="block px-2 py-3">{{ materi.name }}</a>
                                                    </li>
                                                </ul>

                                                <Disclosure as="div" v-for="section in filters" :key="section.id" class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                                                    <h3 class="-mx-2 -my-3 flow-root">
                                                        <DisclosureButton class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                                                            <span class="font-medium text-gray-900">{{ section.name }}</span>
                                                            <span class="ml-6 flex items-center">
                                                                <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                                <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                            </span>
                                                        </DisclosureButton>
                                                    </h3>
                                                    <DisclosurePanel class="pt-6">
                                                        <div class="space-y-6">
                                                            <div v-for="(option, optionIdx) in section.options" :key="option.value" class="flex items-center">
                                                                <input :id="`filter-mobile-${section.id}-${optionIdx}`" :name="`${section.id}[]`" :value="option.value" type="checkbox" :checked="option.checked" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                                                <label :for="`filter-mobile-${section.id}-${optionIdx}`" class="ml-3 min-w-0 flex-1 text-gray-500">{{ option.label }}</label>
                                                            </div>
                                                        </div>
                                                    </DisclosurePanel>
                                                </Disclosure>
                                            </form>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </Dialog>
                        </TransitionRoot> -->

                    <main class="mx-auto max-w-7xl">
                        <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
                            <p class="font-bold text-2xl">Sesi Tes Formatif</p>
                            <div class="flex items-center">
                                <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden" @click="mobileFiltersOpen = true">
                                    <span class="sr-only">Materi</span>
                                    <Squares2X2Icon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>

                        <section aria-labelledby="products-heading" class="py-6">
                            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                                <div :class="formatif?.current ? 'col-span-4' : 'col-span-3'" class="grid gap-x-8 gap-y-10 lg:grid-cols-4">
                                    <section v-if="formatif?.current === null" aria-labelledby="products-heading" class="col-span-4 pb-24">
                                        <h1 class="text-xl font-medium mb-5">
                                            <span class="capitalize"> Tes Formatif Sub-CPMK "{{ currentUnit?.current.narasi_subCpmk }}" </span>
                                            <ul class="text-md italic font-light">
                                                <span class="font-bold"> Perhatian: </span>
                                                <li class="text-md">- Semua materi pada Sub-CPMK ini sudah anda lalui, silakan mulai mengerjakan tes formatif untuk mengukur tingkat penguasaan Anda.</li>
                                                <li class="text-md">
                                                    - Anda mempunyai kesempatan <strong>{{ kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length }} kali</strong> untuk melakukan tes formatif.
                                                </li>
                                                <li v-if="formatif?.completed.length != 0 && formatif?.completed.at(-1).status_TesFormatif == 2 && kelas.settings.waktu_tunggu_formatif > 0 && remidiTimestamp.h >= 0" class="text-md">
                                                    - Anda bisa melakukan tes formatif (remidi) berikutnya pada <strong>{{ waktuTungguRemidi }}</strong>
                                                </li>
                                                <li>
                                                    - Kriteria Ketuntasan Minimum (KKM) pada Tes Formatif ini adalah <strong>{{ kelas?.settings.KKM }}%</strong>.
                                                </li>
                                            </ul>
                                        </h1>
                                        <div class="mt-3 flex justify-start items-center">
                                            <button @click.prevent="createFormatif()" :class="formatif?.completed.length != 0 && formatif?.completed.at(-1).status_TesFormatif == 2 && kelas.settings.waktu_tunggu_formatif > 0 && remidiTimestamp.h >= 0 ? 'bg-red-500 hover:bg-red-600' : 'bg-emerald-500 hover:bg-emerald-600'" class="text-xl font-bold px-6 py-3 rounded text-white">Mulai Tes Formatif</button>
                                            <div v-if="formatif?.completed.length != 0 && formatif?.completed.at(-1).status_TesFormatif == 2 && kelas.settings.waktu_tunggu_formatif > 0 && remidiTimestamp.h >= 0" class="ml-3 bg-gray-200 px-6 py-3 text-xl rounded">
                                                {{ `${remidiTimestamp.h < 10 ? "0" + remidiTimestamp.h : remidiTimestamp.h}:${remidiTimestamp.m < 10 ? "0" + remidiTimestamp.m : remidiTimestamp.m}:${remidiTimestamp.s < 10 ? "0" + remidiTimestamp.s : remidiTimestamp.s}` }}
                                            </div>
                                        </div>
                                    </section>
                                    <template v-else>
                                        <div class="lg:col-span-3">
                                            <div class="mb-2 text-lg">
                                                <p class="font-bold text-xl">Perhatian:</p>
                                                <p class="italic">Soal yang sedang aktif adalah soal yang sedang anda kerjakan. Jika beralih ke soal berikutnya, silakan pilih nomor soal pada daftar soal di sebelah kanan</p>
                                            </div>
                                            <div class="bg-gray-200 px-3 py-2 rounded">
                                                <p class="text-xl">
                                                    <!-- <img :src="soal?.soal.pathFileGambar_soal" alt="" /> -->
                                                    <img :src="'/public/files/soal/1675529781.png'" alt="" />
                                                    <!-- {{ soal?.soal.pathFileGambar_soal }} -->
                                                    {{ soal?.soal?.soal }}
                                                </p>
                                            </div>
                                            <div>
                                                <form class="grid grid-cols-2 gap-2 mt-3">
                                                    <label :for="'jawaban' + index" v-for="(item, index) in soal?.soal?.jawaban" :key="index" class="bg-gray-200 col-span-1 px-6 py-3 rounded shadow flex items-center justify-left text-left cursor-pointer">
                                                        <input :id="'jawaban' + index" :value="item.noUrut_pilihan" type="radio" v-model="selectedJawaban" />
                                                        <span class="ml-3 text-xl">
                                                            {{ item.teks_pilihan }}
                                                        </span>
                                                    </label>
                                                </form>
                                            </div>
                                            <div class="mt-3 flex items-center justify-between">
                                                <div class="bg-slate-800 text-white px-6 py-3 text-xl rounded">{{ soalTime.h < 10 ? `0${soalTime.h}` : soalTime.h }} : {{ soalTime.h < 10 ? `0${soalTime.h}` : soalTime.h }} : {{ soalTime.h < 10 ? `0${soalTime.h}` : soalTime.h }}</div>
                                                <button class="rounded bg-red-500 hover:bg-red-600 px-6 py-3 text-white text-lg uppercase" @click="finishFormatif(selectedJawaban)">Selesai</button>
                                            </div>
                                        </div>

                                        <form class="hidden lg:block">
                                            <ul role="list" class="space-y-2 border-b border-gray-200 pb-6 text-lg capitalize text-gray-900">
                                                <li class="text-xl">Daftar Soal</li>
                                            </ul>

                                            <form class="grid grid-cols-5 gap-2 mt-3 text-lg">
                                                <label :for="'soal' + index" v-for="(item, index) in soalCount" :key="index" class="cursor-pointer bg-gray-200 col-span-1 px-2 py-3 rounded text-center shadow text-xl">
                                                    {{ index + 1 }}
                                                    <input :id="'soal' + index" :value="index + 1" type="radio" v-model="selectedSoal" />
                                                </label>
                                            </form>
                                        </form>
                                    </template>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </section>
        <footer-component />
    </div>
</template>

<script setup>
import { Dialog, DialogPanel, Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { MinusIcon, PlusIcon, Squares2X2Icon, PaperClipIcon } from "@heroicons/vue/20/solid";
import IndexNavbar from "@/pages/components/Navbars/IndexNavbarMahasiswa.vue";
import FooterComponent from "@/pages/components/Footers/FooterDosen.vue";
import { useAuthStore } from "@/stores/auth";
import { onBeforeUnmount, onMounted, onUnmounted, onUpdated, reactive, ref, watch, watchEffect } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";

const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();

const kelas = ref();
const matakuliah = ref();
const currentUnit = ref();
const currentMateri = ref();
const materiList = ref();
const formatif = ref();
const soalInfo = ref();
const soalCount = ref();
const soal = ref(null);
const selectedSoal = ref(1);
const selectedJawaban = ref();
const materiExits = ref(true);
const selectedMateri = ref({
    currentMateri: null,
    id_subCPMK: null,
});
const waktuTungguRemidi = ref();

const remidiTimestamp = ref({
    h: 0,
    m: 0,
    s: 0,
});

const soalTime = ref({
    h: 0,
    m: 0,
    s: 0,
});

const getKelas = () => {
    axios
        .get(`/api/Kelas/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            kelas.value = res.data.kelas;
            console.log("Kelas", res.data.kelas);
            getMatakuliah(res.data.kelas.matakuliah.id_matakuliah);
        });
};

const getMatakuliah = (id_matakuliah) => {
    axios
        .get(`/api/Matakuliah/${id_matakuliah}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            matakuliah.value = res.data;
            console.log("Matakuliah", res.data);
        });
};

const getCurrUnit = () => {
    axios
        .get(`/api/currentUnit/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            console.log("Curr Unit:", res.data);
            currentUnit.value = res.data;
            if (res.data.current.status_subcpmkpengambilan == 2) {
                formatifAttemp();
            }
        });
};

const getCurrMateri = () => {
    axios
        .get(`/api/currenMateri/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            console.log("Curr Materi:", res.data);
            currentMateri.value = res.data.currentMateri;
            selectedMateri.value.currentMateri = res.data.currentMateri;
            selectedMateri.value.id_subCPMK = res.data.materiList.id_subCpmk;
            materiList.value = res.data.materiList;
            materiExits.value = true;
        })
        .catch((err) => {
            materiExits.value = false;
        });
};

const nextMateri = async () => {
    await axios
        .patch(
            "/api/nextMateri/" + route.params?.id,
            {},
            {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            }
        )
        .then((res) => {
            if (res.data?.currentMateri !== null) {
                getCurrMateri();
            } else {
                router.go(0);
            }
        })
        .catch((err) => {
            Swal.fire("Anda belum boleh Lanjut", "Silakan tunggu beberapa saat lagi", "info");
        });
};

const createFormatif = () => {
    axios
        .patch(
            `/api/createTestformatif/${route.params.id}`,
            {},
            {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            }
        )
        .then(() => {
            startFormatif();
        })
        .catch((err) => {
            if (err.response.status == 422 && err.response.data.message == "current unit is not finished") {
                // Pop up peringantan jika mengambil formatif sebelum boleh mengambil
                Swal.fire("Peringatan", `Silakan baca materi terlebuh dahulu sebelum mengerjakan tes formatif`, "warning");
            } else {
                // Pop up peringantan menunggu jika mengulang
                Swal.fire("Peringatan", `Anda belum bisa melakukan tes formatif ulang`, "warning");
            }
        });
};

const startFormatif = () => {
    axios
        .patch(
            `/api/startTesFormatif/${route.params.id}`,
            {},
            {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            }
        )
        .then((res) => {
            router.go(0);
        })
        .catch((res) => {
            // Pop Up batas pengulangan habis
            Swal.fire("Skor Anda tetap belum memenuhi ketuntasan minimum dalam sub-CPMK ini", "Anda tidak memiliki kesempatan untuk mengikuti tes formatif ulang kembali. Silakan Anda segera menghubungi dosen pengajar untuk melakukan proses pendampingan", "warning");
        });
};

const formatifAttemp = async () => {
    await axios
        .get(`/api/TesFormatif/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            formatif.value = res.data;
            console.log("formatif", res.data);
            if (res.data.current !== null) {
                getSoal();
            }
        });
};

// Count Down Remidi
watch(formatif, () => {
    if (formatif.value?.completed.length != 0 && formatif.value?.completed.at(-1).status_TesFormatif == 2) {
        let end = new Date(formatif.value?.completed.at(-1).waktuSelesai_tesFormatif);
        end.setHours(end.getHours() + kelas.value?.settings.waktu_tunggu_formatif);

        let convert_to_utc = Date.UTC(end.getFullYear(), end.getMonth(), end.getDate(), end.getHours(), end.getMinutes(), end.getSeconds());
        waktuTungguRemidi.value = new Date(convert_to_utc);

        let remidiTimer = setInterval(() => {
            let localnow = new Date();
            let utcnow = new Date(localnow.getUTCFullYear(), localnow.getUTCMonth(), localnow.getUTCDate(), localnow.getUTCHours(), localnow.getUTCMinutes(), localnow.getUTCSeconds());
            let timeStampCountDown = Math.floor(new Date(end.getTime() - utcnow.getTime()).getTime() / 1000);
            if (timeStampCountDown < 0) {
                clearInterval(remidiTimer);
            }
            remidiTimestamp.value.h = Math.floor(timeStampCountDown / 3600);
            remidiTimestamp.value.m = Math.floor(timeStampCountDown / 60) % 60;
            remidiTimestamp.value.s = timeStampCountDown % 60;
        }, 1000);
    }
});

const getSoal = (no_urut_soal = 1) => {
    axios
        .get(`/api/getSoal/${route.params.id}/${no_urut_soal}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            soal.value = res.data;
            console.log("soal", soal.value);
            soalCount.value = res.data["soal count"];
            testInfo();
            let hasil = soalInfo.value.jawaban.find((jwb) => jwb.nomorUrut_soal === no_urut_soal);
            selectedJawaban.value = hasil.noUrut_pilihan;
            soalTimer(soalInfo.value?.tes.waktuMulai_TesFormatif, soalCount.value);
        });
};

// Count Down Soal
const soalTimer = async (usedDate, countSoal) => {
    console.log("test");
    const count = new Date(usedDate);
    let end = new Date(usedDate);
    end.setMinutes(end.getMinutes() + kelas.value?.settings.waktu_per_soal_formatif * countSoal);
    console.log(end, end.getMinutes(), kelas.value?.settings.waktu_per_soal_formatif, countSoal);
    let timer = setInterval(() => {
        let localnow = new Date();
        let utcnow = new Date(localnow.getUTCFullYear(), localnow.getUTCMonth(), localnow.getUTCDate(), localnow.getUTCHours(), localnow.getUTCMinutes(), localnow.getUTCSeconds());
        let timeStampCountDown = Math.floor(new Date(end.getTime() - utcnow.getTime()).getTime() / 1000);
        if (timeStampCountDown < 0) {
            clearInterval(timer);
        }
        console.log(soalTime.value.h);
        console.log(soalTime.value.m);
        console.log(soalTime.value.s);
        soalTime.value.h = Math.floor(timeStampCountDown / 3600);
        soalTime.value.m = Math.floor(timeStampCountDown / 60) % 60;
        soalTime.value.s = timeStampCountDown % 60;
    }, 1000);
};

const testInfo = () => {
    axios
        .get(`/api/currentTestInfo/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            soalInfo.value = res.data;
            console.log("Info Soal : ", res.data);
        });
};

const simpanJawaban = async (no_urut_soal) => {
    await axios
        .post(
            `/api/submitJawaban/${route.params.id}/${no_urut_soal}`,
            {
                noUrut_pilihan: selectedJawaban.value,
            },
            {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            }
        )
        .then(() => {
            Swal.fire({
                icon: "success",
                title: "Pilihan jawaban berhasil di simpan",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                },
            });
        });
};

const finishFormatif = async () => {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang sudah dikirim tidak akan bisa diubah kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Saya yakin!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .patch(
                    `/api/finishTesFormatif/${route.params.id}`,
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${authStore.authUser.api_token}`,
                        },
                    }
                )
                .then((res) => {
                    Swal.fire({}).then((e) => {
                        console.log(res, e);
                        if (res.data.status_TesFormatif == 3) {
                            Swal.fire("Selamat Anda sudah menguasai materi pada sub-CPMK ini dengan baik.", "Anda dinyatakan tuntas, dan dapat melanjutkan materi ke sub-CPMK berikutnya", "success").then(() => {
                                nextUnit();
                                router.push(`/u/kelas/${route.params.id}`);
                            });
                        } else if (res.data.status_TesFormatif == 2) {
                            Swal.fire("Skor Anda belum memenuhi ketuntasan minimum dalam sub-CPMK ini.", "Silakan Anda mengikuti tahap remidi melalui belajar kelompok dengan teknik “Tutor Sebaya” di luar sistem", "error").then(() => {
                                router.go(0);
                            });
                        }
                    });
                });
        }
    });
};

const nextUnit = () => {
    axios.patch(
        `/api/nextUnit/${route.params.id}`,
        {},
        {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        }
    );
};

const goToMateri = () => {
    router.push(`/u/kelas/${route.params.id}`);
};

watch(selectedSoal, () => {
    getSoal(selectedSoal.value);
    selectedJawaban.value = ref();
});

watch(selectedJawaban, () => {
    simpanJawaban(selectedSoal.value);
});

onMounted(() => {
    getKelas();
    formatifAttemp();
    getCurrUnit();
});

const mobileFiltersOpen = ref(false);
</script>
