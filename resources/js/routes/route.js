import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

// import route
import adminRoute from "./adminRoute";
import authRoute from "./authRoute";
import dosenRoute from "./dosenRoute";
import mhsRoute from "./mhsRoute";

const routes = [
    ...authRoute,
    ...adminRoute,
    ...dosenRoute,
    ...mhsRoute,
    // {
    //     path: "/:pathMatch(.*)*",
    //     component: () => import("@/pages/auth/Register.vue"),
    // },
];

const router = createRouter({
    routes,
    history: createWebHistory(),
});

// Middleware
router.beforeEach((to, from, next) => {
    const auth = useAuthStore();
    if (to.meta.requireAuth) {
        if (auth.user != null) {
            // check per role
            if (to.meta.role == "admin") {
                if (auth.user.tipe_pengguna == 1) {
                    next();
                } else {
                    next(from);
                }
            }
            if (to.meta.role == "dosen") {
                if (auth.user.tipe_pengguna == 2) {
                    next();
                } else {
                    next(from);
                }
            }
            if (to.meta.role == "mahasiswa") {
                if (auth.user.tipe_pengguna == 3) {
                    next();
                } else {
                    next(from);
                }
            }
        } else {
            next({ name: "login" });
        }
    }

    if (to.meta.authRoute) {
        if (auth.user == null) {
            next();
        } else {
            next(from);
        }
    }
});

export default router;
