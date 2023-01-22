import { defineStore } from "pinia";
import axios from "axios";

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
                    document.cookie =
                        "user=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
                });
        },
    },
});
