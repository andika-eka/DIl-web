import { defineStore } from "pinia";
import axios from "axios";
import { routerKey } from "vue-router";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser,
    },
    actions: {
        logout: async function () {
            await axios
                .post(
                    "/api/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.authUser.api_token}`,
                        },
                    }
                )
                .then((res) => {
                    this.authUser = null;
                });
        },
    },
});
