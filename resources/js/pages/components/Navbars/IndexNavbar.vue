<template>
    <nav
        class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow"
    >
        <div
            class="container px-4 mx-auto flex flex-wrap items-center justify-between"
        >
            <div
                class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
            >
                <router-link to="/d/dashboard">
                    <a
                        class="text-slate-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
                        href="#pablo"
                    >
                        <i class="fas fa-laptop-code"></i> DIL-ML
                    </a>
                </router-link>
                <button
                    class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button"
                    v-on:click="setNavbarOpen"
                >
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div
                class="lg:flex flex-grow items-center"
                :class="[navbarOpen ? 'block' : 'hidden']"
                id="example-navbar-warning"
            >
                <ul
                    class="flex flex-col lg:flex-row list-none lg:ml-auto gap-4"
                >
                    <li class="flex items-center">
                        <router-link to="/d/dashboard">
                            <a
                                href="#"
                                class="hover:text-blueGray-500 text-blueGray-700 px-3 py-2 flex items-center text-xs uppercase font-bold"
                            >
                                Dashboard
                            </a>
                        </router-link>
                    </li>
                    <li class="flex items-center">
                        <button
                            @click="logout"
                            class="bg-red-500 text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button"
                        >
                            Logout
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "@vue/reactivity";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

const navbarOpen = ref(false);
const router = useRouter();
const auth = useAuthStore();

const setNavbarOpen = function () {
    navbarOpen.value = !navbarOpen.value;
};

const logout = async () => {
    await auth.logout();
    router.push("/login");
};
</script>
