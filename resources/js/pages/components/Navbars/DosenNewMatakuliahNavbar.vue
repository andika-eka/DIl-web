<template>
    <div class="flex bg-gray-200 rounded-md pt-3 px-3 gap-2">
        <router-link
            to="/d/select-matakuliah"
            :class="[
                $router.currentRoute.value.path == '/d/select-matakuliah'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase hover:bg-emerald-700',
            ]"
        >
            Pilih Matakuliah
        </router-link>
        <router-link
            to="/d/sub-cpmk"
            :class="[
                $router.currentRoute.value.path == '/d/sub-cpmk'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase hover:bg-emerald-700',
            ]"
        >
            Sub-CPMK
        </router-link>
        <router-link
            to="/d/indikator"
            :class="[
                $router.currentRoute.value.path == '/d/indikator'
                    ? 'bg-emerald-700'
                    : 'bg-emerald-500',
                'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase hover:bg-emerald-700',
            ]"
        >
            Indikator
        </router-link>
    </div>
</template>

<script setup></script>
