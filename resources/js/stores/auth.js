import { defineStore } from "pinia";
import axios from "axios";
import Swal from "sweetalert2";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser,
    },
    actions: {
        logout: async function () {
            await Swal.fire({
                title: "Apakah anda yakin?",
                text: "Jika anda keluar maka anda perlu login kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Logout",
            }).then(async (result) => {
                if (result.isConfirmed) {
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
                            Swal.fire(
                                "Logout!",
                                "Anda sudah keluar dari session",
                                "success"
                            );
                        });
                }
            });
        },
    },
});
