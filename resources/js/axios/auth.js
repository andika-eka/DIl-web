import axios from "axios";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
const authAxios = axios.create({
    headers: {
        Authorization: `Bearer ${authStore.authUser.api_token}`,
    },
});

export default authAxios;
