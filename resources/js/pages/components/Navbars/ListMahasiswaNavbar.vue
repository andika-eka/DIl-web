<template>
    <div class="flex bg-gray-100 rounded-md pt-3 px-3 gap-2">
        <router-link to="`/d/setting/${kelasStore.kelas.id_kelas}`">
            <div
                :class="[
                    $router.currentRoute.value.name == '/d/test-formatif'
                        ? 'bg-emerald-700'
                        : 'bg-emerald-500',
                    'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
                ]"
            >
                Test Formatif
            </div>
        </router-link>
        <router-link to="/d/sub-cpmk">
            <div
                :class="[
                    $router.currentRoute.value.name != '/d/test-sumatif'
                        ? 'bg-emerald-700'
                        : 'bg-emerald-500',
                    'text-white sahdow rounded-t-lg py-3 px-6 font-bold text-xs uppercase',
                ]"
            >
                Test Sumatif
            </div>
        </router-link>
    </div>
</template>

<script setup></script>
