<template>
    <div>
        <main>
            <div>
                <index-navbar />
                <router-view />
                <!-- <footer-component /> -->
            </div>
        </main>
    </div>
</template>

<script setup>
import IndexNavbar from "@/pages/components/Navbars/IndexNavbar.vue";
</script>
