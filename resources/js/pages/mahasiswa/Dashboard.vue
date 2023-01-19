<template>
    <div>
        <index-navbar />
        <section
            class="px-4 sm:px-16 lg:px-32 grid grid-cols-1 md:grid-cols-2 md:gap-3 lg:grid-cols-3 pt-16 pb-8"
        >
            <!-- Searching -->

            <!-- Loop Items -->
            <div
                class="mt-4 relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-emerald-500"
            >
                <img
                    alt="..."
                    src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=700&q=80"
                    class="w-full align-middle rounded-t-lg"
                />
                <blockquote class="relative p-8">
                    <svg
                        preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 583 95"
                        class="absolute left-0 w-full block h-95-px -top-94-px"
                    >
                        <polygon
                            points="-30,95 583,95 583,65"
                            class="text-emerald-500 fill-current"
                        ></polygon>
                    </svg>
                    <h4 class="text-xl font-bold text-white">Mahasiswa</h4>
                    <p class="text-md font-light mt-2 text-white">
                        Putting together a page has never been easier than
                        matching together pre-made components. From landing
                        pages presentation to login areas, you can easily
                        customise and built your pages.
                    </p>
                </blockquote>
                <div class="px-8 pb-4">
                    <button
                        class="bg-indigo-500 text-white active:bg-teal-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button"
                    >
                        <i class="fas fa-gear"></i>
                        Settings
                    </button>
                </div>
            </div>
        </section>
        <footer-component />
    </div>
</template>

<script setup>
import IndexNavbar from "@/pages/components/Navbars/IndexNavbar.vue";
import FooterComponent from "@/pages/components/Footers/FooterDosen.vue";
</script>
