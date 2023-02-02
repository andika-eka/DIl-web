<template>
    <div
        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']"
    >
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3
                        class="font-semibold text-lg"
                        :class="[
                            color === 'light' ? 'text-slate-700' : 'text-white',
                        ]"
                    >
                        List Matakuliah
                    </h3>
                </div>
                <!-- Add Button -->
                <router-link to="/a/add-matakuliah">
                    <button
                        class="bg-emerald-500 hover:bg-emerald-700 px-4 py-2 rounded-md text-white text-sm"
                    >
                        Add Matakuliah
                        <i class="fas fa-plus ml-2"></i>
                    </button>
                </router-link>
            </div>
        </div>
        <div class="block w-full overflow-x-auto relative p-8">
            <!-- Projects table -->
            <DataTable :data="matakuliah" :columns="columns" class="w-full">
                <thead>
                    <tr>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            Kode Matakuliah
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            Nama Matakuliah
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            CPMK
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        ></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </DataTable>
        </div>
    </div>
</template>
<script setup>
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";
import DataTable from "datatables.net-vue3";
import DataTablesLib from "datatables.net";

DataTable.use(DataTablesLib);

const authStore = useAuthStore();
const matakuliah = ref(null);
const columns = ref([
    { data: "kode_mataKuliah" },
    { data: "nama_mataKuliah" },
    { data: "cpmk", width: "50%" },
]);

const props = defineProps({
    color: {
        default: "light",
        validator: function (value) {
            // The value must match one of these strings
            return ["light", "dark"].indexOf(value) !== -1;
        },
    },
});

onMounted(async () => {
    await getMatakuliah();
});

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
</script>

<style>
@import "datatables.net-dt";
</style>
