<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6 font-quick">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 mb-5">Pengaturan Matakuliah</h3>
        <!-- Start Redundant Section -->
        <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
            <div
                :class="[$router.currentRoute.value.name != 'dosen.matakuliah.pengaturan.subcpmk' ? 'bg-emerald-700' : 'bg-emerald-500', 'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase']">
                Sub-CPMK</div>
            <div
                :class="[$router.currentRoute.value.name != 'dosen.matakuliah.pengaturan.indikator' ? 'bg-emerald-700' : 'bg-emerald-500', 'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase']">
                Indikator</div>
            <div
                :class="[$router.currentRoute.value.name != 'dosen.matakuliah.pengaturan.materi' ? 'bg-emerald-700' : 'bg-emerald-500', 'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase']">
                Materi</div>
        </div>
        <!-- End Redundan Section -->
        <div class="my-3 p-4 text-3xl font-normal leading-normal text-emerald-800 mb-28">
            <div>
                <div v-for="(item, index) in subCpmk" :key="item"
                    :class="[index != 0 ? 'mt-3' : '', 'md:grid md:grid-cols-3 md:gap-6']">
                    <div v-if="index == 0" class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Sub CPMK</h3>
                            <p class="mt-1 text-sm text-gray-600">Silakan buat sub cpmk disamping dengan benar, sesuai
                                dengan kelas kuliah yang ingin anda buat.</p>
                            <p class="mt-3 text-sm text-gray-600 italic">
                                <span class="font-bold">Catatan:</span>
                                <br />Ketika data Sub-CPMK atau Indikator Pembelajaran ditambahkan, sistem akan melakukan
                                penyimpanan secara otomatis.
                            </p>
                        </div>
                    </div>
                    <div v-else class="md:col-span-1"></div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form @submit.prevent @input="updateChange()">
                            <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="flex justify-between">
                                        <h5 class="text-xl">Sub-CPMK {{ index + 1 }}</h5>
                                        <button @click="removeSubCPMK(index, item.id_subCpmk)"
                                            class="py-2 px-3 bg-red-500 text-xs rounded-sm">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Narasi Sub-CPMK</label>
                                        <div class="mt-1">
                                            <textarea v-model="item.narasi_subCpmk" rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Bahan Ajar Berbasis
                                            Teks</label>
                                        <div @dragover.prevent="handleDragIn(index)"
                                            @drop.prevent="handleDrop($event, index)"
                                            @dragleave.prevent="handleDragLeave(index)"
                                            :class="[fileInputStyle[index], 'mt-1 flex justify-center rounded-md border-2 border-dashed px-6 pt-5 pb-6']">
                                            <div class="space-y-1 text-center">
                                                <i class="fas fa-file-alt text-gray-400 mx-auto h-12 w-12"></i>
                                                <div class="flex text-sm text-gray-600">
                                                    <label :for="'file-upload' + index"
                                                        class="relative bg-emerald-100 px-2 cursor-pointer rounded-md font-medium text-emerald-600 focus-within:outline-none hover:text-emerald-500">
                                                        <span v-if="item.materiTeks == ''">Upload a file</span>
                                                        <span v-else>
                                                            {{ item.materiTeks?.name }}
                                                        </span>
                                                        <input @change="fileSelected($event, index)"
                                                            :id="'file-upload' + index" name="file-upload" type="file"
                                                            class="sr-only" />
                                                    </label>
                                                    <p v-if="item.materiTeks == ''" class="pl-1">or drag and drop</p>
                                                    <p v-else class="pl-1">Terpilih</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PDF file up to 5MB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center bg-gray-100 mt-5 px-4 pt-2 pb-4">
                <button @click="addSubCPMK"
                    class="bg-emerald-500 py-2 px-4 rounded-lg mt-2 text-sm text-white font-medium">Tambah Sub-CPMK <i
                        class="fas fa-plus text-white ml-3"></i></button>
                <a @click.prevent="validateThenNext()" href="#">
                    <button type="button"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">Input
                        Indikator</button>
                </a>
            </div>
        </div>
    </section>
</template>

<script setup>
import { reactive } from "@vue/reactivity"
import { useSubCPMKStore } from "@/stores/subCPMK"
import { onMounted, watch } from "@vue/runtime-core"
import { useRoute, useRouter } from "vue-router"
import { useAuthStore } from "@/stores/auth"
import Swal from "sweetalert2"

const route = useRoute()
const router = useRouter()
const authStore = useAuthStore()
const subCPMKStore = useSubCPMKStore()

const fileInputStyle = reactive([])
const subCpmk = reactive([
    {
        narasi_subCpmk: "",
        materiTeks: "",
    },
])

onMounted(async () => {
    await getData()
    if (subCPMKStore.subCpmk !== null) {
        subCpmk.splice(0, 1)
        subCPMKStore.subCpmk.forEach((el) => {
            subCpmk.push(el)
        })
    }
})

watch(subCpmk, () => {
    subCPMKStore.subCpmk = subCpmk
})

