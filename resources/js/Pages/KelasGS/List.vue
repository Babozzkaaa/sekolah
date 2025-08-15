<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    kelassiswa: Object,
    kelasgs: Object,
    kelasguru: Object,
    kelas: Object,
});

// const satu = (index) => {
//     if (index == 0) {
//         return true;
//     }
//     return props.kelasgs.data[index].id !== props.kelasgs.data[index - 1].id;
// };
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
                                    Guru
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
                                v-for="(kelasgs, i) in kelasgs.data"
                                :key="kelasgs.nama_kelas"
                            >
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    <!-- <div
                                >
                                    {{ kelasgs.siswa }}
                                </div> -->
                                    <div
                                        v-for="(siswa, is) in kelasgs.siswa"
                                        :key="is"
                                    >
                                        {{ siswa }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    <div
                                        v-for="(guru, ig) in kelasgs.guru"
                                        :key="ig"
                                    >
                                        {{ guru }}
                                    </div>
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{ kelasgs.kelas }}
                                </td>
                            </tr>

                            <!-- 
                                v-for="index in kelassiswa.data.length >
                                kelasguru.data.length
                                    ? kelassiswa.data.length
                                    : kelasguru.data.length"
                                :key="index - 1"
                            >
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{
                                        kelassiswa.data[index - 1]?.siswa
                                            ?.nama || '-'
                                    }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{
                                        kelasguru.data[index - 1]?.guru?.nama ||
                                        '-'
                                    }}
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div
                    class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-between sm:hidden">
                            <a
                                v-if="kelasgs.prev_page_url"
                                :href="kelasgs.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                            >
                                Previous
                            </a>
                            <a
                                v-if="kelasgs.next_page_url"
                                :href="kelasgs.next_page_url"
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
                                    Showing {{ kelasgs.from }} to
                                    {{ kelasgs.to }} of
                                    {{ kelasgs.total }} results
                                </p>
                            </div>
                            <div>
                                <nav
                                    class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
                                >
                                    <a
                                        v-for="link in kelasgs.links"
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
