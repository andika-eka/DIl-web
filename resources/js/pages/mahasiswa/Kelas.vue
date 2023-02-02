<template>
    <div>
        <index-navbar />
        <section class="px-4 sm:px-16 lg:px-32 pb-8">
            <div class="bg-white pb-24">
                <div>
                    <!-- Mobile filter dialog -->
                    <TransitionRoot as="template" :show="mobileFiltersOpen">
                        <Dialog
                            as="div"
                            class="relative z-40 lg:hidden"
                            @close="mobileFiltersOpen = false"
                        >
                            <TransitionChild
                                as="template"
                                enter="transition-opacity ease-linear duration-300"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="transition-opacity ease-linear duration-300"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="fixed inset-0 bg-black bg-opacity-25"
                                />
                            </TransitionChild>

                            <div class="fixed inset-0 z-40 flex">
                                <TransitionChild
                                    as="template"
                                    enter="transition ease-in-out duration-300 transform"
                                    enter-from="translate-x-full"
                                    enter-to="translate-x-0"
                                    leave="transition ease-in-out duration-300 transform"
                                    leave-from="translate-x-0"
                                    leave-to="translate-x-full"
                                >
                                    <DialogPanel
                                        class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl"
                                    >
                                        <div
                                            class="flex items-center justify-between px-4"
                                        >
                                            <h2
                                                class="text-lg font-medium text-gray-900"
                                            >
                                                Filters
                                            </h2>
                                            <button
                                                type="button"
                                                class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                                @click="
                                                    mobileFiltersOpen = false
                                                "
                                            >
                                                <span class="sr-only"
                                                    >Close menu</span
                                                >
                                                <XMarkIcon
                                                    class="h-6 w-6"
                                                    aria-hidden="true"
                                                />
                                            </button>
                                        </div>

                                        <!-- Filters -->
                                        <form
                                            class="mt-4 border-t border-gray-200"
                                        >
                                            <h3 class="sr-only">
                                                Daftar Materi
                                            </h3>
                                            <ul
                                                role="list"
                                                class="px-2 py-3 font-medium text-gray-900"
                                            >
                                                <li v-for="n in 4" :key="n">
                                                    <a class="block px-2 py-3"
                                                        >SubCPMK {{ n }}</a
                                                    >
                                                </li>
                                            </ul>

                                            <Disclosure
                                                as="div"
                                                v-for="i in 3"
                                                :key="i"
                                                class="border-t border-gray-200 px-4 py-6"
                                                v-slot="{ open }"
                                            >
                                                <h3
                                                    class="-mx-2 -my-3 flow-root"
                                                >
                                                    <DisclosureButton
                                                        class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500"
                                                    >
                                                        <span
                                                            class="font-medium text-gray-900"
                                                            >Test</span
                                                        >
                                                        <span
                                                            class="ml-6 flex items-center"
                                                        >
                                                            <PlusIcon
                                                                v-if="!open"
                                                                class="h-5 w-5"
                                                                aria-hidden="true"
                                                            />
                                                            <MinusIcon
                                                                v-else
                                                                class="h-5 w-5"
                                                                aria-hidden="true"
                                                            />
                                                        </span>
                                                    </DisclosureButton>
                                                </h3>
                                                <DisclosurePanel class="pt-6">
                                                    <div class="space-y-6">
                                                        <div
                                                            v-for="(
                                                                option,
                                                                optionIdx
                                                            ) in section.options"
                                                            :key="option.value"
                                                            class="flex items-center"
                                                        >
                                                            <input
                                                                :id="`filter-mobile-${section.id}-${optionIdx}`"
                                                                :name="`${section.id}[]`"
                                                                :value="
                                                                    option.value
                                                                "
                                                                type="checkbox"
                                                                :checked="
                                                                    option.checked
                                                                "
                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                            />
                                                            <label
                                                                :for="`filter-mobile-${section.id}-${optionIdx}`"
                                                                class="ml-3 min-w-0 flex-1 text-gray-500"
                                                                >{{
                                                                    option.label
                                                                }}</label
                                                            >
                                                        </div>
                                                    </div>
                                                </DisclosurePanel>
                                            </Disclosure>
                                        </form>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </Dialog>
                    </TransitionRoot>

                    <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div
                            class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6"
                        >
                            <h1
                                class="text-4xl font-bold tracking-tight text-gray-900 uppercase"
                            >
                                NAMA MATAKULIAH - KODE (TAHUN)
                            </h1>

                            <div class="flex items-center">
                                <button
                                    type="button"
                                    class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                                    @click="mobileFiltersOpen = true"
                                >
                                    <span class="sr-only">Filters</span>
                                    <Squares2X2Icon
                                        class="h-5 w-5"
                                        aria-hidden="true"
                                    />
                                </button>
                            </div>
                        </div>

                        <section
                            aria-labelledby="products-heading"
                            class="pt-6"
                        >
                            <h2 id="products-heading" class="sr-only">
                                Products
                            </h2>

                            <div
                                class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4"
                            >
                                <!-- Filters -->
                                <form class="hidden lg:block">
                                    <Disclosure
                                        as="div"
                                        v-for="section in 3"
                                        :key="section"
                                        class="border-b border-gray-200 py-6"
                                        v-slot="{ open }"
                                    >
                                        <h3 class="-my-3 flow-root">
                                            <DisclosureButton
                                                class="flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500"
                                            >
                                                <span
                                                    class="font-medium text-gray-900"
                                                    >Section</span
                                                >
                                                <span
                                                    class="ml-6 flex items-center"
                                                >
                                                    <PlusIcon
                                                        v-if="!open"
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                    <MinusIcon
                                                        v-else
                                                        class="h-5 w-5"
                                                        aria-hidden="true"
                                                    />
                                                </span>
                                            </DisclosureButton>
                                        </h3>
                                        <DisclosurePanel class="pt-6">
                                            <div class="space-y-4">
                                                <div
                                                    v-for="(
                                                        option, optionIdx
                                                    ) in 6"
                                                    :key="option"
                                                    class="flex items-center"
                                                >
                                                    <input
                                                        :id="`filter-${optionIdx}`"
                                                        :name="`${section}[]`"
                                                        :value="option.value"
                                                        type="checkbox"
                                                        :checked="
                                                            option.checked
                                                        "
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                                    />
                                                    <label
                                                        :for="`filter-${section.id}-${optionIdx}`"
                                                        class="ml-3 text-sm text-gray-600"
                                                        >option label</label
                                                    >
                                                </div>
                                            </div>
                                        </DisclosurePanel>
                                    </Disclosure>
                                </form>

                                <!-- Product grid -->
                                <div class="lg:col-span-3">
                                    <!-- Replace with your content -->
                                    <div
                                        class="h-96 rounded-lg border-4 border-dashed border-gray-200 lg:h-full"
                                    />
                                    <!-- /End replace -->
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
                <div class="overflow-hidden bg-white sm:rounded-lg mt-3">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Detail Kelas
                        </h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div
                                class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Kode Mata Kuliah
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    Margot Foster
                                </dd>
                            </div>
                            <div
                                class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Nama Mata Kuliah
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    Margot Foster
                                </dd>
                            </div>
                            <div
                                class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    CPMK
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    Backend Developer
                                </dd>
                            </div>
                            <div
                                class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Sub-CPMK
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    Fugiat ipsum ipsum deserunt culpa aute sint
                                    do nostrud anim incididunt cillum culpa
                                    consequat. Excepteur qui ipsum aliquip
                                    consequat sint. Sit id mollit nulla mollit
                                    nostrud in ea officia proident. Irure
                                    nostrud pariatur mollit ad adipisicing
                                    reprehenderit deserunt qui eu.
                                </dd>
                            </div>
                            <div
                                class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            >
                                <dt class="text-sm font-medium text-gray-500">
                                    Modul Kuliah
                                </dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                                >
                                    <ul
                                        role="list"
                                        class="divide-y divide-gray-200 rounded-md border border-gray-200"
                                    >
                                        <li
                                            class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                                        >
                                            <div
                                                class="flex w-0 flex-1 items-center"
                                            >
                                                <PaperClipIcon
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    aria-hidden="true"
                                                />
                                                <span
                                                    class="ml-2 w-0 flex-1 truncate"
                                                    >resume_back_end_developer.pdf</span
                                                >
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a
                                                    href="#"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                                    >Download</a
                                                >
                                            </div>
                                        </li>
                                        <li
                                            class="flex items-center justify-between py-3 pl-3 pr-4 text-sm"
                                        >
                                            <div
                                                class="flex w-0 flex-1 items-center"
                                            >
                                                <PaperClipIcon
                                                    class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                    aria-hidden="true"
                                                />
                                                <span
                                                    class="ml-2 w-0 flex-1 truncate"
                                                    >coverletter_back_end_developer.pdf</span
                                                >
                                            </div>
                                            <div class="ml-4 flex-shrink-0">
                                                <a
                                                    href="#"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500"
                                                    >Download</a
                                                >
                                            </div>
                                        </li>
                                    </ul>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </section>
        <footer-component />
    </div>
</template>

<script setup>
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import {
    ChevronDownIcon,
    FunnelIcon,
    MinusIcon,
    PlusIcon,
    Squares2X2Icon,
} from "@heroicons/vue/20/solid";
import IndexNavbar from "@/pages/components/Navbars/IndexNavbarMahasiswa.vue";
import FooterComponent from "@/pages/components/Footers/FooterDosen.vue";
import { useAuthStore } from "@/stores/auth";
import { useKelasStore } from "@/stores/kelas";
import { onMounted, ref } from "@vue/runtime-core";

const authStore = useAuthStore();
const kelasStore = useKelasStore();
const kelas = ref(null);
const getAClass = async () => {
    await axios
        .get("/api/getApprovedKelas", {
            headers: {
                Authorization: `Bearer ${authStore.authUser.api_token}`,
            },
        })
        .then((res) => {
            kelas.value = res.data.kelas;
        });
};

onMounted(async () => {
    await getAprovedClass();
});

const mobileFiltersOpen = ref(false);
</script>