import PQueue from "p-queue"
import { debounce } from "throttle-debounce"
import axios from "axios"

const queue = new PQueue({ concurrency: 1 })

const updateChange = debounce(1000, () => {
    queue.clear()
    queue.add(() => {
        console.log(subCpmk)
        subCpmk.forEach((item, index) => {
            console.log(item)
            let data = { nomorUrut_subCpmk: index + 1, narasi_subCpmk: item.narasi_subCpmk, item }
            let file = { materiTeks: item.materiTeks }
            updateSubCPMK(item.id_subCpmk, data)
            // updateSubCPMKFile(item.id_subCpmk, file)
        })
        Swal.fire({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            icon: "success",
            title: "Berhasil disimpan",
        })
    })
})

const addSubCPMK = () => {
    Swal.fire({
        title: '<h1 class="font-quick">Tambah Data Sub-CPMK</h1>',
        html:
            `<div class="w-full flex flex-col justify-start font-quick">
                <label for="narasi_subcpmk" class="text-left text-sm font-bold">Narasi Sub-CPMK</label>
                <textarea class="rounded" id="narasi_subcpmk"></textarea>
            </div>
            <div class="w-full flex flex-col justify-start mt-3 font-quick">
                <label for="file_materi" class="text-left text-sm font-bold">Bahan Ajar Berbasis Teks</label>
                <input type="file" class="rounded" id="file_materi"/>
            </div>`,
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const narasiSubcpmk = Swal.getPopup().querySelector('#narasi_subcpmk').value
            const fileMateri = Swal.getPopup().querySelector('#file_materi').value

            const newSubCPMK = {
                nomorUrut_subCpmk: 1,
                narasi_subCpmk: subCpmk.at(-1).narasi_subCpmk,
                materiTeks: subCpmk.at(-1).materiTeks,
                taksonomi_bloom: 0
            }
            console.log(narasiSubcpmk, fileMateri)
            // axios.post(`/api/Matakuliah/${route.params.id_matakuliah}/subcpmk`, newSubCPMK, {
            //     headers: {
            //         Authorization: `Bearer ${authStore.authUser.api_token}`,
            //     },
            // }).then(response => {
            //     if (!response.ok) {
            //         throw new Error(response.statusText)
            //     }
            // }).catch(error => {
            //     Swal.showValidationMessage(
            //         `Request failed: ${error}`
            //     )
            // })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: `${result.value.login}'s avatar`,
                imageUrl: result.value.avatar_url
            })
        }
    })

    // subCpmk.push({
    //     narasi_subCpmk: "Silakan Ubah Narasi",
    //     materiTeks: "/",
    // })

    // const newSubCPMK = {
    //     nomorUrut_subCpmk: 1,
    //     narasi_subCpmk: subCpmk.at(-1).narasi_subCpmk,
    //     materiTeks: subCpmk.at(-1).materiTeks,
    //     taksonomi_bloom: 0
    // }

    // axios.post(`/api/Matakuliah/${route.params.id_matakuliah}/subcpmk`, newSubCPMK, {
    //     headers: {
    //         Authorization: `Bearer ${authStore.authUser.api_token}`,
    //     },
    // })
}

const removeSubCPMK = (index, id_subCpmk) => {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang sudah dihapus, tidak akan bisa kembali",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/subcpmk/${id_subCpmk}`, {
                headers: {
                    Authorization: `Bearer ${authStore.authUser.api_token}`,
                },
            }).then(() => {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "Berhasil dihapus",
                })
                subCpmk.splice(index, 1)
            })
        }
    })
}

const handleDragIn = (index) => {
    fileInputStyle[index] = "border-indigo-500 bg-indigo-50"
}

const handleDragLeave = (index) => {
    fileInputStyle[index] = "border-gray-300"
}

const handleDrop = (event, index) => {
    fileInputStyle[index] = "border-emerald-500 bg-emerald-50"
    subCpmk[index].materiTeks = event.dataTransfer.files[0]
}

const fileSelected = (event, index) => {
    fileInputStyle[index] = "border-emerald-500 bg-emerald-50"
    subCpmk[index].materiTeks = event.target.files[0]
}

const getData = async () => {
    await axios
        .get(`/api/Matakuliah/${route.params.id_matakuliah}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            subCPMKStore.subCpmk = res.data.sub_cpmk
        })
}

const updateSubCPMK = (id, data) => {
    axios.post(`/api/subcpmk/${id}`, data, {
        headers: {
            Authorization: `Bearer ${authStore.authUser.api_token}`,
        },
    })
}

const updateSubCPMKFile = (id, data) => {
    axios.post(`/api/subcpmk/${id}/file`, data, {
        headers: {
            Authorization: `Bearer ${authStore.authUser.api_token}`,
        },
    })
}

// handle router
const validateThenNext = async () => {
    router.push({ name: "dosen.matakuliah.pengaturan.indikator", params: { id_matakuliah: route.params.id_matakuliah } })
}
</script>
