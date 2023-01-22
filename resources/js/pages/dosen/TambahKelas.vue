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
                                Buat Kelas
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan isi form disamping dengan benar, sesuai
                                dengan kelas yang ingin anda buat.
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
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Nama Kelas</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="text"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Tahun</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="text"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Semester</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="text"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Mulai Kelas</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="date"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Selesai Kelas</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="date"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
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
                <router-link to="/d/select-matakuliah">
                    <button
                        type="submit"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                    >
                        Sebelumnya
                    </button>
                </router-link>
                <router-link to="/d/sub-cpmk">
                    <button
                        type="submit"
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
</script>
