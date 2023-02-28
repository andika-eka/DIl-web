import { defineStore } from "pinia";
import axios from "axios";
import Swal from "sweetalert2";
import globalVar from "@/variable.js";
axios.defaults.baseURL = globalVar.full_path;

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser,
    },
    actions: {
        login: async function (credential) {
            await axios
                .post("/api/login", {
                    email: credential.email,
                    password: credential.password,
                })
                .then((res) => {
                    this.authUser = res.data;
                    this.cookie.setCookie("user", res.data);
                    if (this.cookie.getCookie("user").tipe_pengguna == 1) {
                        // if ()
                        this.$router.push({ name: "admin.dashboard" });
                    } else if (this.cookie.getCookie("user").tipe_pengguna == 2) {
                        this.$router.push({ name: "dosen.dashboard" });
                    } else {
                        this.$router.push({ name: "mahasiswa.dashboard" });
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: "error",
                        title: "Password atau Email salah",
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                });
        },
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
                            this.cookie.removeCookie("user");
                            Swal.fire("Logout!", "Anda sudah keluar dari session", "success");
                        });
                }
            });
        },
    },
});
