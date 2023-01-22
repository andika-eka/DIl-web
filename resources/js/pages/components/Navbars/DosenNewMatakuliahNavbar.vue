<template>
    <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
        <div
            :class="[
                $router.currentRoute.value.path == '/d/select-matakuliah'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
            ]"
        >
            Pilih Matakuliah
        </div>
        <div
            :class="[
                $router.currentRoute.value.path == '/d/tambah-kelas'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
            ]"
        >
            Kelas
        </div>
        <div
            :class="[
                $router.currentRoute.value.path == '/d/sub-cpmk'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
            ]"
        >
            Sub-CPMK
        </div>
        <div
            :class="[
                $router.currentRoute.value.path == '/d/indikator'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
            ]"
        >
            Indikator
        </div>
    </div>
</template>

<script setup></script>
