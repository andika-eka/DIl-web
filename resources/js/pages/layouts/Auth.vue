<template>
    <div>
        <main>
            <section class="relative w-full h-full py-40 min-h-screen">
                <div class="absolute top-0 w-full h-full bg-slate-800 bg-no-repeat bg-full" :style="getBgImage()"></div>
                <router-view />
            </section>
        </main>
    </div>
</template>

<script setup>
import globalVar from "@/variable.js";
const getBgImage = () => {
    return `background-image: url('${globalVar.full_path}/img/register_bg_2.png');`;
};
</script>
