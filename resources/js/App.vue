<script setup>
import { RouterView, RouterLink } from "vue-router"
</script>

<template>
    <router-link :to="{name: 'home'}">welcome</router-link>
    <router-link :to="{name: 'a.dashboard'}">login</router-link>
    <router-view />
</template>
