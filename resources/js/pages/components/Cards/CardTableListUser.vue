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
                        List User
                    </h3>
                </div>
            </div>
        </div>
        <div class="block w-full overflow-x-auto relative p-8">
            <!-- Projects table -->
            <DataTable :data="users" :columns="columns" class="w-full">
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
                            Nama User
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            Email
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            Tipe Pengguna
                        </th>
                        <th
                            class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                            :class="[
                                color === 'light'
                                    ? 'bg-slate-50 text-slate-500 border-slate-100'
                                    : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                            ]"
                        >
                            Status
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
                <tbody>
                    <!-- <tr>
                        <th
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left flex items-center"
                        >
                            <img
                                :src="bootstrap"
                                class="h-12 w-12 bg-white rounded-full border"
                                alt="..."
                            />
                            <span
                                class="ml-3 font-bold"
                                :class="[
                                    color === 'light'
                                        ? 'text-slate-600'
                                        : 'text-white',
                                ]"
                            >
                                Argon Design System
                            </span>
                        </th>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            $2,500 USD
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            Admin
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"
                        >
                            <i class="fas fa-circle mr-2 text-emerald-500"></i>
                            Aktif
                        </td>
                        <td
                            class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-right"
                        >
                            <table-dropdown />
                        </td>
                    </tr> -->
                </tbody>
            </DataTable>
        </div>
    </div>
</template>
<script setup>
import TableDropdown from "@/pages/components/Dropdowns/TableDropdown.vue";
import bootstrap from "@/assets/img/bootstrap.jpg";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "@vue/runtime-core";
import DataTable from "datatables.net-vue3";
import DataTablesLib from "datatables.net";

DataTable.use(DataTablesLib);

const authStore = useAuthStore();
const users = ref(null);
const columns = ref([
    { data: "name" },
    { data: "email" },
    {
        data: null,
        render: function (data, type, row, meta) {
            switch (data.tipe_pengguna) {
                case 1:
                    return "Admin";
                    break;
                case 2:
                    return "Pengajar";
                    break;
                case 3:
                    return "Mahasiswa";
                    break;
            }
        },
    },
    {
        data: null,
        render: function (data, type, row, meta) {
            return data.status_pengguna == 1 ? "Aktif" : "Non-Aktif";
        },
    },
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
    await getUser();
});

const getUser = async () => {
    await axios
        .get("/api/user", {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            users.value = res.data;
        });
};
</script>

<style>
@import "datatables.net-dt";
</style>
