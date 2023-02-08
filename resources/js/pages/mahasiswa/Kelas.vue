<template>
    <div>
        <index-navbar />
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
                                        <div class="flex items-center justify-between px-4">
                                            <h2 class="text-lg font-medium text-gray-900">Unit</h2>
                                            <button type="button" class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400" @click="mobileFiltersOpen = false">
                                                <span class="sr-only">Close menu</span>
                                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                            </button>
                                        </div>

                                        <!-- Filters -->
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
                    </TransitionRoot>

                    <main class="mx-auto max-w-7xl">
                        <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
                            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                                <span class="uppercase">{{ matakuliah?.nama_mataKuliah }}</span> -
                                {{ matakuliah?.kode_mataKuliah }}
                            </h1>

                            <div class="flex items-center">
                                <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden" @click="mobileFiltersOpen = true">
                                    <span class="sr-only">Materi</span>
                                    <Squares2X2Icon class="h-5 w-5" aria-hidden="true" />
                                </button>
                            </div>
                        </div>

                        <section aria-labelledby="products-heading" class="pt-6 pb-24">
                            <h2 id="products-heading" class="sr-only">Products</h2>

                            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                                <!-- Product grid -->
                                <div class="lg:col-span-3">
                                    <h1 class="capitalize text-lg font-medium mb-5">
                                        {{ currentMateri?.nama_materi }}
                                    </h1>
                                    <div>
                                        <iframe width="100%" height="480" allow="autoplay" frameborder="0" allowfullscreen :src="`${currentMateri?.pathFile_materi}?modestbranding=0&rel=0&autoplay=1`"></iframe>
                                    </div>

                                    <div class="mt-3">
                                        <button @click.prevent="nextMateri()" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 rounded text-white">Materi Selanjutnya</button>
                                    </div>
                                </div>

                                <!-- Filters -->
                                <form class="hidden lg:block">
                                    <ul role="list" class="space-y-2 border-b border-gray-200 pb-6 text-lg capitalize text-gray-900">
                                        <li>{{ materiList?.narasi_subCpmk }}</li>
                                    </ul>

                                    <Disclosure as="div" v-for="(indikator, indikatorIdx) in materiList?.indikator" :key="indikatorIdx" class="border-b border-gray-200 py-6 ml-6" v-slot="{ open }">
                                        <h3 class="-my-3 flow-root">
                                            <DisclosureButton class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500">
                                                <span class="text-left text-gray-900 capitalize">{{ indikator.narasi_indikator }}</span>
                                                <span class="ml-6 flex items-center">
                                                    <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true" />
                                                    <MinusIcon v-else class="h-5 w-5" aria-hidden="true" />
                                                </span>
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <div class="space-y-4">
                                                <div v-for="(materi, materiIdx) in indikator?.materi" :key="materiIdx" class="flex items-center">
                                                    <p class="ml-3 text-sm text-gray-600 capitalize">
                                                        {{ materi.nomorUrut_materi }} -
                                                        {{ materi.nama_materi }}
                                                    </p>
                                                </div>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                    <ul role="list" class="ml-6 mt-4 border-b border-gray-200 pb-6 text-sm">
                                        <li class="text-left text-gray-900 capitalize">Tes Formatif</li>
                                    </ul>
                                </form>
                            </div>
                        </section>
                    </main>
                </div>

                <!-- Deskripsi -->
                <div class="mx-auto max-w-7xl overflow-hidden bg-white sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Kelas Kuliah</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Kode Mata Kuliah</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    {{ matakuliah?.kode_mataKuliah }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Nama Mata Kuliah</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    {{ matakuliah?.nama_mataKuliah }}
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Capaian Pembelajaran Mata Kuliah (CPMK)</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    {{ matakuliah?.cpmk }}
                                </dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Sub-CPMK</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 capitalize">
                                    <span>
                                        {{ materiList?.narasi_subCpmk }}
                                    </span>
                                    <ul class="ml-6 list-disc">
                                        <li v-for="(indikator, indikatorIdx) in materiList?.indikator" :key="indikatorIdx">{{ indikator.narasi_indikator }}</li>
                                    </ul>
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
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
import { useKelasStore } from "@/stores/kelas";
import { onMounted, ref } from "@vue/runtime-core";
import { useRoute } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";

const route = useRoute();
const authStore = useAuthStore();
const kelasStore = useKelasStore();
const currentUnit = ref();
const currentMateri = ref();
const materiList = ref();
const matakuliah = ref({
    id_matakuliah: null,
    kode_mataKuliah: "",
    nama_mataKuliah: "",
    cpmk: "",
    kelas: [],
    sub_cpmk: [],
});

const getData = async () => {
    await axios
        .get("/api/Matakuliah/" + route.params.id, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            matakuliah.value = res.data;
        });
};

const getCurrUnit = async () => {
    await axios
        .get(`/api/currentUnit/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            console.log("curr unit:", res.data);
            currentUnit.value = res.data;
        });
};

const getCurrMateri = async () => {
    await axios
        .get(`/api/currenMateri/${route.params.id}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            console.log("curr Matri:", res.data);
            currentMateri.value = res.data.currentMateri;
            materiList.value = res.data.materiList;
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
            console.log(res.data);
            if (res.data?.currentMateri) {
                getCurrMateri();
            }
        })
        .catch((err) => {
            Swal.fire("Anda belum boleh Lanjut", "Silakan tunggu beberapa saat lagi", "info");
        });
};

onMounted(async () => {
    getData();
    await getCurrUnit();
    await getCurrMateri();
});
const mobileFiltersOpen = ref(false);
</script>
