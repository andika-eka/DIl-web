<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
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
                                Buat Matakuliah Baru
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan isi form disamping dengan benar, sesuai
                                dengan matakuliah yang ingin dibuat.
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
                                                >Nama Mata Kuliah</label
                                            >
                                            <div
                                                class="mt-1 flex rounded-md shadow-sm"
                                            >
                                                <input
                                                    type="text"
                                                    name="company-website"
                                                    id="company-website"
                                                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                    placeholder="Contoh: Basis Data Lanjutan"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            for="about"
                                            class="block text-sm font-medium text-gray-700"
                                            >CPMK</label
                                        >
                                        <div class="mt-1">
                                            <textarea
                                                id="about"
                                                name="about"
                                                rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm"
                                                placeholder="Ketik CPMK Disini"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="bg-gray-50 px-4 py-3 text-right sm:px-6"
                                >
                                    <button
                                        type="submit"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2"
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
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
</script>
