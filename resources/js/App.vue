<script setup>
import { onMounted } from "@vue/runtime-core";
import { RouterView } from "vue-router";
import { useCookie } from "vue-cookie-next";
import { useAuthStore } from "@/stores/auth";
const cookie = useCookie();
const auth = useAuthStore();

onMounted(() => {
    auth.authUser = cookie.getCookie("user");
});
</script>

<template>
    <div>
        <router-view />
    </div>
</template>
