<template>
    <div class="flex flex-wrap mt-4">
        <div class="w-full mb-12 px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-white">Tambah User Baru</h3>
                                <p class="mt-1 text-sm text-white">Silakan isi form berikut untuk menambahkan user baru</p>
                            </div>
                        </div>
                        <div class="mt-5 md:col-span-2 md:mt-0">
                            <form @submit.prevent="registerUser()">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="bg-white px-4 py-5 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6">
                                                <label for="first-name" class="block text-sm font-medium text-gray-700">Nama</label>
                                                <input v-model="userData.name" type="text" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email</label>
                                                <input v-model="userData.email" type="text" id="email-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="street-address" class="block text-sm font-medium text-gray-700">Password</label>
                                                <input v-model="userData.password" type="password" id="street-address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" />
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="country" class="block text-sm font-medium text-gray-700">Tipe Pengguna</label>
                                                <select v-model="userData.tipe_pengguna" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm">
                                                    <option value="2">Pengajar</option>
                                                    <option value="3">Mahasiswa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">Simpan</button>
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
import { useAuthStore } from "@/stores/auth";
import { ref } from "@vue/reactivity";
import Swal from "sweetalert2";
import { useRouter } from "vue-router";
const authStore = useAuthStore();
const router = useRouter();
const userData = ref({
    name: "",
    email: "",
    password: "",
    tipe_pengguna: "",
    status_pengguna: 1,
});
const registerUser = async () => {
    await axios
        .post("/api/register", userData.value, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            Swal.fire("Adding Success", "Data User Berhasil ditambahkan", "success");
            router.push({ name: "admin.user.list" });
        });
};
</script>
