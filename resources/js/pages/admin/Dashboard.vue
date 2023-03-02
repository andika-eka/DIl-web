<template>
    <div class="font-quick h-screen">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mt-3">
            <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                <p>Jumlah User</p>
                <div class="text-5xl">10</div>
                <UserIcon class="w-16 text-gray-400 opacity-30 absolute right-4 top-7" />
            </div>
            <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                <p>Jumlah Matakuliah</p>
                <div class="text-5xl">10</div>
                <BookOpenIcon class="w-16 text-gray-400 opacity-30 absolute right-4 top-7" />
            </div>
            <div class="col-span-1 bg-gray-200 hover:bg-gray-300 p-4 rounded-lg relative">
                <p>Jumlah Kelas</p>
                <div class="text-5xl">10</div>
                <ArchiveBoxIcon class="w-16 text-gray-400 opacity-30 absolute right-4 top-7" />
            </div>
        </div>
    </div>
</template>
<script setup>
import { UserIcon, ArchiveBoxIcon, BookOpenIcon } from "@heroicons/vue/20/solid"
</script>
