<template>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-lg">Daftar Sub-CPMK</h3>
                </div>
                <!-- Add Button -->
                <router-link :to="{ name: 'admin.kelas.add' }">
                    <button class="bg-emerald-500 hover:bg-emerald-700 px-4 py-2 rounded-md text-white text-sm">
                        Tambah Sub-CPMK
                        <i class="fas fa-plus ml-2"></i>
                    </button>
                </router-link>
            </div>
        </div>
        <div class="block w-full overflow-x-auto relative p-8">
            <!-- Projects table -->
            <table id="kelas_table" class="display w-full">
                <thead>
                    <tr>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Narasi Sub-CPMK</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Bahan Ajar Sub-CPMK</th>
                        <th class="bg-slate-50 text-slate-500 border-slate-100 px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in subCpmk" :key="index">
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                            {{ item.narasi_subCpmk }}
                        </td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4"></td>
                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                            <div class="space-x-2">
                                <button class="px-3 py-2 bg-orange-500 rounded hover:bg-orange-600">
                                    <i class="fas fa-pen text-white"></i>
                                </button>
                                <button class="px-3 py-2 bg-red-500 rounded hover:bg-red-600">
                                    <i class="fas fa-trash text-white"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
