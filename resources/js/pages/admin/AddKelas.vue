<template>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3
                                    class="text-lg font-medium leading-6 text-white"
                                >
                                    Tambah Kelas Baru
                                </h3>
                                <p class="mt-1 text-sm text-white">
                                    Silakan isi form berikut untuk menambahkan
                                    data kelas kuliah baru.
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form @submit.prevent="addKelas()">
                                <div
                                    class="overflow-hidden shadow sm:rounded-md"
                                >
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <Listbox
                                                    as="div"
                                                    v-model="selected"
                                                >
                                                    <ListboxLabel
                                                        class="block text-sm font-medium text-gray-700"
                                                        >Pilih Nama
                                                        Matakuliah</ListboxLabel
                                                    >
                                                    <div class="relative mt-1">
                                                        <ListboxButton
                                                            class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400 sm:text-sm"
                                                        >
                                                            <span
                                                                class="flex items-center"
                                                            >
                                                                <span
                                                                    :class="[
                                                                        selected !==
                                                                        null
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
                                                                    :value="
                                                                        matkul
                                                                    "
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
                                                                            v-if="
                                                                                selected
                                                                            "
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
                                            </div>
                                            <div class="col-span-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Tahun</label
                                                >
                                                <div
                                                    class="mt-1 flex rounded-md shadow-sm"
                                                >
                                                    <select
                                                        v-model="selectedTahun"
                                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    >
                                                        <option
                                                            v-for="(
                                                                item, index
                                                            ) in yearlist"
                                                            :key="index"
                                                            :value="item"
                                                        >
                                                            {{ item }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-4">
                                                <label
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Semester</label
                                                >
                                                <div
                                                    class="mt-1 flex rounded-md shadow-sm"
                                                >
                                                    <select
                                                        v-model="
                                                            selelctedSemester
                                                        "
                                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    >
                                                        <option value="Ganjil">
                                                            Ganjil
                                                        </option>
                                                        <option value="Genap">
                                                            Genap
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <label
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Nama Kelas</label
                                                >
                                                <div
                                                    class="mt-1 flex rounded-md shadow-sm"
                                                >
                                                    <select
                                                        v-model="
                                                            selectedNamaKelas
                                                        "
                                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    >
                                                        <option value="A">
                                                            A
                                                        </option>
                                                        <option value="B">
                                                            B
                                                        </option>
                                                        <option value="IKI">
                                                            IKI
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-4">
                                                <label
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Jenis Kelas</label
                                                >
                                                <div
                                                    class="mt-1 flex rounded-md shadow-sm"
                                                >
                                                    <select
                                                        v-model="
                                                            selectedJenisKelas
                                                        "
                                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    >
                                                        <option
                                                            value="reguler"
                                                            selected
                                                        >
                                                            Reguler
                                                        </option>
                                                        <option
                                                            value="international"
                                                        >
                                                            International
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-span-6">
                                                <label
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Status Kelas</label
                                                >
                                                <div
                                                    class="mt-1 flex rounded-md shadow-sm"
                                                >
                                                    <select
                                                        v-model="selectedTahun"
                                                        class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    >
                                                        <option
                                                            value="1"
                                                            selected
                                                        >
                                                            Aktif
                                                        </option>
                                                        <option value="2">
                                                            Non-Aktif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-gray-50 px-4 py-3 text-right sm:px-6"
                                    >
                                        <button
                                            type="submit"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                        >
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import { useAuthStore } from "@/stores/auth";
import { ref } from "@vue/reactivity";
import Swal from "sweetalert2";
import { useRouter } from "vue-router";
import { onMounted } from "@vue/runtime-core";
const authStore = useAuthStore();
const router = useRouter();

const kelasData = ref({});

const matakuliah = ref([]);
const selected = ref(null);

const addKelas = async () => {
    await axios
        .post("/api/register", kelasData.value, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            Swal.fire(
                "Adding Success",
                "Data User Berhasil ditambahkan",
                "success"
            ).then(() => {
                router.push("/a/list-kelas");
            });
        });
};

const yearlist = ref([]);
const makeTahunList = () => {
    const date = new Date(Date.now());
    const yearnow = date.getFullYear();
    for (let i = 0; i < 10; i++) {
        yearlist.value[i] = yearnow - i;
    }
};

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

onMounted(async () => {
    makeTahunList();
    await getMatakuliah();
});
</script>
