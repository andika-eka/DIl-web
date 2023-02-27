<template>
    <div class="font-quick">
        <nav class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow">
            <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                <div class="w-full relative flex items-center justify-between">
                    <router-link :to="{ name: 'mahasiswa.kelas', params: { id: route.params.id } }" v-if="formatif?.current === null">
                        <div class="bg-red-500 hover:bg-red-600 text-white tex-lg font-black shadow-md px-4 py-2.5 rounded flex items-center">
                            <div class="mr-2 p-1 rounded">
                                <ArrowLeftIcon class="h-5 w-5" />
                            </div>
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
                    <TransitionRoot as="template" :show="mobileFiltersOpen">
                        <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="fixed inset-0 bg-black bg-opacity-25" />
                            </TransitionChild>

                            <div class="fixed inset-0 z-40 flex">
                                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="translate-x-full">
                                    <DialogPanel class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                        <div class="flex items-center justify-between px-4 mt-16">
                                            <h2 class="text-lg font-medium text-gray-900">Daftar Soal</h2>
                                            <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400" @click="mobileFiltersOpen = false">
                                                <span class="sr-only">Close menu</span>
                                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                            </button>
                                        </div>

                                        <div class="block px-4">
                                            <form class="grid grid-cols-5 gap-2 mt-3 text-lg">
                                                <label :for="'soal' + index" v-for="(item, index) in soalCount" :key="index" class="cursor-pointer bg-gray-200 col-span-1 px-2 py-3 rounded text-center shadow text-xl">
                                                    {{ index + 1 }}
                                                    <input :id="'soal' + index" :value="index + 1" type="radio" v-model="selectedSoal" />
                                                </label>
                                            </form>
                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </Dialog>
                    </TransitionRoot>

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
                                    <section v-if="formatif?.current === null || formatif?.current.waktuMulai_TesFormatif === null" aria-labelledby="products-heading" class="col-span-4 pb-24">
                                        <h1 class="text-xl font-medium mb-5">
                                            <span class="capitalize"> Tes Formatif Sub-CPMK "{{ currentUnit?.current.narasi_subCpmk }}" </span>
                                            <ul v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length > 0" class="text-md italic font-light">
                                                <span class="font-bold"> Perhatian: </span>
                                                <li class="text-md" v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length == kelas?.settings.batas_pengulangan_remidi">- Semua materi pada Sub-CPMK ini sudah anda lalui, silakan mulai mengerjakan tes formatif untuk mengukur tingkat penguasaan Anda.</li>
                                                <li class="text-md" v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length != kelas?.settings.batas_pengulangan_remidi">- Skor Anda belum memenuhi ketuntasan minimum dalam sub-CPMK ini.</li>
                                                <li class="text-md" v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length != kelas?.settings.batas_pengulangan_remidi">- Silakan Anda mengikuti tahap remidi melalui belajar kelompok dengan teknik “Tutor Sebaya” di luar sistem.</li>
                                                <li class="text-md">
                                                    - Anda mempunyai kesempatan <strong>{{ kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length }} kali</strong> untuk melakukan tes formatif.
                                                </li>
                                                <li v-if="formatif?.completed.length != 0 && formatif?.completed.at(-1).status_TesFormatif == 2 && kelas.settings.waktu_tunggu_formatif > 0" class="text-md">
                                                    - Anda bisa melakukan tes formatif (remidi) berikutnya pada <strong>{{ waktuTungguRemidi }}</strong> Jam <strong>{{ arrayTimeRemidi[0].split(":")[0] }}:{{ arrayTimeRemidi[0].split(":")[1] }}</strong> {{ `${arrayTimeRemidi[2]} ${arrayTimeRemidi[3]}  ${arrayTimeRemidi[4]}` }}
                                                </li>
                                                <li>
                                                    - Kriteria Ketuntasan Minimum (KKM) pada Tes Formatif ini adalah <strong>{{ kelas?.settings.KKM }}%</strong>.
                                                </li>
                                            </ul>
                                            <ul v-else class="text-md italic font-light">
                                                <span class="font-bold"> Perhatian: </span>
                                                <li class="text-md">- Skor Anda tetap belum memenuhi ketuntasan minimum dalam sub-CPMK ini.</li>
                                                <li class="text-md">- Anda tidak memiliki kesempatan untuk mengikuti tes formatif ulang kembali.</li>
                                                <li class="text-md">- Silakan Anda segera menghubungi dosen pengajar untuk melakukan proses pendampingan.</li>
                                            </ul>
                                        </h1>
                                        <div v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length > 0" class="mt-3 flex justify-start items-center">
                                            <button @click.prevent="createFormatif()" :class="formatif?.completed.length != 0 && formatif?.completed.at(-1).status_TesFormatif == 2 && kelas.settings.waktu_tunggu_formatif > 0 ? 'bg-red-500 hover:bg-red-600' : 'bg-emerald-500 hover:bg-emerald-600'" class="text-xl font-bold px-6 py-3 rounded text-white">Mulai Tes Formatif</button>
                                        </div>
                                        <div v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length < kelas?.settings.batas_pengulangan_remidi && kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length > 0 && failedInfo?.top" class="mt-12">
                                            <h1 class="font-black text-lg">Teman Anda yang telah tuntas dan direkomendasikan menjadi tutor sebaya</h1>
                                            <ul>
                                                <li v-for="(item, index) in failedInfo?.top" :key="index">- {{ item.email_siswa }}</li>
                                            </ul>
                                        </div>
                                        <div v-if="kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length < kelas?.settings.batas_pengulangan_remidi && kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length > 0 && failedInfo?.failed" class="mt-6">
                                            <h1 class="font-black text-lg">Daftar mahasiswa yang mengikuti remidi pada sub-CPMK ini</h1>
                                            <ul>
                                                <li v-for="(item, index) in failedInfo?.failed" :key="index">- {{ item.email_siswa }}</li>
                                            </ul>
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
                                                    {{ soal?.soal?.soal }}
                                                    <img :src="parseSoalImage(soal?.soal.pathFileGambar_soal)" alt="" />
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
                                                <div class="bg-slate-800 text-white px-6 py-3 text-xl rounded">{{ parseTime(soalTime.h) }} : {{ parseTime(soalTime.m) }} : {{ parseTime(soalTime.s) }}</div>
                                                <button class="rounded bg-red-500 hover:bg-red-600 px-6 py-3 text-white text-lg uppercase" @click="finishFormatif(selectedJawaban)">Selesai</button>
                                            </div>
                                        </div>

                                        <div class="hidden lg:block">
                                            <ul role="list" class="space-y-2 border-b border-gray-200 pb-6 text-lg capitalize text-gray-900">
                                                <li class="text-xl">Daftar Soal</li>
                                            </ul>

                                            <form class="grid grid-cols-5 gap-2 mt-3 text-lg">
                                                <label :for="'soal' + index" v-for="(item, index) in soalCount" :key="index" class="cursor-pointer bg-gray-200 col-span-1 px-2 py-3 rounded text-center shadow text-xl">
                                                    {{ index + 1 }}
                                                    <input :id="'soal' + index" :value="index + 1" type="radio" v-model="selectedSoal" />
                                                </label>
                                            </form>
                                        </div>
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
import { MinusIcon, PlusIcon, Squares2X2Icon, PaperClipIcon, ArrowLeftIcon } from "@heroicons/vue/20/solid";
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
const arrayTimeRemidi = ref();

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
            if (err.response.data.message == "current unit is not finished") {
                // Pop up peringantan jika mengambil formatif sebelum boleh mengambil
                Swal.fire("Peringatan", `Silakan baca materi terlebuh dahulu sebelum mengerjakan tes formatif`, "warning");
            } else if (err.response.data.message == "current test is not finished") {
                startFormatif();
            } else {
                // Pop up peringantan menunggu jika mengulang
                Swal.fire("Peringatan", `Anda belum bisa melakukan tes formatif ulang, Silakan tunggu hingga waktu yang ditentukan`, "warning");
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

const failedInfo = ref();
const getFailedInfo = () => {
    axios
        .get(`/api/getFailedInfo/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            failedInfo.value = res.data;
            console.log("failed Info", res.data);
        });
};

// Count Down Remidi
watch(formatif, () => {
    if (formatif.value?.completed.length != 0 && formatif.value?.completed.at(-1).status_TesFormatif == 2) {
        let end = new Date(formatif.value?.completed.at(-1).waktuSelesai_tesFormatif);
        end.setHours(end.getHours() + kelas.value?.settings.waktu_tunggu_formatif);

        let convert_to_utc = Date.UTC(end.getFullYear(), end.getMonth(), end.getDate(), end.getHours(), end.getMinutes(), end.getSeconds());
        waktuTungguRemidi.value = new Date(convert_to_utc).toDateString();
        arrayTimeRemidi.value = new Date(convert_to_utc).toTimeString().split(" ");
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
            testInfo();
            console.log("soal", res.data);
            soal.value = res.data;
            soalCount.value = res.data.soal_count;
            const date = soalInfo.value?.tes?.waktuMulai_TesFormatif;
            soalTimer(date, soalCount.value);
            let hasil = soalInfo.value?.jawaban.find((jwb) => jwb.nomorUrut_soal === no_urut_soal);
            selectedJawaban.value = hasil.noUrut_pilihan;
        });
};

// Count Down Soal
const soalTimer = (usedDate, countSoal) => {
    let end;
    if (usedDate !== undefined) {
        end = new Date(usedDate);
    } else {
        end = new Date("1970-02-19");
    }
    end.setMinutes(end.getMinutes() + kelas.value?.settings.waktu_per_soal_formatif * countSoal);
    const timer = setInterval(() => {
        let localnow = new Date();
        let utcnow = new Date(localnow.getUTCFullYear(), localnow.getUTCMonth(), localnow.getUTCDate(), localnow.getUTCHours(), localnow.getUTCMinutes(), localnow.getUTCSeconds());
        let timeStampCountDown = Math.floor(new Date(end.getTime() - utcnow.getTime()).getTime() / 1000);
        if (timeStampCountDown < 0) {
            clearInterval(timer);
        }
        console.log(soalTime.value.h, soalTime.value.m, soalTime.value.s);
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
                    if (res.data.status_TesFormatif == 3) {
                        Swal.fire({
                            title: "Hasil Formatif.",
                            html: `<div class="h-[100px]">
                                <div class="font-quick">
                                    <p>Nilai anda adalah <strong>${res.data.nilai_tesFormatif.toFixed(2)}</strong></p>
                                    <p>Nilai minimum adalah <strong>${kelas.value?.settings.KKM}</strong></p>
                                </div>
                                <div class="text-white mt-3">
                                    <span class="px-3 py-1.5 bg-emerald-500 text-xl font-black rounded shadow">
                                        LULUS/TUNTAS
                                    </span>
                                </div>
                            </div>`,
                            icon: "success",
                        }).then(() => {
                            nextUnit();
                            router.push({ name: "mahasiswa.kelas", params: { id: route.params.id } });
                        });
                    } else {
                        console.log(res.data);
                        Swal.fire({
                            title: "Hasil Formatif.",
                            html: `<div class="h-[100px]">
                                <div class="font-quick">
                                    <p>Nilai anda adalah <strong>${res.data.nilai_tesFormatif.toFixed(2)}</strong></p>
                                    <p>Nilai minimum adalah <strong>${kelas.value?.settings.KKM}</strong></p>
                                </div>
                                <div class="text-white mt-3">
                                    <span class="px-3 py-1.5 bg-red-500 rounded shadow">
                                        REMIDI
                                    </span>
                                </div>
                            </div>`,
                            icon: "error",
                        }).then(() => {
                            router.go(0);
                        });
                    }
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
    router.push({ name: "mahasiswa.kelas", params: { id: route.params.id } });
};

import globalVar from "@/variable.js";
const parseSoalImage = (path_soal) => {
    const soal_filename = `${path_soal}`.split("\\").at(-1);
    return `${globalVar.full_path}/files/soal/${soal_filename}`;
};

const parseTime = (time) => {
    if (time < 10 && time >= 0) {
        return `0` + time;
    } else if (time < 0) {
        return `00`;
    }
    return time;
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
    getFailedInfo();
});

const mobileFiltersOpen = ref(false);
</script>
