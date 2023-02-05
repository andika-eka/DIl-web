<template>
    <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
        <router-link :to="`/d/setting/${$route.params.id}`">
            <div
                :class="[
                    $router.currentRoute.value.name == '/d/setting'
                        ? 'bg-emerald-700'
                        : 'bg-emerald-500',
                    'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
                ]"
            >
                Pengaturan Kelas
            </div>
        </router-link>
        <router-link :to="`/d/sub-cpmk/${kelasStore.kelas.id_matakuliah}`">
            <div
                :class="[
                    $router.currentRoute.value.name != '/d/setting'
                        ? 'bg-emerald-700'
                        : 'bg-emerald-500',
                    'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
                ]"
            >
                Pengaturan Matakuliah
            </div>
        </router-link>
    </div>
</template>

<script setup>
import { useKelasStore } from "@/stores/kelas";
const kelasStore = useKelasStore();
</script>
