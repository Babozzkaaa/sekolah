<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    errors: Object,
});

const form = ref({
    nama: '',
    nis: '',
    jenis_kelamin: '',
    tanggal_lahir: '',
});
const process = ref(false);

const submit = () => {
    process.value = true;

    router.post(route('siswa.createData'), form.value, {
        onFinish: () => {
            process.value = false;
        },
    });
};
</script>

<template>
    <AuthenticatedLayout>
 

        <div class="min-h-screen bg-gray-50">
            <div class="mx-auto max-w-2xl px-6 py-8">
                <div class="mb-8">
                    <a
                        :href="route('siswa.list')"
                        class="mb-4 inline-block text-blue-600 hover:text-blue-800"
                    >
                        < Kembali
                    </a>
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Tambah Siswa
                    </h1>
                </div>

                <div class="rounded-lg border border-gray-200 bg-white p-6">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                for="nama"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Nama Siswa <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nama"
                                v-model="form.nama"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.nama }"
                                placeholder="Nama siswa"
                            />
                            <p
                                v-if="errors.nama"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.nama }}
                            </p>
                        </div>
                        <div>
                            <label
                                for="nis"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                NIS <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="nis"
                                v-model="form.nis"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': errors.nis }"
                                placeholder="Masukkan NIS siswa"
                            />
                            <p
                                v-if="errors.nis"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.nis }}
                            </p>
                        </div>
                        <div>
                            <label
                                for="jenis_kelamin"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <select
                                id="jenis_kelamin"
                                v-model="form.jenis_kelamin"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{
                                    'border-red-500': errors.jenis_kelamin,
                                }"
                            >
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <p
                                v-if="errors.jenis_kelamin"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.jenis_kelamin }}
                            </p>
                        </div>

                        <div>
                            <label
                                for="tanggal_lahir"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="date"
                                id="tanggal_lahir"
                                v-model="form.tanggal_lahir"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{
                                    'border-red-500': errors.tanggal_lahir,
                                }"
                            ></input>
                            <p
                                v-if="errors.tanggal_lahir"
                                class="mt-1 text-sm text-red-600"
                            >
                                {{ errors.tanggal_lahir }}
                            </p>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <a
                                :href="route('siswa.list')"
                                class="rounded bg-gray-100 px-4 py-2 text-gray-700 hover:bg-gray-200"
                            >
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :disabled="process"
                            >
                                {{ process ? 'Menyimpan...' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
