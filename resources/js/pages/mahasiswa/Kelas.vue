<template>
    <div>
        <index-navbar />
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
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                                <span class="uppercase">{{ kelas?.matakuliah.nama_mataKuliah }}</span> -
                                {{ kelas?.matakuliah.kode_mataKuliah }}
                            </h1>

                            <div class="flex items-center">
                                <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden" @click="mobileFiltersOpen = true">
                                    <span class="sr-only">Materi</span>
                                    <Squares2X2Icon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>

                        <section aria-labelledby="products-heading" class="py-6">
                            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                                <div v-if="currentUnit?.current.status_subcpmkpengambilan == 2" :class="formatif?.current !== null ? 'col-span-4' : 'col-span-3'" class="grid gap-x-8 gap-y-10 lg:grid-cols-4">
                                    <section v-if="formatif?.current === null" aria-labelledby="products-heading" class="col-span-4 pt-6 pb-24">
                                        <p class="font-bold text-2xl mb-3">Sesi Tes Formatif</p>
                                        <h1 class="text-xl font-medium mb-5">
                                            <span class="capitalize"> Tes Formatif Sub-CPMK "{{ currentUnit?.current.narasi_subCpmk }}" </span>
                                            <ul class="text-md italic font-light">
                                                Catatan:
                                                <li class="text-md">- Semua materi pada Sub-CPMK ini sudah anda lalui, silakan mulai mengerjakan tes formatif untuk mengukur tingkat penguasaan Anda.</li>
                                                <li class="text-md">
                                                    - Anda mempunyai kesempatan <strong>{{ kelas?.settings.batas_pengulangan_remidi - formatif?.completed.length }} kali</strong> untuk melakukan tes formatif.
                                                </li>
                                                <li>
                                                    - Kriteria Ketuntasan Minimum (KKM) pada Tes Formatif ini adalah <strong>{{ kelas?.settings.KKM }}%</strong>.
                                                </li>
                                            </ul>
                                        </h1>
                                        <div class="mt-3 flex justify-between items-center">
                                            <button @click.prevent="createFormatif()" class="text-xl font-bold px-6 py-3 bg-emerald-500 hover:bg-emerald-600 rounded text-white">Mulai Tes Formatif</button>
                                        </div>
                                    </section>

                                    <template v-else>
                                        <div class="lg:col-span-3">
                                            <div class="bg-gray-200 px-3 py-2 rounded">
                                                <p class="text-lg">
                                                    {{ soal?.soal?.soal }}
                                                </p>
                                            </div>
                                            <div>
                                                <form class="grid grid-cols-2 gap-2 mt-3">
                                                    <div v-for="(item, index) in soal?.soal?.jawaban" :key="index" class="bg-gray-200 col-span-1 px-6 py-3 rounded shadow flex items-center justify-left text-left">
                                                        <input :id="'jawaban' + index" :value="item.noUrut_pilihan" type="radio" v-model="selectedJawaban" />
                                                        <label :for="'jawaban' + index" class="ml-3 cursor-pointer">
                                                            {{ item.teks_pilihan }}
                                                        </label>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="mt-3 flex items-center justify-end">
                                                <button class="rounded bg-red-500 hover:bg-red-600 px-6 py-3 text-white text-lg uppercase" @click="finishFormatif(selectedJawaban)">Selesai</button>
                                            </div>
                                        </div>

                                        <form class="hidden lg:block">
                                            <ul role="list" class="space-y-2 border-b border-gray-200 pb-6 text-lg capitalize text-gray-900">
                                                <li>Daftar Soal</li>
                                            </ul>

                                            <form class="grid grid-cols-5 gap-2 mt-3 text-lg">
                                                <label :for="'soal' + index" v-for="(item, index) in soal['soal count']" :key="index" class="cursor-pointer bg-gray-200 col-span-1 px-2 py-3 rounded text-center shadow">
                                                    {{ index + 1 }}
                                                    <input :id="'soal' + index" :value="index + 1" type="radio" v-model="selectedSoal" />
                                                </label>
                                            </form>
                                        </form>
                                    </template>
                                </div>
                                <div v-else class="lg:col-span-3">
                                    <h1 class="capitalize text-lg font-medium mb-5">
                                        {{ selectedMateri.currentMateri?.nama_materi }}
                                    </h1>

                                    <template v-if="materiExits">
                                        <div>
                                            <iframe lazy width="100%" height="480" allow="autoplay" frameborder="0" allowfullscreen :src="`${selectedMateri.currentMateri?.pathFile_materi}?modestbranding=0&rel=0&autoplay=1`"></iframe>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="bg-red-100 px-6 py-3 rounded text-gray-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-3"></i>
                                            <p>Belum Ada Data Materi</p>
                                        </div>
                                    </template>
                                    <div v-if="selectedMateri.currentMateri?.id_indikator == currentMateri?.id_indikator && materiExits" class="mt-6">
                                        <button @click.prevent="nextMateri()" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 rounded text-white">Materi Selanjutnya</button>
                                    </div>
                                    <div class="h-1 w-full bg-gray-700 my-6 rounded"></div>
                                    <div class="mx-auto max-w-7xl overflow-hidden bg-white sm:rounded-lg">
                                        <div class="px-4 py-5 sm:px-6">
                                            <h3 class="text-lg font-medium leading-6 text-gray-900">Kelas Kuliah</h3>
                                        </div>
                                        <div class="border-t border-gray-200">
                                            <dl>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">Kode Mata Kuliah</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                        {{ kelas?.matakuliah.kode_mataKuliah }}
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">Nama Mata Kuliah</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                        {{ kelas?.matakuliah.nama_mataKuliah }}
                                                    </dd>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">Capaian Pembelajaran Mata Kuliah (CPMK)</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                        {{ kelas?.matakuliah.cpmk }}
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">Sub-CPMK</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                                        <span>
                                                            {{ currentUnit?.current.narasi_subCpmk }}
                                                        </span>
                                                        <ul class="ml-6 list-disc">
                                                            <li v-for="(indikator, indikatorIdx) in materiList?.indikator" :key="indikatorIdx">{{ indikator.narasi_indikator }}</li>
                                                        </ul>
                                                    </dd>
                                                </div>
                                                <div v-if="currentUnit?.current.current_materi_id !== null" class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">Modul Kuliah</dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                                        <a :href="`public/files/${String(currentUnit?.current.pathFile_materiTeks).split('/').at(-1)}`" download class="flex bg-emerald-500 hover:bg-emerald-600 px-4 py-2 rounded">
                                                            <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-white" aria-hidden="true" />
                                                            <div class="ml-4 flex-shrink-0">
                                                                <span class="font-medium text-white">Unduh</span>
                                                            </div>
                                                        </a>
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <form v-if="currentUnit?.current.status_subcpmkpengambilan != 2" class="hidden lg:block">
                                    <ul role="list" class="space-y-2 border-b border-gray-200 pb-6 text-lg capitalize text-gray-900">
                                        <li class="font-bold">Daftar Materi</li>
                                    </ul>

                                    <Disclosure as="div" v-for="(subCPMK, subCPMKidx) in matakuliah?.sub_cpmk" :key="subCPMKidx" class="border-b border-gray-200 py-6 ml-6" v-slot="{ open }">
                                        <h3 class="-my-3 flow-root">
                                            <DisclosureButton :class="subCPMK?.id_subCpmk == selectedMateri?.id_subCPMK ? 'font-bold' : ''" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                                <span class="text-left text-gray-900 capitalize">{{ subCPMK.narasi_subCpmk }}</span>
                                                <span class="ml-6 flex items-center">
                                                    <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                    <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <div class="space-y-4">
                                                <Disclosure as="div" v-for="(indikator, indikatorIdx) in subCPMK?.indikator" :key="indikatorIdx" class="border-b border-gray-200 py-6 ml-6" v-slot="{ open }">
                                                    <h3 class="-my-3 flex items-center">
                                                        <i v-if="subCPMK?.id_subCpmk > currentUnit?.current.id_subCpmk || indikator.id_indikator > currentMateri?.id_indikator" class="fas fa-lock mr-3"></i>
                                                        <i v-else class="fas fa-check-square mr-3"></i>
                                                        <DisclosureButton :class="indikator?.id_indikator == selectedMateri.currentMateri?.id_indikator ? 'font-bold' : ''" class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                                            <span class="text-left text-gray-900 capitalize">{{ indikator.narasi_indikator }}</span>
                                                            <span class="ml-6 flex items-center">
                                                                <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                                <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                            </span>
                                                        </DisclosureButton>
                                                    </h3>
                                                    <DisclosurePanel class="pt-6">
                                                        <div class="space-y-4">
                                                            <div v-for="(materi, materiIdx) in indikator?.materi" :key="materiIdx" class="flex items-center select-none cursor-pointer ml-6">
                                                                <i v-if="materi.id_materi > currentMateri?.id_materi" class="fas fa-lock"></i>
                                                                <i v-else class="fas fa-check-square"></i>
                                                                <p @click="goToMateri(indikator?.id_subCpmk, materi)" :class="materi?.id_materi == selectedMateri.currentMateri?.id_materi ? 'font-bold text-emerald-500' : ''" class="ml-3 text-sm text-gray-600 capitalize">
                                                                    {{ materi.nama_materi }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </DisclosurePanel>
                                                </Disclosure>
                                                <DisclosurePanel class="pt-6 ml-6">
                                                    <div class="space-y-4">
                                                        <div @click="gotoTesFormatif(subCPMKidx)" class="flex items-center select-none cursor-pointer">
                                                            <i v-if="currentUnit?.completed[subCPMKidx]" class="fas fa-check-square"></i>
                                                            <i v-else class="fas fa-lock"></i>
                                                            <p class="ml-3 text-sm text-gray-600 capitalize">Test Formatif</p>
                                                        </div>
                                                    </div>
                                                </DisclosurePanel>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </form>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </section>
        <footer-component />
        <template id="remidi">
            <swal-title> Save changes to "Untitled 1" before closing? </swal-title>
            <swal-icon type="warning" color="red"></swal-icon>
            <swal-button type="confirm"> Save As </swal-button>
            <swal-button type="cancel"> Cancel </swal-button>
            <swal-button type="deny"> Close without Saving </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param name="customClass" value='{ "popup": "my-popup" }' />
            <swal-function-param name="didOpen" value="popup => console.log(popup)" />
        </template>
    </div>
</template>

<script setup>
import { Dialog, DialogPanel, Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { MinusIcon, PlusIcon, Squares2X2Icon, PaperClipIcon } from "@heroicons/vue/20/solid";
import IndexNavbar from "@/pages/components/Navbars/IndexNavbarMahasiswa.vue";
import FooterComponent from "@/pages/components/Footers/FooterDosen.vue";
import { useAuthStore } from "@/stores/auth";
import { onBeforeUnmount, onMounted, onUnmounted, reactive, ref, watch } from "@vue/runtime-core";
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
const soal = ref(2);
const selectedSoal = ref(1);
const selectedJawaban = ref();
const materiExits = ref(true);
const selectedMateri = ref({
    currentMateri: null,
    id_subCPMK: null,
});

const remidiTimestamp = ref({
    h: 0,
    m: 0,
    s: 0,
});

const mode = ref("materi");

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
                mode.value = "formatif";
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
            // Pop up peringantan menunggu jika mengulang
            Swal.fire("Peringatan", `Anda telah gagal menyelesaikan tes formatif silakan tunggu ${remidiTimestamp.value.h < 10 ? "0" + remidiTimestamp.value.h : remidiTimestamp.value.h}:${remidiTimestamp.value.m < 10 ? "0" + remidiTimestamp.value.m : remidiTimestamp.value.m}:${remidiTimestamp.value.s < 10 ? "0" + remidiTimestamp.value.s : remidiTimestamp.value.s}`, "warning");
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
            Swal.fire("Peringatan", "Anda sudah mencapai batas pengulangan", "warning");
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
watch([formatif, remidiTimestamp], () => {
    if (formatif.value?.completed.length != 0 && formatif.value?.completed.at(-1).status_TesFormatif == 2) {
        let end = new Date(formatif.value?.completed.at(-1).waktuSelesai_tesFormatif);
        end.setHours(end.getHours() + kelas.value?.settings.waktu_tunggu_formatif);
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

// Count Down Soal
// watch();

const getSoal = (no_urut_soal = 1) => {
    axios
        .get(`/api/getSoal/${route.params.id}/${no_urut_soal}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            soal.value = res.data;
            console.log("soal", res.data);
        })
        .catch((err) => {
            soal.value = null;
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
        text: "Data yang sudah di-submit tidak akan bisa diubah kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Saya yakin!",
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
                    Swal.fire();
                    if (res.data.status_TesFormatif == 3) {
                        Swal.fire("Selamat Anda sudah menguasai materi pada sub-CPMK ini dengan baik", "Anda dinyatakan tuntas, dan dapat melanjutkan materi ke sub-CPMK berikutnya", "success").then(() => {
                            nextUnit();
                        });
                    }
                });
            Swal.fire("Berhasil!", "Jawaban anda berhasil dikirim.", "success").then(() => {
                router.go(0);
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

const goToMateri = (id_matakuliah, dataMateri) => {
    if (id_matakuliah <= currentUnit.value?.current.id_subCpmk) {
        if (dataMateri.id_materi <= currentMateri.value?.id_materi) {
            selectedMateri.value.currentMateri = dataMateri;
            selectedMateri.value.id_subCPMK = id_matakuliah;
            materiExits.value = true;
        }
    } else {
        Swal.fire("Materi Non-Aktif", "<p>Silakan lanjutkan belajar anda, pada materi terakhir yang terbuka</p>", "warning");
    }
};

const gotoTesFormatif = (id_subCPMK) => {
    mode.value = "formatif";
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
    getCurrUnit();
    getCurrMateri();
});

const mobileFiltersOpen = ref(false);
</script>
