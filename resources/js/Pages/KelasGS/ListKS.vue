<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    kelassiswa: Object,
    kelas: Object,
    siswa: Object,
});

const satu = (index) => {
    if (index == 0) {
        return true;
    }
    return (
        props.kelassiswa.data[index].kelas.id !==
        props.kelassiswa.data[index - 1].kelas.id
    );
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="min-w-screen bg-gray-50">
            <div class="mx-auto max-w-7xl sm:px-6 lg:py-8">
                <div
                    class="mx-3 mb-8 flex items-center justify-between sm:px-3"
                >
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Daftar {{ kelas?.nama }}
                    </h1>
                </div>

                <div
                    class="overflow-x-auto rounded-lg border border-gray-200 bg-white p-6"
                >
                    <table class="w-full divide-gray-200 overflow-hidden">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Siswa
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Kelas
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="(kelassiswa, index) in kelassiswa.data"
                                :key="kelassiswa.id"
                            >
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{ kelassiswa.siswa.nama }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    <span v-if="satu(index)">
                                        {{ kelassiswa.kelas.nama }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div
                    class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a
                                v-if="kelassiswa.prev_page_url"
                                :href="kelassiswa.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                            >
                                Previous
                            </a>
                            <a
                                v-if="kelassiswa.next_page_url"
                                :href="kelassiswa.next_page_url"
                                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                            >
                                Next
                            </a>
                        </div>
                        <div
                            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
                        >
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing {{ kelassiswa.from }} to
                                    {{ kelassiswa.to }} of
                                    {{ kelassiswa.total }} results
                                </p>
                            </div>
                            <div>
                                <nav
                                    class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
                                >
                                    <a
                                        v-for="link in kelassiswa.links"
                                        :key="link.label"
                                        :href="link.url"
                                        v-html="link.label"
                                        :class="[
                                            'relative inline-flex items-center border px-4 py-2 text-sm font-medium',
                                            link.active
                                                ? 'z-10 border-blue-500 bg-blue-50 text-blue-600'
                                                : 'border-gray-300 bg-white text-gray-500 hover:bg-gray-50',
                                        ]"
                                    />
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
