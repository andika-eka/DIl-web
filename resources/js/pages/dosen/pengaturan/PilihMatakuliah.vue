<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 mb-5">
            Buat Kelas Baru
        </h3>
        <navbar-new-mata-kuliah />
        <div
            class="my-3 p-4 text-3xl font-normal leading-normal text-emerald-800 mb-28"
        >
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Pilih Matakuliah
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan pilih matakuliah disamping dengan benar,
                                sesuai dengan kelas yang ingin anda buat.
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div
                                class="shadow-lg sm:overflow-hidden sm:rounded-md"
                            >
                                <div
                                    class="space-y-6 bg-white px-4 py-5 sm:p-6"
                                >
                                    <Listbox as="div" v-model="selected">
                                        <ListboxLabel
                                            class="block text-sm font-medium text-gray-700"
                                            >Select Matakuliah</ListboxLabel
                                        >
                                        <div class="relative mt-1">
                                            <ListboxButton
                                                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400 sm:text-sm"
                                            >
                                                <span class="flex items-center">
                                                    <span
                                                        :class="[
                                                            selected !== null
                                                                ? ''
                                                                : 'py-2.5',
                                                            'block truncate',
                                                        ]"
                                                        >{{
                                                            selected?.nama_mataKuliah
                                                        }}</span
                                                    >
                                                </span>
                                                <span
                                                    class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2"
                                                >
                                                    <ChevronUpDownIcon
                                                        class="h-5 w-5 text-gray-400"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                            </ListboxButton>

                                            <transition
                                                leave-active-class="transition ease-in duration-100"
                                                leave-from-class="opacity-100"
                                                leave-to-class="opacity-0"
                                            >
                                                <ListboxOptions
                                                    class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                >
                                                    <ListboxOption
                                                        as="template"
                                                        v-for="matkul in matakuliah"
                                                        :key="
                                                            matkul.id_mataKuliah
                                                        "
                                                        :value="matkul"
                                                        v-slot="{
                                                            active,
                                                            selected,
                                                        }"
                                                    >
                                                        <li
                                                            :class="[
                                                                active
                                                                    ? 'text-white bg-emerald-500'
                                                                    : 'text-gray-900',
                                                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                                            ]"
                                                        >
                                                            <div
                                                                class="flex items-center"
                                                            >
                                                                <span
                                                                    :class="[
                                                                        selected
                                                                            ? 'font-semibold'
                                                                            : 'font-normal',
                                                                        'ml-3 block truncate',
                                                                    ]"
                                                                    >{{
                                                                        matkul.nama_mataKuliah
                                                                    }}</span
                                                                >
                                                            </div>

                                                            <span
                                                                v-if="selected"
                                                                :class="[
                                                                    active
                                                                        ? 'text-white'
                                                                        : 'text-emerald-500',
                                                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                ]"
                                                            >
                                                                <CheckIcon
                                                                    class="h-5 w-5"
                                                                    aria-hidden="true"
                                                                />
                                                            </span>
                                                        </li>
                                                    </ListboxOption>
                                                </ListboxOptions>
                                            </transition>
                                        </div>
                                    </Listbox>

                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Kode Matakuliah</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    v-model="kodeMatakuliah"
                                                    type="text"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    disabled
                                                    class="block w-full bg-gray-100 flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            for="about"
                                            class="block text-sm font-medium text-gray-700"
                                            >Capaian Pembelajaran Mata Kuliah
                                            (CPMK)</label
                                        >
                                        <div class="mt-1">
                                            <textarea
                                                v-model="cpmk"
                                                id="cpmk"
                                                name="cpmk"
                                                rows="3"
                                                class="mt-1 block bg-gray-100 w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                disabled
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-end items-center bg-gray-100 mt-5 px-4 pt-2 pb-4"
            >
                <button
                    @click="saveAndNext()"
                    type="button"
                    class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                >
                    Selanjutnya
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
import { onMounted, ref, watch } from "vue";
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import { useRouter } from "vue-router";

const authStore = useAuthStore();
const kelasStore = useKelasStore();
const router = useRouter();
const matakuliah = ref([]);
const selected = ref(null);
const kodeMatakuliah = ref(null);
const cpmk = ref(null);

const getMatakuliah = async () => {
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

const saveAndNext = () => {
    kelasStore.dataMatkul = selected.value;
    router.push("/d/tambah-kelas");
};

watch(selected, () => {
    kodeMatakuliah.value = selected.value.kode_mataKuliah;
    cpmk.value = selected.value.cpmk;
});

onMounted(async () => {
    await getMatakuliah();
    selected.value = kelasStore.dataMatkul;
});
</script>
