<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-slate-100">
            <admin-navbar />
            <header-stats />
            <div class="px-4 md:px-10 mx-auto w-full -m-24">
                <router-view />
                <footer-admin />
            </div>
        </div>
    </div>
</template>
<script>
import AdminNavbar from "@/pages/components/Navbars/AdminNavbar.vue"
import Sidebar from "@/pages/components/Sidebar/Sidebar.vue"
import HeaderStats from "@/pages/components/Headers/HeaderStats.vue"
import FooterAdmin from "@/pages/components/Footers/FooterAdmin.vue"
export default {
    name: "admin-layout",
    components: {
        AdminNavbar,
        Sidebar,
        HeaderStats,
        FooterAdmin,
    },
}
</script>
