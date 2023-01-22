<template>
    <div>
        <a
            class="text-slate-500 block"
            href="#pablo"
            ref="btnDropdownRef"
            v-on:click="toggleDropdown($event)"
        >
            <div class="items-center flex">
                <span
                    class="w-12 h-12 text-sm text-white bg-slate-200 inline-flex items-center justify-center rounded-full"
                >
                    <img
                        alt="..."
                        class="w-full rounded-full align-middle border-none shadow-lg"
                        :src="image"
                    />
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
            <a
                href="#"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"
            >
                Profile
            </a>
            <div class="h-0 my-2 border border-solid border-slate-100" />
            <a
                href="#"
                @click="logout"
                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-slate-700"
            >
                Logout
            </a>
        </div>
    </div>
</template>

<script>
import { createPopper } from "@popperjs/core";
import { useAuthStore } from "@/stores/auth";
import image from "@/assets/img/team-1-800x800.jpg";

export default {
    data() {
        return {
            authStore: useAuthStore(),
            dropdownPopoverShow: false,
            image: image,
        };
    },
    methods: {
        logout: async function () {
            await this.authStore.logout();
            this.$router.push("/login");
        },
        toggleDropdown: function (event) {
            event.preventDefault();
            if (this.dropdownPopoverShow) {
                this.dropdownPopoverShow = false;
            } else {
                this.dropdownPopoverShow = true;
                createPopper(
                    this.$refs.btnDropdownRef,
                    this.$refs.popoverDropdownRef,
                    {
                        placement: "bottom-start",
                    }
                );
            }
        },
    },
};
</script>
