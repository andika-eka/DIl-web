<template>
    <div>
        <a class="text-slate-500 block" href="#pablo" ref="btnDropdownRef" v-on:click="toggleDropdown($event)">
            <div class="items-center flex">
                <span class="w-12 h-12 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full">
                    <img alt="Profile" class="w-full rounded-full align-middle border-none shadow-lg" :src="getProfile()" />
                </span>
            </div>
        </a>
        <div
            ref="popoverDropdownRef"
            class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
            v-bind:class="{
                hidden: !dropdownPopoverShow,
                block: dropdownPopoverShow,
            }"
        >
            <a href="#" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"> Profile </a>
            <div class="h-0 my-2 border border-solid border-slate-100" />
            <a href="#" @click="logout" class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"> Logout </a>
        </div>
    </div>
</template>

<script>
import { createPopper } from "@popperjs/core";
import { useAuthStore } from "@/stores/auth";
import globalVar from "@/variable.js";

export default {
    data() {
        return {
            authStore: useAuthStore(),
            dropdownPopoverShow: false,
        };
    },
    methods: {
        logout: async function () {
            await this.authStore.logout();
            this.$router.push({ name: "login" });
        },
        getProfile: function () {
            return `${globalVar.full_path}/img/team-4-470x470.png`;
        },
        toggleDropdown: function (event) {
            event.preventDefault();
            if (this.dropdownPopoverShow) {
                this.dropdownPopoverShow = false;
            } else {
                this.dropdownPopoverShow = true;
                createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
                    placement: "bottom-start",
                });
            }
        },
    },
};
</script>
