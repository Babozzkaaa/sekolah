<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    siswa: Object,
});

const showDeleteModal = ref(false);
const siswaToDelete = ref(null);

const confirmDelete = (siswa) => {
    siswaToDelete.value = siswa;
    showDeleteModal.value = true;
};

const deleteSiswa = async () => {
    if (!siswaToDelete.value) return;

    try {
        await router.delete(route('siswa.delete', siswaToDelete.value.id));
        showDeleteModal.value = false;
    } catch (error) {
        console.error('Error mendelete siswa:', error);
    }
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
                        Daftar Siswa
                    </h1>
                    <a
                        :href="route('siswa.create')"
                        class="w-34 mb-4 inline-block rounded-md border border-transparent bg-blue-600 px-2 py-2 text-white hover:bg-blue-800"
                    >
                        + Tambah Siswa
                    </a>
                </div>

                <div
                    class="overflow-x-auto rounded-lg border border-gray-200 bg-white p-6"
                >
                    <table class="w-full divide-gray-200 overflow-x-auto">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Nama
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    NIS
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Jenis Kelamin
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Tanggal Lahir
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                >
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="siswa in siswa.data" :key="siswa.id">
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{ siswa.nama }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{ siswa.nis }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    <span v-if="siswa.jenis_kelamin === 'L'">
                                        Laki-laki
                                    </span>
                                    <span
                                        v-else-if="siswa.jenis_kelamin === 'P'"
                                    >
                                        Perempuan
                                    </span>
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    {{ siswa.tanggal_lahir }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-6 py-4 text-sm text-gray-900"
                                >
                                    <a
                                        :href="route('siswa.edit', siswa.id)"
                                        class="text-blue-600 hover:text-blue-800"
                                    >
                                        Edit
                                    </a>
                                    <button
                                        @click="confirmDelete(siswa)"
                                        class="ml-4 text-red-600 hover:text-red-800"
                                    >
                                        Hapus
                                    </button>
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
                                v-if="siswa.prev_page_url"
                                :href="siswa.prev_page_url"
                                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                            >
                                Previous
                            </a>
                            <a
                                v-if="siswa.next_page_url"
                                :href="siswa.next_page_url"
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
                                    Showing {{ siswa.from }} to
                                    {{ siswa.to }} of {{ siswa.total }} results
                                </p>
                            </div>
                            <div>
                                <nav
                                    class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm"
                                >
                                    <a
                                        v-for="link in siswa.links"
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
            <div
                v-if="showDeleteModal"
                class="fixed inset-0 z-50 h-full w-full overflow-y-auto bg-gray-600 bg-opacity-50"
            >
                <div
                    class="relative top-20 mx-auto w-96 rounded-md border bg-white p-5 shadow-lg"
                >
                    <div class="mt-3 text-center">
                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100"
                        >
                            <svg
                                class="h-6 w-6 text-red-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
                                />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">
                            Hapus Siswa
                        </h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus Siswa "{{
                                    siswaToDelete?.nama
                                }}"? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                        <div class="mt-4 flex justify-center gap-4">
                            <button
                                @click="showDeleteModal = false"
                                class="rounded-md bg-gray-300 px-4 py-2 text-base font-medium text-gray-800 shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300"
                            >
                                Batal
                            </button>
                            <button
                                @click="deleteSiswa"
                                class="rounded-md bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
