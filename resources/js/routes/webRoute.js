// route untuk web pages
const routes = [
    {
        path: "/landing",
        component: () => import("@/pages/Landing.vue"),
    },
    {
        path: "/profile",
        component: () => import("@/pages/Profile.vue"),
    },
    {
        path: "/",
        component: () => import("@/pages/index.vue"),
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

export default routes;
