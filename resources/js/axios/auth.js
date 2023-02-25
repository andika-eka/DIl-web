import axios from "axios";
import { useAuthStore } from "@/stores/auth";
import globalVar from "@/variable.js";

const authStore = useAuthStore();
const authAxios = axios.create({
    headers: {
        Authorization: `Bearer ${authStore.authUser.api_token}`,
    },
});
authAxios.defaults.baseURL = globalVar.full_path;

export default authAxios;
