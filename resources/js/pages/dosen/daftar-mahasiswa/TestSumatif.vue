<template>
    <section class="px-4 mb-6 sm:px-16 lg:px-32 pt-16 pb-8 my-6">
        <NavbarListMahasiswa />
    </section>
</template>

<script setup>
import NavbarListMahasiswa from "@/pages/components/Navbars/ListMahasiswaNavbar.vue";
import { useKelasStore } from "@/stores/kelas";
import { reactive, ref } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";
</script>
