<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 mb-5">
            Pengaturan Kelas
        </h3>
        <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
            <div
                :class="[
                    'bg-emerald-700 text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
                ]"
            >
                Pengaturan Kelas
            </div>
        </div>
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
                                Pengaturan Kelas
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan isi form disamping dengan benar, sesuai
                                dengan ketentuan yang akan anda buat.
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
                                    <div>
                                        <p class="text-xl font-medium mb-3">
                                            Waktu Perkuliahan
                                        </p>
                                        <div class="grid grid-cols-4 gap-6">
                                            <div class="col-span-2">
                                                <label
                                                    for="company-website"
                                                    class="block text-sm font-medium text-gray-700"
                                                    >Mulai</label
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
                                                    >Selesai</label
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

                                    <div class="grid md:grid-cols-3 gap-6">
                                        <div
                                            v-for="(item, index) in 6"
                                            :key="item"
                                            class="col-span-1"
                                        >
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Bobot C{{ index + 1 }}</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="number"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Kriteria Kentuntasan Minimum
                                                (KKM)</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="number"
                                                    min="1"
                                                    max="100"
                                                    name="kode-matakuliah"
                                                    id="kode-matakuliah"
                                                    class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label
                                            for="about"
                                            class="block text-sm font-medium text-gray-700"
                                            >Minimal Waktu Tunggu</label
                                        >
                                        <div class="mt-1">
                                            <input
                                                type="number"
                                                name="kode-matakuliah"
                                                id="kode-matakuliah"
                                                class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                            />
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Waktu tunggu jika mahasiswa
                                            mengulang mengerjakan test formatif.
                                            <span class="font-bold"
                                                >Waktu tunggu dalam satuan
                                                jam</span
                                            >
                                        </p>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label
                                                for="company-website"
                                                class="block text-sm font-medium text-gray-700"
                                                >Tanggal Pelaksanaan Test
                                                Sumatif</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="date"
                                                    min="1"
                                                    max="100"
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
                                                >Waktu Pelaksanaan Test
                                                Sumatif</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="date"
                                                    min="1"
                                                    max="100"
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
                <router-link to="/d/dashboard">
                    <button
                        type="submit"
                        class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                    >
                        Kembali
                    </button>
                </router-link>
                <button
                    type="submit"
                    class="justify-center mt-2 rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
                >
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
</script>
