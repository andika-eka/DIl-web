<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <h3 class="text-2xl font-medium leading-6 text-gray-900 mb-5">
            Pengaturan Kelas -
            <span class="uppercase">{{ matakuliah.nama_mataKuliah }} ({{ matakuliah.kode_mataKuliah }})</span>
        </h3>
        <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
            <div class="bg-emerald-500 text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase">Pengaturan Kelas</div>
        </div>
        <div class="my-3 p-4 text-3xl font-normal leading-normal text-emerald-800 mb-28">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Waktu Perkuliahan</h3>
                            <p class="mt-1 text-sm text-gray-600">Silakan isi waktu perkulihaan dengan benar pada form disamping.</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label for="company-website" class="block text-sm font-medium text-gray-700">Mulai</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="kelas.tanggalMulai_kelas" type="date" name="kode-matakuliah" id="kode-matakuliah" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="company-website" class="block text-sm font-medium text-gray-700">Berakhir</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="kelas.tanggalSelesai_kelas" type="date" name="kode-matakuliah" id="kode-matakuliah" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Identitas Kelas</h3>
                            <p class="mt-1 text-sm text-gray-600">Silakan masukkan data lainnya pada form disamping, terkait kelas kuliah yang dibuka.</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select v-model="kelas.tahun_kelas" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm">
                                                    <option v-for="(item, index) in yearlist" :key="index" :value="item">
                                                        {{ item }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">Semester</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select v-model="kelas.semester_kelas" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select v-model="kelas.nama_kelas" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="IKI">IKI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Jenis Kelas</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <select v-model="kelas.jenis_kelas" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm">
                                                    <option value="1">Reguler</option>
                                                    <option value="2">International</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-span-">
                                            <label class="block text-sm font-medium text-gray-700">Status Kelas</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <!-- Select -->
                                                <!-- Aktif / Tidak Aktif -->
                                                <select v-model="kelas.status_kelas" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm">
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Non-Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Pembobotan Soal</h3>
                            <p class="mt-1 text-sm text-gray-600">Silakan isi form disamping dengan benar sesuai dengan level taksonomi bloom.</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C1</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC1" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C2</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC2" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C3</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC3" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C4</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC4" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C5</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC5" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-1">
                                            <label class="block text-sm font-medium text-gray-700">Bobot C6</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.bobotC6" type="number" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Pengaturan Lainnya</h3>
                            <p class="mt-1 text-sm text-gray-600">Pengaturan Kriteria Ketuntasan Minimun (KKM), waktu tunggu setelah remidi, dan tanggal pelaksanaan tes sumatif</p>
                        </div>
                    </div>
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="shadow-lg sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3">
                                            <label for="company-website" class="block text-sm font-medium text-gray-700">Kriteria Ketuntasan Minimum (KKM)</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.KKM" type="number" min="1" max="100" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="about" class="block text-sm font-medium text-gray-700">Waktu Tunggu untuk melakukan Tes Formatif Ulang</label>
                                        <div class="mt-1 flex rounded-md">
                                            <input v-model="formdata.waktu_tunggu_formatif" type="number" class="block w-full flex-1 rounded-l-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            <span class="inline-flex items-center rounded-r-md border border-l-0 border-emerald-300 bg-emerald-500 px-3 text-sm text-white">Jam</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-4">
                                            <label for="company-website" class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan Tes Sumatif</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.tgl_sumatif" type="datetime-local" min="1" max="100" name="kode-matakuliah" id="kode-matakuliah" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label for="soalformatif" class="block text-sm font-medium text-gray-700">Jumlah Soal Formatif per-Indikator</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.soal_formatif_per_indikator" type="number" name="soalformatif" id="soalformatif" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="soalsumatif" class="block text-sm font-medium text-gray-700">Jumlah Soal Sumatif per-Indikator</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <input v-model="formdata.soal_sumatif_per_indikator" type="number" name="soalsumatif" id="soalsumatif" class="block w-full flex-1 rounded-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="about" class="block text-sm font-medium text-gray-700">Maksimal Jumlah Tes Formatif</label>
                                        <div class="mt-1 flex rounded-md">
                                            <input v-model="formdata.batas_pengulangan_remidi" type="number" class="block w-full flex-1 rounded-l-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                            <span class="inline-flex items-center rounded-r-md border border-l-0 border-emerald-300 bg-emerald-500 px-3 text-sm text-white">Kali</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-6">
                                        <div class="col-span-2">
                                            <label for="about" class="block text-sm font-medium text-gray-700">Waktu per-Soal untuk Tes Formatif</label>
                                            <div class="mt-1 flex rounded-md">
                                                <input v-model="formdata.waktu_per_soal_formatif" type="number" class="block w-full flex-1 rounded-l-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                                <span class="inline-flex items-center rounded-r-md border border-l-0 border-emerald-300 bg-emerald-500 px-3 text-sm text-white">Menit</span>
                                            </div>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="about" class="block text-sm font-medium text-gray-700"> Waktu per-Soal untuk Tes Sumatif</label>
                                            <div class="mt-1 flex rounded-md">
                                                <input v-model="formdata.waktu_per_soal_sumatif" type="number" class="block w-full flex-1 rounded-l-md border-gray-300 focus:border-emerald-400 focus:ring-emerald-400 sm:text-sm" />
                                                <span class="inline-flex items-center rounded-r-md border border-l-0 border-emerald-300 bg-emerald-500 px-3 text-sm text-white">Menit</span>
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
                <router-link :to="{ name: 'dosen.kelas', params: { id_kelas: route.params.id_kelas } }">
                    <button type="submit" class="justify-center rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">Kembali</button>
                </router-link>
                <button @click="saveSetting" type="button" class="justify-center mt-2 rounded-md border border-transparent bg-emerald-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">Simpan Perubahan</button>
            </div>
        </div>
    </section>
</template>

<script setup>
import NavbarNewMataKuliah from "@/pages/components/Navbars/DosenNewMatakuliahNavbar.vue";
import { reactive, ref } from "@vue/reactivity";
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import authAxios from "@/axios/auth";
import Swal from "sweetalert2";
import { onMounted } from "@vue/runtime-core";

const router = useRouter();
const route = useRoute();
const authStore = useAuthStore();
const kelasStore = useKelasStore();

// Untuk tampilan
const matakuliah = ref({
    id_matakuliah: "",
    kode_matakuliah: "",
    nama_matakuliah: "",
    cpmk: "",
});
const yearlist = ref([]);
const makeTahunList = () => {
    const date = new Date(Date.now());
    const yearnow = date.getFullYear();
    for (let i = 0; i < 10; i++) {
        yearlist.value[i] = yearnow - i;
    }
};

// Identitas Kelas
const kelas = ref({
    id_matakuliah: "",
    tanggalMulai_kelas: "",
    tanggalSelesai_kelas: "",
    jenis_kelas: "",
    nama_kelas: "",
    status_kelas: "",
    tahun_kelas: "",
    semester_kelas: "",
});

// Pengaturan Kelas
const formdata = ref({
    bobotC1: "",
    bobotC2: "",
    bobotC3: "",
    bobotC4: "",
    bobotC5: "",
    bobotC6: "",
    KKM: "",
    waktu_tunggu_formatif: "",
    waktu_per_soal_formatif: "",
    waktu_per_soal_sumatif: "",
    soal_formatif_per_indikator: 1,
    soal_sumatif_per_indikator: 1,
    batas_pengulangan_remidi: "",
    tgl_sumatif: "",
});

const getKelas = async () => {
    await axios
        .get(`/api/Kelas/${route.params.id_kelas}`, {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            matakuliah.value = res.data.kelas.matakuliah;
            // identitas kelas
            kelas.value.id_matakuliah = res.data.kelas.id_matakuliah;
            kelas.value.tanggalMulai_kelas = res.data.kelas.tanggalMulai_kelas;
            kelas.value.tanggalSelesai_kelas = res.data.kelas.tanggalSelesai_kelas;
            kelas.value.tahun_kelas = res.data.kelas.tahun_kelas;
            kelas.value.semester_kelas = res.data.kelas.semester_kelas;
            kelas.value.nama_kelas = res.data.kelas.nama_kelas;
            kelas.value.jenis_kelas = res.data.kelas.jenis_kelas;
            kelas.value.status_kelas = res.data.kelas.status_kelas;

            console.log(res.data);
            formdata.value = res.data.kelas.settings;
        });
};

const applyIdentitasKelas = async () => {
    await authAxios.post(`/api/Kelas/${route.params.id_kelas}`, kelas.value);
};

const applySetting = async () => {
    await authAxios.post(`/api/Kelas/${route.params.id_kelas}/applySettings`, formdata.value);
};

const saveSetting = () => {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "Semua data yang telah diubah akan disimpan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, simpan pengaturan!",
        cancelButtonText: "Batal!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            applyIdentitasKelas();
            applySetting();
            Swal.fire("Berhasil", "Pengaturan disimpan", "success");
        }
    });
};

onMounted(async () => {
    await getKelas();
    makeTahunList();
});
</script>
