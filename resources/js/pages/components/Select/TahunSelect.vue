<template>
    <Listbox as="div" v-model="selected">
        <ListboxLabel class="block text-sm font-medium text-gray-700">{{
            label
        }}</ListboxLabel>
        <div class="relative mt-1">
            <ListboxButton
                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-emerald-400 focus:outline-none focus:ring-1 focus:ring-emerald-400 sm:text-sm"
            >
                <span class="flex items-center">
                    <span
                        :class="[
                            selected !== null ? '' : 'py-2.5',
                            'block truncate',
                        ]"
                        >{{ selected }}</span
                    >
                </span>
                <span
                    class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2"
                >
                    <ChevronUpDownIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </span>
            </ListboxButton>

            <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions
                    class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                >
                    <ListboxOption
                        as="template"
                        v-for="thn in yearlist"
                        :key="thn"
                        :value="thn"
                        v-slot="{ active, selected }"
                    >
                        <li
                            :class="[
                                active
                                    ? 'text-white bg-emerald-500'
                                    : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-3 pr-9',
                            ]"
                        >
                            <div class="flex items-center">
                                <span
                                    :class="[
                                        selected
                                            ? 'font-semibold'
                                            : 'font-normal',
                                        'ml-3 block truncate',
                                    ]"
                                    >{{ thn }}</span
                                >
                            </div>

                            <span
                                v-if="selected"
                                :class="[
                                    active ? 'text-white' : 'text-emerald-500',
                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                ]"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </div>
    </Listbox>
</template>

<script setup>
import {
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon } from "@heroicons/vue/20/solid";
import { ref } from "@vue/reactivity";
import { onMounted, watch } from "@vue/runtime-core";
import { useKelasStore } from "@/stores/kelas";

const kelasStore = useKelasStore();
const props = defineProps({
    label: {
        type: String,
        default: "Tahun",
    },
});

const yearlist = ref([]);
const selected = ref(null);
const makeTahunList = () => {
    const date = new Date(Date.now());
    const yearnow = date.getFullYear();
    for (let i = 0; i < 10; i++) {
        yearlist.value[i] = yearnow - i;
    }
};

watch(selected, () => {
    kelasStore.kelas.tahun_kelas = selected;
});

onMounted(() => {
    makeTahunList();
});
</script>
