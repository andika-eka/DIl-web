<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-slate-100">
            <admin-navbar />
            <div class="relative bg-emerald-600 md:pt-32 pb-16 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full"></div>
            </div>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <router-view />
                <footer-admin />
            </div>
        </div>
    </div>
</template>
<script>
import AdminNavbar from "@/pages/components/Navbars/AdminNavbar.vue";
import Sidebar from "@/pages/components/Sidebar/Sidebar.vue";
import FooterAdmin from "@/pages/components/Footers/FooterAdmin.vue";
export default {
    name: "admin-layout",
    components: {
        AdminNavbar,
        Sidebar,
        FooterAdmin,
    },
};
</script>
