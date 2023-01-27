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
                <div
                    v-for="(item, index) in subCpmk"
                    :key="item"
                    :class="[
                        index != 0 ? 'mt-3' : '',
                        'md:grid md:grid-cols-3 md:gap-6',
                    ]"
                >
                    <div v-if="index == 0" class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Sub CPMK
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan buat sub cpmk disamping dengan benar,
                                sesuai dengan kelas yang ingin anda buat
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
                                        <button
                                            v-if="index != 0"
                                            @click="removeSubCPMK(index)"
                                            class="py-2 px-3 bg-red-500 text-xs rounded-sm"
                                        >
                                            <i
                                                class="fas fa-trash text-white"
                                            ></i>
                                        </button>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Narasi Sub-CPMK</label
                                        >
                                        <div class="mt-1">
                                            <textarea
                                                v-model="item.narasi_subCpmk"
                                                rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                            />
                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Pilih Taksonomi Bloom</label
                                        >
                                        <select
                                            v-model="item.taksonomi_bloom"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                            name=""
                                            id=""
                                        >
                                            <option
                                                v-for="n in 6"
                                                :key="n"
                                                :value="n"
                                            >
                                                C{{ n }}
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700"
                                            >Teks Materi</label
                                        >
                                        <div
                                            @dragover.prevent="
                                                handleDragIn(index)
                                            "
                                            @drop.prevent="
                                                handleDrop($event, index)
                                            "
                                            @dragleave.prevent="
                                                handleDragLeave(index)
                                            "
                                            :class="[
                                                fileInputStyle[index],
                                                'mt-1 flex justify-center rounded-md border-2 border-dashed px-6 pt-5 pb-6',
                                            ]"
                                        >
                                            <div class="space-y-1 text-center">
                                                <i
                                                    class="fas fa-file-alt text-gray-400 mx-auto h-12 w-12"
                                                ></i>
                                                <div
                                                    class="flex text-sm text-gray-600"
                                                >
                                                    <label
                                                        :for="
                                                            'file-upload' +
                                                            index
                                                        "
                                                        class="relative bg-emerald-100 px-2 cursor-pointer rounded-md font-medium text-emerald-600 focus-within:outline-none hover:text-emerald-500"
                                                    >
                                                        <span
                                                            v-if="
                                                                item.materiTeks ==
                                                                ''
                                                            "
                                                            >Upload a file</span
                                                        >
                                                        <span v-else>
                                                            {{
                                                                item.materiTeks
                                                                    ?.name
                                                            }}
                                                        </span>
                                                        <input
                                                            @change="
                                                                fileSelected(
                                                                    $event,
                                                                    index
                                                                )
                                                            "
                                                            :id="
                                                                'file-upload' +
                                                                index
                                                            "
                                                            name="file-upload"
                                                            type="file"
                                                            class="sr-only"
                                                        />
                                                    </label>
                                                    <p
                                                        v-if="
                                                            item.materiTeks ==
                                                            ''
                                                        "
                                                        class="pl-1"
                                                    >
                                                        or drag and drop
                                                    </p>
                                                    <p v-else class="pl-1">
                                                        Terpilih
                                                    </p>
                                                </div>
                                                <p
                                                    class="text-xs text-gray-500"
                                                >
                                                    PDF file up to 5MB
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-between items-center bg-gray-100 mt-5 px-4 pt-2 pb-4"
            >
                <router-link to="/d/tambah-kelas">
                    <button
                        type="button"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                    >
                        Sebelumnya
                    </button>
                </router-link>
                <button
                    @click="addSubCPMK"
                    class="bg-emerald-500 py-2 px-4 rounded-lg mt-2 text-sm text-white font-medium"
                >
                    Tambah Sub-CPMK <i class="fas fa-plus text-white ml-3"></i>
                </button>
                <router-link to="/d/indikator">
                    <button
                        type="button"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                    >
                        Berikutnya
                    </button>
                </router-link>
            </div>
        </div>
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
import { reactive, ref } from "@vue/reactivity";
import { useKelasStore } from "@/stores/kelas";
import { onMounted, watch } from "@vue/runtime-core";

const kelasStore = useKelasStore();
const fileInputStyle = reactive([]);
const subCpmk = reactive([
    {
        narasi_subCpmk: "",
        materiTeks: "",
        taksonomi_bloom: "",
    },
]);

const addSubCPMK = () => {
    subCpmk.push({
        narasi_subCpmk: "",
        materiTeks: "",
        taksonomi_bloom: "",
    });
};

const removeSubCPMK = (index) => {
    subCpmk.splice(index, 1);
};

const handleDragIn = (index) => {
    fileInputStyle[index] = "border-indigo-500 bg-indigo-50";
};

const handleDragLeave = (index) => {
    fileInputStyle[index] = "border-gray-300";
};

const handleDrop = (event, index) => {
    fileInputStyle[index] = "border-emerald-500 bg-emerald-50";
    subCpmk[index].materiTeks = event.dataTransfer.files[0];
};

const fileSelected = (event, index) => {
    fileInputStyle[index] = "border-emerald-500 bg-emerald-50";
    subCpmk[index].materiTeks = event.target.files[0];
    console.log(subCpmk[index].materiTeks);
};

onMounted(() => {
    if (kelasStore.subCpmk !== null) {
        subCpmk.splice(0, 1);
        kelasStore.subCpmk.forEach((el) => {
            subCpmk.push(el);
        });
    }
});

watch(subCpmk, () => {
    kelasStore.subCpmk = subCpmk;
});
</script>
